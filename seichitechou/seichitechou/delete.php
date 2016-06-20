<?php
    ini_set('display_errors', 1); 
    error_reporting(E_ALL);
    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

    $i =0;
    $id_num = $_REQUEST['id_select'];
    $delete_code2= $_REQUEST['delete_code2'];

    $con = mysql_connect('webdb.sfc.keio.ac.jp', 'ni9zhang', 'rXj9npNG');
    if (!$con) {
        exit('データベースに接続できませんでした。');
    }

    $result = mysql_select_db('ni9zhang', $con);
    if (!$result) {
        exit('データベースを選択できませんでした。');
    }

    $result = mysql_query('SET NAMES utf8', $con);
    if (!$result) {
        exit('文字コードを指定できませんでした。');
    }


    $result = mysql_query('SELECT * FROM seichi ORDER BY id DESC', $con);

    while ($data = mysql_fetch_array($result)) {
        if($id_num == $data['id']){
            $delete_code_confirm = $data['delete_code'];
        }
    }

    if($delete_code_confirm == $delete_code2){
        $result = mysql_query("DELETE FROM seichi WHERE id='$id_num'", $con);
        if (!$result) {
            exit('データを削除できませんでした。');
        }
    }else{
        echo('error');
    }

    $con = mysql_close($con);
    if (!$con) {
        exit('データベースとの接続を閉じられませんでした。');
    }
?>