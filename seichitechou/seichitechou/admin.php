<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>聖地手帳</title>
</head>
<body>
<form action="admin_delete.php" method="post">
    削除する投稿のNo：<br />
    <input type="number" name="id" size="6" value="" />
    <input type="submit" value="削除する" />
</form>
<?php

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
    $n = $data['id'];
    $nam = htmlspecialchars($data['user_name'], ENT_QUOTES, 'UTF-8');
    $path = htmlspecialchars($data['path_name'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');
    print ("<p>\n");
    print ("[No.$n]  ");
    print ('<a href="'.$nam.'">'.$nam.'</a>  ');
    print ('<a href="'.$path.'">'.$path.'</a>  ');
    echo $data['created_at'] . "<br />\n";
    echo "<br />\n";
    echo nl2br(htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8'));
    echo "</p>\n";
}
    

$result = mysql_query('SELECT * FROM seichi, $con');
print_r ($result);



$con = mysql_close($con);
if (!$con) {
    exit('データベースとの接続を閉じられませんでした。');
}

?>
</body>
</html>