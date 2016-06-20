<?php
    $db_conf = "mysql:host=webdb.sfc.keio.ac.jp; dbname=t12166su;";
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
    $sql = "INSERT INTO seichi (user_name, path_name, created_at, delete_code, start, goal, outline) VALUES (?,?,?,?,?,?,?)";
    $stm = $pdo -> prepare($sql);

    // 各値を代入
    $user_name = $_REQUEST['user_name'];
    $neme = mb_convert_encoding($user_name, "ISO-8859-1", "UTF-8");
    $path_name = $_REQUEST['path_name'];
    $created_at = date('Y-m-d H:i:s');
    $delete_code = $_REQUEST['delete_code'];
    $start = $_REQUEST['start'];
    $goal = $_REQUEST['goal'];
    $outline = $_REQUEST['outline'];

    $stm -> bindParam('1', $user_name, PDO::PARAM_STR);
    $stm -> bindParam('2', $path_name, PDO::PARAM_STR);
    $stm -> bindParam('3', $created_at, PDO::PARAM_STR);
    $stm -> bindParam('4', $delete_code, PDO::PARAM_STR);
    $stm -> bindParam('5', $start, PDO::PARAM_STR);
    $stm -> bindParam('6', $goal, PDO::PARAM_STR);
    $stm -> bindParam('7', $outline, PDO::PARAM_STR);

    // 実行
    $stm->execute();

    $pdo = null;	// オブジェクトを空にする
    $stm->closeCursor();	// MySQL接続をクローズする
?>

