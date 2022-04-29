<?php

require_once __DIR__ . '/../utils/Read_file.php';

$read_file = new Read_file();

$read_file->read_txt_fgets();

$read_file->read_txt_fgetcsv();