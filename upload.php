<?php
    require_once 'init.php';
    @$comName = $_POST['comName'];
    @$jsonData = $_POST['postdata'];
    @$kind = $_POST['kind'];
    @$bid = $_POST['belongId'];
    $response = [];
    if($kind == 'insertCom'){
        mysqli_query($connect,"INSERT INTO vel_belong VALUES(NULL,'$comName',0,0)");
        $res = mysqli_affected_rows($connect);
        if($res){
            $response = [            
                'msg'=> '导入成功',
                'code'=>200
            ];
        }
    }else if($kind == 'selectId'){
        $res = mysqli_fetch_row(mysqli_query($connect,"SELECT bid FROM vel_belong WHERE bname='$comName'"));
        if($res){
            $response = [            
                'msg'=> $res,
                'code'=>200
            ];
        };
    }else if($kind == 'insertVehs'){
        $sql = 'INSERT INTO vel_list VALUES';
        for($i=0;$i<sizeof($jsonData);$i++){
            $data = $jsonData[$i];
            if($i<sizeof($jsonData)-1){
                $sql .= "(NULL,'$data[0]','$comName','$bid','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]'),";
            }else{
                $sql .= "(NULL,'$data[0]','$comName','$bid','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]');";
            };
        };
        mysqli_query($connect,$sql);
        $res = mysqli_affected_rows($connect);
        if($res){
            $response = [            
                'msg'=> $res,
                'sql'=> $sql,
                'code'=>200
            ];
        }else{
            $response = [            
                'sql'=> $sql,
                'code'=>400
            ];
        }
    };
    echo json_encode($response);
?>