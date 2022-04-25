<?php

class Zip {
    
    public function __construct() {
        
    }
    
    public function generate_zip() {
        try {
            $path = __DIR__ . '/../';
            $path_zip = $path . 'files_zip/';
            $date = date('YmdHis');
            
            for ($i = 0; $i < 7; $i++) {
                $fp = fopen($path_zip . 'miarchivo_'.uniqid() . '.txt', 'w');
                fwrite($fp, 'Archivo creado en la fecha: '.$date);
                fclose($fp);
            }
            
            $zip = new \ZipArchive();
            $name_zip = uniqid().'.zip';
            if($zip->open($path_zip.$name_zip,  ZipArchive::CREATE)) {
                $files = opendir($path_zip);
                while ($file = readdir($files)) {
                    if(is_file($path_zip.$file)) {
                        if(file_exists($path_zip.$file)) {
                            $zip->addFile($path_zip.$file, $file);
                            $path_files[] = $path_zip.$file;
                        }
                    }
                }
                $zip->close();
                
                if(count($path_files) > 0) {
                    foreach ($path_files as $file) {
                        if(file_exists($file)) {
                            unlink($file);
                        }
                    }
                }
                header('Content-Type: application/zip');
                header('Content-disposition: attachment; filename='.$name_zip);
                header('Content-Length: ' . filesize($path_zip.$name_zip));
                readfile($path_zip.$name_zip);
                unlink($path_zip.$name_zip);
            }else {
                throw new \Exception('NO SE PUEDE GENERAR ZIP');
            }
        }catch (\Exception $e) {
            echo '==== ERROR: ' . $e->getMessage() . ' ====' . PHP_EOL;
        }
        die();
    }
}
