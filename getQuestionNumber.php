<?php
require 'db_configuration.php';
include('header.php');

$sql = "SELECT `value` FROM preferences WHERE `name`= 'NO_OF_QUESTIONS_TO_SHOW'";

$numPuzz = mysqli_query($db,$sql);

$result = mysqli_fetch_array($numPuzz);


echo "<br>";


$questNum = $result['value'];
echo $questNum;


?>