<?php
    //初期設定
    $url = 'https://api.voicetext.jp/v1/tts';
    $key = 'fn50mfi6pyskprak';
    $data = array();
    $content = $_POST['content'];
    //喋る人や感情などのパラメータを設定
    $arr = array(
         'text' => htmlspecialchars($content), //喋らせたいテキスト
         'speaker' => 'hikari', //話す人
         'pitch' => 100, //声の高低
         'speed' => 100, //話す速度
         'volume' => 100 //音量
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_USERPWD, $key . ":");

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arr));

    $result = curl_exec($ch);

    curl_close($ch);

    file_put_contents("mapcontents/content1.mp3", $result);
    chmod("mapcontents/content1.mp3",0644);//0755
?>