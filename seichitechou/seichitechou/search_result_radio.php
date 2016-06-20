<?php
	$i =0;
    $req_user_name = $_REQUEST['user_name'];
    $req_path_name = $_REQUEST['path_name'];
	
	$con = mysql_connect('webdb.sfc.keio.ac.jp', 'ni9zhang', 'rXj9npNG');
    if (!$con) {
        exit('データベースに接続できませんでした。');
    }

    $result = mysql_select_db('ni9zhang', $con);
    if (!$result) {
        exit('データベースを選択できませんでした。');
    }

    $result = mysql_query('SELECT * FROM seichi ORDER BY id DESC', $con);

    while ($data = mysql_fetch_array($result)) {
        if($req_user_name != "" && $req_path_name != "" && $req_user_name == $data['user_name'] && $req_path_name == $data['path_name']){
            $n[$i] = $data['id'];
            $user_name[$i] = htmlspecialchars($data['user_name'], ENT_QUOTES, 'UTF-8');
            $path_name[$i] = htmlspecialchars($data['path_name'], ENT_QUOTES, 'UTF-8');
            $content[$i] = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
            $latitude[$i] =htmlspecialchars($data['latitude'], ENT_QUOTES, 'UTF-8');
            $longitude[$i] =htmlspecialchars($data['longitude'], ENT_QUOTES, 'UTF-8');
            $delete_code[$i] =htmlspecialchars($data['delete_code'], ENT_QUOTES, 'UTF-8');
            $start[$i] =htmlspecialchars($data['start'], ENT_QUOTES, 'UTF-8');
            $goal[$i] =htmlspecialchars($data['goal'], ENT_QUOTES, 'UTF-8');
            $outline[$i] =htmlspecialchars($data['outline'], ENT_QUOTES, 'UTF-8');
            $i++;
        }else if($req_user_name != "" && $req_path_name == "" && $req_user_name == $data['user_name']){
            $n[$i] = $data['id'];
            $user_name[$i] = htmlspecialchars($data['user_name'], ENT_QUOTES, 'UTF-8');
            $path_name[$i] = htmlspecialchars($data['path_name'], ENT_QUOTES, 'UTF-8');
            $content[$i] = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
            $latitude[$i] =htmlspecialchars($data['latitude'], ENT_QUOTES, 'UTF-8');
            $longitude[$i] =htmlspecialchars($data['longitude'], ENT_QUOTES, 'UTF-8');
            $delete_code[$i] =htmlspecialchars($data['delete_code'], ENT_QUOTES, 'UTF-8');
            $start[$i] =htmlspecialchars($data['start'], ENT_QUOTES, 'UTF-8');
            $goal[$i] =htmlspecialchars($data['goal'], ENT_QUOTES, 'UTF-8');
            $outline[$i] =htmlspecialchars($data['outline'], ENT_QUOTES, 'UTF-8');
            $i++;
        }else if($req_user_name == "" && $req_path_name != "" && $req_path_name == $data['path_name']){
            $n[$i] = $data['id'];
            $user_name[$i] = htmlspecialchars($data['user_name'], ENT_QUOTES, 'UTF-8');
            $path_name[$i] = htmlspecialchars($data['path_name'], ENT_QUOTES, 'UTF-8');
            $content[$i] = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
            $latitude[$i] =htmlspecialchars($data['latitude'], ENT_QUOTES, 'UTF-8');
            $longitude[$i] =htmlspecialchars($data['longitude'], ENT_QUOTES, 'UTF-8');
            $delete_code[$i] =htmlspecialchars($data['delete_code'], ENT_QUOTES, 'UTF-8');
            $start[$i] =htmlspecialchars($data['start'], ENT_QUOTES, 'UTF-8');
            $goal[$i] =htmlspecialchars($data['goal'], ENT_QUOTES, 'UTF-8');
            $outline[$i] =htmlspecialchars($data['outline'], ENT_QUOTES, 'UTF-8');
            $i++;
        }
    }

    $result_arr = [$n, $user_name, $path_name, $content, $latitude, $longitude, $delete_code, $start, $goal, $outline];
    header('Content-type: application/json');
    echo json_encode($result_arr);

    $con = mysql_close($con);
    if (!$con) {
        exit('データベースとの接続を閉じられませんでした。');
    }
?>