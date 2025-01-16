<?php
    if( ! empty($download_file))
        {
            //If you want to download an existing file from your server you'll need to read the file into a string
            $data = file_get_contents(ASSETS_URL.'images/uploads/'.$download_file); // Read the file's contents
           // $data = file_get_contents(ASSETS_URL."images/uploads/CARD_1582206777.png"); // Read the file's contents
            $name = 'download_file.jpeg';
            force_download($name, $data);
        } 

?>