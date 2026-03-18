<?php
/**
 * Upgraded Environment Configuration Loader
 */

$env_file = __DIR__ . '/.env';

// TRIPWIRE: If the file is missing or named wrong, crash loudly!
if (!file_exists($env_file)) {
    die("<h2 style='color:red;'>CRITICAL ERROR: Cannot find the .env file!</h2>
         <p>PHP is looking for it exactly here: <br><b>" . $env_file . "</b></p>
         <p>Check your folder to ensure Windows didn't accidentally name it <b>.env.txt</b>.</p>");
}

$lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    // Skip comments
    if (strpos(trim($line), '#') === 0) continue;
    
    // Parse KEY=VALUE
    if (strpos($line, '=') !== false) {
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        
        // Remove quotes if present
        if (in_array($value[0] ?? '', ['"', "'"])) {
            $value = substr($value, 1, -1);
        }
        
        // Save the key in 3 different ways to guarantee PHP catches it
        putenv("$key=$value");
        $_ENV[$key] = $value;
        if (!defined($key)) {
            define($key, $value); 
        }
    }
}
?>