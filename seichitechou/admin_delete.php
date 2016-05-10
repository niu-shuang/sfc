<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>聖地手帳</title>
</head>
<body>
<?php

if ($_POST['id'] == '') {
    exit('error');
}

$pattern = '/^(\d)*$/';
if (!preg_match($pattern, $_POST['id'], $matches)){
    exit('数字を入力してください');
}

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

$id = $_REQUEST['id'];

$result = mysql_query("DELETE  FROM seichi WHERE id='$id'", $con);
if (!$result) {
    exit('データを削除できませんでした。');
}

$con = mysql_close($con);
if (!$con) {
    exit('データベースとの接続を閉じられませんでした。');
}

?>
<p>投稿を削除しました。</p>
<ul>
    <li><a href="admin.php">一覧へ戻る</a></li>
</ul>
</body>
</html>