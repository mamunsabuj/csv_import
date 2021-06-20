<?php

class CSV_import
{

    public function import_csv_data()
    {
        $fp = fopen($_FILES['upload_csv_file']['tmp_name'], 'r') or die("can't open file");

        if (($handle = fopen($_FILES['upload_csv_file']['tmp_name'], 'r')) !== FALSE) 
        {

            $full_data = [];
            while ($csv_line = fgetcsv($fp, 1024)) {

                //CSV file columns:  ID, name, email, password, phone , address
                for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                    $insert_csv = array();
                    $insert_csv['id'] = (!empty($csv_line[0]) ? $csv_line[0] : '');
                    $insert_csv['name'] = (!empty($csv_line[1]) ? $csv_line[1] : '');
                    $insert_csv['email'] = (!empty($csv_line[2]) ? $csv_line[2] : '');
                    $insert_csv['password'] = (!empty($csv_line[3]) ? $csv_line[3] : '');
                    $insert_csv['phone'] = (!empty($csv_line[4]) ? $csv_line[4] : '');
                    $insert_csv['address'] = (!empty($csv_line[5]) ? $csv_line[5] : '');
                }

                // Organize data for inserting in table
                if(!empty($insert_csv['id'])){
                    $full_data[] = array(
                        'id' => $insert_csv['id'],
                        'name' => $insert_csv['name'],
                        'phone' => $insert_csv['phone'],
                        'email' => $insert_csv['email'],
                        'password' => $insert_csv['password'],
                        'address' => $insert_csv['address']
                    );

                    // You can insert data as single item into table
                }
            }

            echo "<pre>";
            print_r($full_data);
            echo "</pre>";

            //You can insert the $full_data into table as batch insert

        }
    }
}

$csvobj = new CSV_import();

if(!empty($_FILES)){

    $csvobj->import_csv_data();

}

