<?php
    header("content-type:text/html;charset=utf-8");
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE');
    $connect = mysqli_connect('127.0.0.1','velnote','123456','velnote');
    mysqli_query($connect,'SET NAMES UTF8');
?>