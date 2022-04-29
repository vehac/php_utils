<?php

class Read_file {
    
    public function __construct() {
    }
    
    public function write_file($fileQuerys, $string) {
        $f = fopen($fileQuerys, 'a+');
        fwrite($f, $string);
        fclose($f);
    }

    public function read_txt_fgets() {
        echo "=== INICIO LEER ARCHIVO USANDO fgets ===". PHP_EOL;
        $date = date('YmdHis');
        $fileLocal = __DIR__.'/../read_data.txt';
        $fileQuerys = __DIR__.'/../files/querys_fgets_'.$date.'.sql';
        
        $limitador = '|';
        
        if(($gestor = fopen($fileLocal, "r")) !== FALSE) {
            $cabecera = TRUE;
            $cabeceraString = TRUE;
            $cad_sql = "";
            $limite = 5;
            $count = 0;
            $fila = 0;
            $datos_sql = [];
            while(($datos = fgets($gestor, 4096)) !== FALSE) {
                $datos_array = explode($limitador, $datos);
                //$datos_procesados = array_map("utf8_encode", array_map('trim',$datos_array));
                $datos_procesados = array_map('trim', $datos_array);
                if($cabecera == TRUE) {
                    $cabecera = FALSE;
                    $keys = $datos_procesados;
                    $string_keys = implode(', ', $keys);
                    $cad_sql_head = "INSERT INTO user (" . $string_keys . ") VALUES ";
                    $fila = $fila + 1;
                }else {
                    $count_datos_txt = count($datos_procesados);
                    if(count($keys) == $count_datos_txt) {
                        for($i=0; $i<$count_datos_txt; $i++) {
                            if($datos_procesados[$i] == "" || $datos_procesados[$i] == NULL || $datos_procesados[$i] == "NULL") {
                               $datos_procesados[$i] = "NULL";
                            }else {
                                $datos_procesados[$i] = '"' . $datos_procesados[$i] . '"';
                            }
                        }
                        $string_datos = implode(', ', $datos_procesados);
                        $cad_sql = "(" . $string_datos .")";
                    }else {
                        $cad_sql = "";
                    }
                    $fila = $fila + 1;
                }
                if($cabeceraString == TRUE) {
                    $this->write_file($fileQuerys, $cad_sql_head . PHP_EOL);
                    $cabeceraString = FALSE;
                }
                if($cad_sql != "") {
                    if($count == $limite) {
                        $datos_string = implode("," . PHP_EOL, $datos_sql);
                        $this->write_file($fileQuerys, $datos_string . ";" . PHP_EOL);
                        $count = 1;
                        $cabeceraString = TRUE;
                        $datos_sql = [];
                        $datos_sql[] = $cad_sql;
                    }else {
                        $datos_sql[] = $cad_sql; 
                        $count = $count + 1;
                    }
                }else {
                    if($fila != 1) {
                        echo "=== NO SE PUDO LEER FILA: ". $fila . " ===". PHP_EOL;
                    }
                }
                $cad_sql= "";
            }
            if(isset($datos_sql) && count($datos_sql) > 0) {
                $datos_string = implode("," . PHP_EOL, $datos_sql);
                $this->write_file($fileQuerys, $datos_string . ";" . PHP_EOL);
            }
            fclose($gestor);
        }
        echo "=== FIN LEER ARCHIVO USANDO fgets ===". PHP_EOL;
    }
    
    public function read_txt_fgetcsv() {
        echo "=== INICIO LEER ARCHIVO USANDO fgetcsv ===". PHP_EOL;
        $date = date('YmdHis');
        $fileLocal = __DIR__.'/../read_data.txt';
        $fileQuerys = __DIR__.'/../files/querys_fgetcsv_'.$date.'.sql';
        
        $limitador = '|';
        
        if(($gestor = fopen($fileLocal, "r")) !== FALSE) {
            $cabecera = TRUE;
            $cabeceraString = TRUE;
            $cad_sql = "";
            $limite = 5;
            $count = 0;
            $fila = 0;
            $datos_sql = [];
            while(($datos = fgetcsv($gestor, 4096, $limitador)) !== FALSE) {
                $datos_array = $datos;
                //$datos_procesados = array_map("utf8_encode", array_map('trim',$datos_array));
                $datos_procesados = array_map('trim', $datos_array);
                if($cabecera == TRUE) {
                    $cabecera = FALSE;
                    $keys = $datos_procesados;
                    $string_keys = implode(', ', $keys);
                    $cad_sql_head = "INSERT INTO user (" . $string_keys . ") VALUES ";
                    $fila = $fila + 1;
                }else {
                    $count_datos_txt = count($datos_procesados);
                    if(count($keys) == $count_datos_txt) {
                        for($i=0; $i<$count_datos_txt; $i++) {
                            if($datos_procesados[$i] == "" || $datos_procesados[$i] == NULL || $datos_procesados[$i] == "NULL") {
                               $datos_procesados[$i] = "NULL";
                            }else {
                                $datos_procesados[$i] = '"' . $datos_procesados[$i] . '"';
                            }
                        }
                        $string_datos = implode(', ', $datos_procesados);
                        $cad_sql = "(" . $string_datos .")";
                    }else {
                        $cad_sql = "";
                    }
                    $fila = $fila + 1;
                }
                if($cabeceraString == TRUE) {
                    $this->write_file($fileQuerys, $cad_sql_head . PHP_EOL);
                    $cabeceraString = FALSE;
                }
                if($cad_sql != "") {
                    if($count == $limite) {
                        $datos_string = implode("," . PHP_EOL, $datos_sql);
                        $this->write_file($fileQuerys, $datos_string . ";" . PHP_EOL);
                        $count = 1;
                        $cabeceraString = TRUE;
                        $datos_sql = [];
                        $datos_sql[] = $cad_sql;
                    }else {
                        $datos_sql[] = $cad_sql; 
                        $count = $count + 1;
                    }
                }else {
                    if($fila != 1) {
                        echo "=== NO SE PUDO LEER FILA: ". $fila . " ===". PHP_EOL;
                    }
                }
                $cad_sql= "";
            }
            if(isset($datos_sql) && count($datos_sql) > 0) {
                $datos_string = implode("," . PHP_EOL, $datos_sql);
                $this->write_file($fileQuerys, $datos_string . ";" . PHP_EOL);
            }
            fclose($gestor);
        }
        echo "=== FIN LEER ARCHIVO USANDO fgetcsv ===". PHP_EOL;
    }
}
