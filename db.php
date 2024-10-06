<?php
$host="localhost";
$user ="root";
$password="huncho";
$db = "music";
$conn = new mysqli($host,$user,$password,$db);
if(!$conn){
    echo "failed";
}
