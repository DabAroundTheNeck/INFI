<?php
    //Creating a PDO Connection
    function create_pdo() {
        return new PDO('mysql:host=80.123.206.40:3306;dbname=INFI;charset=utf8', 'root', 'nicholas paranoia cucumber');
    }
?>
