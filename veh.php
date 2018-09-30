<?php
    require_once 'init.php';
    @$kind = $_REQUEST['kind'];
    @$belongid = $_REQUEST['belongid'];
    @$vnum = $_REQUEST['vnum'];
    @$vid = $_REQUEST['vid'];
    @$spay = $_REQUEST['spay'];
    @$paystate = $_REQUEST['paystate'];
    @$islate = $_REQUEST['islate'];
    @$startpage = $_REQUEST['startpage']; 
    @$pagesize = $_REQUEST['pagesize'];
    $size = 0;
    if($pagesize){
        $size = $pagesize; 
    }else{
        $size = 20;
    }
    if($kind == 'selectPay'){
        // 欠费车辆查询
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_list WHERE paystate=0 LIMIT $startpage,$size"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'selectLate'){
        //欠费逾期车辆查询
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_list WHERE paystate=0 AND islate=1 LIMIT $startpage,$size"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'selectByCom'){
        //分页查询某公司下所有车辆
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_list WHERE belongid='$belongid' LIMIT $startpage,$size"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'selectByVeh'){
        //查询某公司下的某辆车的具体信息
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_list WHERE vid='$vid' AND belongid='$belongid'"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'update'){
        //修改车辆缴费状态
        mysqli_query($connect,"UPDATE vel_list SET spay='$spay',paystate='$paystate',islate='$islate' WHERE belongid='$belongid' AND vid='$vid'");
        $res = mysqli_affected_rows($connect);
        echo json_encode($res);
    }else if($kind == 'searchVeh'){
        //模糊查询车辆
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_list WHERE vnum LIKE '%$vnum%' AND paystate=0"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'searchVehByCom'){
        //模糊查询某公司下的车辆
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_list WHERE vnum LIKE '%$vnum%' AND belongid='$belongid'"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'selectAll'){
        //查询所有车辆
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT * FROM vel_list"),MYSQLI_ASSOC);
        echo json_encode($res);
    }else if($kind == 'selectPages'){
        //查询某公司下所有车辆
        $res = mysqli_fetch_all(mysqli_query($connect,"SELECT COUNT(*) FROM vel_list WHERE belongid='$belongid'"));
        echo json_encode($res);
    }else if($kind == 'deleteVeh'){
        //删除车辆
        mysqli_query($connect,"DELETE FROM vel_list WHERE vid='$vid' AND belongid='$belongid'");
        $res = mysqli_affected_rows($connect);
        echo json_encode($res);
    }
?>