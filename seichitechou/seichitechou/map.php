<?php
	$i =0;
	$con = mysql_connect('webdb.sfc.keio.ac.jp', 'ni9zhang', 'rXj9npNG');
    if (!$con) {
        exit('データベースに接続できませんでした。');
    }
    $result = mysql_select_db('ni9zhang', $con);
    if (!$result) {
        exit('データベースを選択できませんでした。');
    }
    $result = mysql_query('SELECT * FROM seichi ORDER BY id DESC', $con);
    $result_arr = array();
    $n = array();
    $user_name = array();
    $path_name = array();
    $content = array();
    $latitude = array();
    $longitude = array();
    $file_list = array();

    while ($data = mysql_fetch_array($result)) {
        $n[$i] = $data['id'];
        $user_name[$i] = htmlspecialchars($data['user_name'], ENT_QUOTES, 'UTF-8');
        $path_name[$i] = htmlspecialchars($data['path_name'], ENT_QUOTES, 'UTF-8');
        $content[$i] = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
        $latitude[$i] = htmlspecialchars($data['latitude'], ENT_QUOTES, 'UTF-8');
        $longitude[$i] = htmlspecialchars($data['longitude'], ENT_QUOTES, 'UTF-8');
        if($content[$i] != ""){
            if(file_exists("files/" . $n[$i] . ".jpeg")){
                array_push($file_list, $n[$i]);
            }
        }
        $i++;
    }
    $result_arr = [$n, $user_name, $path_name, $content, $latitude, $longitude, $file_list]; 
    header('Content-type: application/json');
    echo json_encode($result_arr);
    $con = mysql_close($con);
    if (!$con) {
        exit('データベースとの接続を閉じられませんでした。');
    }
?>