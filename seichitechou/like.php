<?php
    ini_set('display_errors', 1); 
    error_reporting(E_ALL);

    $i =0;
    $id_num = $_REQUEST['id_select'];
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
        if($id_num == $data['id']){
            $like_select = $data['likes'];
        }
    }
    $con = mysql_close($con);
    if (!$con) {
        exit('データベースとの接続を閉じられませんでした。');
    }

    $db_conf = "mysql:host=webdb.sfc.keio.ac.jp; dbname=ni9zhang;";
    $db_user = "ni9zhang";
    $db_pass = "rXj9npNG";
    try {
        // MySQLサーバへ接続
        $pdo = new PDO($db_conf, $db_user, $db_pass, array(PDO::ATTR_EMULATE_PREPARES => false));
    } catch(PDOException $e) {
        // エラー処理
        print ("データベースへの接続に失敗しました。");
    }

    $sql = 'update seichi set likes =:likes where id = :id_num';
    $stmt = $pdo -> prepare($sql);
    $likes = $like_select + 1;
    $stmt -> bindParam(':likes', $likes, PDO::PARAM_STR);
    $stmt -> bindValue(':id_num', $id_num, PDO::PARAM_INT);
    $stmt -> execute();

    $pdo = null;	// オブジェクトを空にする
    $stm->closeCursor();	// MySQL接続をクローズする
?>