<?php
    require_once 'init.php';
    @$kind = $_REQUEST['kind'];
    @$addnum = $_REQUEST['addnum'];
    @$year = $_REQUEST['year'];
    @$month = $_REQUEST['month'];
    @$used = $_REQUEST['used'];
    if($kind == 'addCard'){
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT addnum FROM vel_sim WHERE addyear='$year' AND addmonth='$month'"),MYSQLI_ASSOC); 
        if($res){
            $total = $res[0]['addnum'] + $addnum;
            mysqli_query($connect,"UPDATE vel_sim SET addnum='$total' WHERE addyear='$year' AND addmonth='$month'");
            $res = mysqli_affected_rows($connect);
            if($res>0){
                $post = [
                    'count' => $total,
                    'code' => 200
                ];
            }else{
                $post = [
                    'code' => 400
                ]; 
            }  
        }else{
            mysqli_query($connect,"INSERT INTO vel_sim VALUES(NULL,'$year','$month','$addnum',0);");
            $res = mysqli_affected_rows($connect);
            if($res>0){
                $post = [
                    'count' => $addnum,
                    'code' => 200
                ];
            }else{
                $post = [
                    'code' => 400
                ]; 
            } 
        }
    }else if($kind == 'currsimadd'){
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT addnum FROM vel_sim WHERE addyear='$year' AND addmonth='$month'"),MYSQLI_ASSOC);
        if($res){
            $post = [
                'count' => $res,
                'code' => 200
            ];
        }else{
            $post = [
                'code' => 400
            ]; 
        }
    }else if($kind == 'currsimuse'){
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT usenum FROM vel_sim WHERE addyear='$year' AND addmonth='$month'"),MYSQLI_ASSOC);
        if($res){
            $post = [
                'count' => $res,
                'code' => 200
            ];
        }else{
            $post = [
                'code' => 400
            ]; 
        }
    }else if($kind == 'usecard'){
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT usenum FROM vel_sim WHERE addyear='$year' AND addmonth='$month'"),MYSQLI_ASSOC);
        if($res){
            $total = $res[0]['usenum'] + $used;
            mysqli_query($connect,"UPDATE vel_sim SET usenum='$total' WHERE addyear='$year' AND addmonth='$month'");
            $res = mysqli_affected_rows($connect);
            if($res>0){
                $post = [
                    'count' => $total,
                    'code' => 200
                ];
            }else{
                $post = [
                    'code' => 400
                ]; 
            }  
        }else{
            $post = [
                'code' => 400
            ]; 
        }
    }else if($kind == 'totalsimrest'){
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_sim"),MYSQLI_ASSOC);
        if($res){
            $post = $post = [
                'msg' => $res,
                'code' => 200
            ];
        }else{
            $post = [
                'code' => 400
            ];
        }
    }
    echo json_encode($post);
?>