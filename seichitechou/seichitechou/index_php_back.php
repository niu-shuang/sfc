<?php
    $i =1;
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
    $created_at = array();
    $content = array();
    $contentStr = array();
    $likes = array();
    $i = 0;
    while ($data = mysql_fetch_array($result)) {
        $n[$i] = $data['id'];
        $user_name[$i] = htmlspecialchars($data['user_name'], ENT_QUOTES, 'UTF-8');
        $path_name[$i] = htmlspecialchars($data['path_name'], ENT_QUOTES, 'UTF-8');
        $created_at[$i] = htmlspecialchars($data['created_at'], ENT_QUOTES, 'UTF-8');
        $content[$i] = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
        $contentStr[$i] = "";
        if($content[$i] != ""){
            if(file_exists("files/" . $n[$i] . ".jpeg")){
                $contentStr[$i] = '<p align="center"><img src="http://web.sfc.keio.ac.jp/~ni9zhang/seichitechou/files/' . $n[$i] . '.jpeg" height="200"/></p>';
            }
        }
        $likes[$i] = $data['likes'];
        $i++;
    }
    $result_arr = [$n, $user_name, $path_name, $created_at, $content, $contentStr, $likes];
    //print_r ($result_arr);
    header('Content-type: application/json');
    echo json_encode($result_arr);
    $con = mysql_close($con);
    if (!$con) {
        exit('データベースとの接続を閉じられませんでした。');
    }
?>