<?php

/**
 * Autoload function for automatically loading PHP classes.
 *
 * This function registers an autoloader for the application, ensuring that when a class is called,
 * its file is automatically loaded if it exists in the file system. The autoloader looks for
 * the class files in the directory above the current file and follows the PSR-4 standard for
 * namespace to file path resolution.
 *
 * - `$class`: The name of the class being requested.
 * - `$baseDir`: The base directory where the classes are located (the parent directory of the current file).
 * - `$file`: The full path to the class file.
 *
 * If the class file is found, it is included with `require_once`. If the file is not found, an error is logged
 * and an exception is thrown to indicate the missing file.
 *
 * @throws Exception If the class file is not found, an exception is thrown.
 */
spl_autoload_register(function ($class) {
    $baseDir = dirname(__DIR__) . '/';

    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Error loading class {$class}: File {$file} not found.");
        throw new Exception("Class file '{$class}' not found: {$file}");
    }
});
