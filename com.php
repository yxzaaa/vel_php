<?php
    require_once 'init.php';
    @$kind = $_REQUEST['kind'];
    @$bname = $_REQUEST['bname'];
    @$bid = $_REQUEST['bid'];
    if($kind == 'selectAll'){
        $res = mysqli_fetch_all(mysqli_query($connect,'SELECT * FROM vel_belong'),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'insert'){
        mysqli_query($connect,"INSERT INTO vel_belong VALUES(NULL,'$bname',0,0)");
        $res = mysqli_affected_rows($connect);
        echo json_encode($res);
    }else if($kind == 'delete'){
        mysqli_query($connect,"DELETE FROM vel_belong WHERE bid='$bid'");
        $res = mysqli_affected_rows($connect);
        echo json_encode($res);
    }else if($kind == 'searchCom'){
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_belong WHERE bname LIKE '%$bname%'"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'simTotal'){
        $res = mysqli_fetch_all(mysqli_query($connect,'SELECT * FROM vel_sim'),MYSQLI_ASSOC);
        echo json_encode($res);
    };
?>