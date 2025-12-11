<?php
// application/libraries/PHPWordLoader.php

class PHPWordLoader {
    public function __construct() {
        // Definisikan konstanta untuk jalur PHPWord
        if (!defined('PHPWORD_BASE_PATH')) {
            define('PHPWORD_BASE_PATH', APPPATH . 'third_party/PHPWord/src/PhpWord/');
        }

        // Daftarkan autoload untuk namespace PhpOffice\PhpWord
        spl_autoload_register(function ($class) {
            $prefix = 'PhpOffice\\PhpWord\\';
            $base_dir = PHPWORD_BASE_PATH;

            // Apakah kelas menggunakan prefix?
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                // No, move to the next registered autoloader
                return;
            }

            // Dapatkan nama kelas relatif
            $relative_class = substr($class, $len);

            // Ganti namespace prefix dengan base directory, ganti namespace
            // separator dengan directory separator, tambahkan .php
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            // Jika file ada, include file tersebut
            if (file_exists($file)) {
                require $file;
            }
        });
    }
}
