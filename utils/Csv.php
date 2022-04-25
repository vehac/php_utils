<?php

class Csv {
    
    public function __construct() {
        $val_cli = (PHP_SAPI === 'cli' OR defined('STDIN'));
        if(!$val_cli) {
           die('Request is not permited.');
        }
    }
    
    public function generate_csv() {
        try {
            $path = __DIR__ . '/../';
            $path_csv = $path.'files/';
            $date = date('YmdHis');
            
            $data = file_get_contents($path . 'users.json');
            $users = json_decode($data, true);
            
            $file_csv = fopen($path_csv . 'list_users_'.$date . '.csv', 'w');
            fputs($file_csv, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            $header = array('id_user', 'name_user', 'lastname_user', 'email_user', 'created_at_user');
            fputcsv($file_csv, $header);
            
            foreach ($users as $user) {
                $value_csv = array('id_user' => $user['id'], 'name_user' => $user['name'], 'lastname_user' => $user['lastname'], 
                    'email_user' => $user['email'], 'created_at_user' => $user['created_at']);
                fputcsv($file_csv, $value_csv);
            }
            
            fclose($file_csv);
        }catch (\Exception $e) {
            echo '==== ERROR: ' . $e->getMessage() . ' ====' . PHP_EOL;
        }
    }
}
