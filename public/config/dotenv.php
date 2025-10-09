<?php
function load_env() {
    $env_file = __DIR__ . '/../.env';
    
    if (file_exists($env_file)) {
        $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Skip comments
            if (strpos($line, '#') === 0) {
                continue;
            }
            
            // Split on first = only
            $pos = strpos($line, '=');
            if ($pos !== false) {
                $key = substr($line, 0, $pos);
                $value = substr($line, $pos + 1);
                
                // Remove quotes if present
                $value = trim($value, '"\'');
                
                // Set environment variable
                putenv("$key=$value");
                
                // Also set in $_ENV and $_SERVER
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
}