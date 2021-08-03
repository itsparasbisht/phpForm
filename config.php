<?php

$conn = mysqli_connect('localhost', 'paras', '12345', 'students');

if(!$conn){
    echo "connection error: ". mysqli_connect_error();
}

?>