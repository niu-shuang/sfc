<?php
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
    // プリペアド ステートメント：準備段階
    $sql = "INSERT INTO whispath20 (user_name, path_name, created_at, content, latitude, longitude, delete_code) VALUES (?,?,?,?,?,?,?)";
    $stm = $pdo -> prepare($sql);

    // 各値を代入
    $user_name = $_REQUEST['user_name'];
    $neme = mb_convert_encoding($user_name, "ISO-8859-1", "UTF-8");
    $path_name = $_REQUEST['path_name'];
    $content = $_REQUEST['content'];
    $created_at = date('Y-m-d H:i:s');
    $latitude = $_REQUEST['latitude'];
    $longitude = $_REQUEST['longitude'];
    $delete_code = $_REQUEST['delete_code'];

    $stm -> bindParam('1', $user_name, PDO::PARAM_STR);
    $stm -> bindParam('2', $path_name, PDO::PARAM_STR);
    $stm -> bindParam('3', $created_at, PDO::PARAM_STR);
    $stm -> bindParam('4', $content, PDO::PARAM_STR);
    $stm -> bindParam('5', $latitude, PDO::PARAM_STR);
    $stm -> bindParam('6', $longitude, PDO::PARAM_STR);
    $stm -> bindParam('7', $delete_code, PDO::PARAM_STR);

    // 実行
    $stm->execute();
    
    //file upload
    $last_id = $pdo->lastInsertId();
    if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $last_id . ".jpeg")) {
            chmod("files/" . $last_id . ".jpeg", 0644);
        }
    }

    if (is_uploaded_file($_FILES["upfile2"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["upfile2"]["tmp_name"], "files/" . $last_id . ".wav")) {
            chmod("files/" . $last_id . ".wav", 0644);
        }
    }

    $pdo = null;	// オブジェクトを空にする
    $stm->closeCursor();	// MySQL接続をクローズする
?>

