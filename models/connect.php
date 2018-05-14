<!--
Author: Cody Potter
Date: 2018-05-14
Assignment: Week 5/6
-->
<?php
$dsn = 'mysql:host=localhost;dbname=dogsrus;';
$dbUser = 'root';
$dbPassword = '';
$date = date('Y-m-d');

try {
    $connection = new PDO($dsn, $dbUser, $dbPassword);
} catch (PDOException $error) {
    echo('The Database connection failed.');
    echo($error);
}
 ?>
