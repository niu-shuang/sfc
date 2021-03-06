﻿<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <title>漫步-Walk in the Story</title>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://iwb.jp/s/js/jquery.skOuterClick.js"></script>
       
        <script type="text/javascript">
            function position(){
                //Geolocateのオプションを設定
                var geolocateOption = {
                    success: geolocate_success,
                    error: geolocate_error,
                    not_supported: geolocate_notsupport
                };
                GMaps.geolocate(geolocateOption); //現在地の取得処理を開始
            }
            function strlength(str) {
                if(str.length > 150){
                    document.getElementById("idStrlength").innerHTML = "<font color = 'red'>" + (150 - str.length) + "</font>";
                }else if(str.length >= 140){
                    document.getElementById("idStrlength").innerHTML = "<font color = 'red'>" + (150 - str.length) + "</font>";
                }else{
                    document.getElementById("idStrlength").innerHTML = 150-str.length;
                }
            }
            $(function() {
                $("#onoffswitch :checkbox").click(function() {
                    switch_status = switch_status * (-1);
                    polyline_check();
                });
                $("#content").click(function(){
                    if($('#content').val() == "いまどこにいる？"){
                        $('#content').val("");
                    }
                });
                $("#content").skOuterClick(function(){
                    if($('#content').val() == ""){
                        $('#content').val("いまどこにいる？");
                        $('#content').css('color', '#a1a1a1');
                    }
                });
                $("#content").keyup(function(){
                    if($('#content').val() != ""){
                        $('#content').css('color', '#000000');
                    }
                });
                $("#user_name").click(function(){
                    if($('#user_name').val() == "User名"){
                        $('#user_name').val("");
                    }
                });
                $("#user_name").keyup(function(){
                    if($('#user_name').val() != ""){
                        $('#user_name').css('color', '#000000');
                    }
                });
                $("#user_name").skOuterClick(function(){
                    if($('#user_name').val() == ""){
                        $('#user_name').val("User名");
                        $('#user_name').css('color', '#a1a1a1');
                    }
                });
                $("#path_name").click(function(){
                    if($('#path_name').val() == "Path名"){
                        $('#path_name').val("");
                    }
                });
                $("#path_name").keyup(function(){
                    if($('#path_name').val() != ""){
                        $('#path_name').css('color', '#000000');
                    }
                });
                $("#path_name").skOuterClick(function(){
                    if($('#path_name').val() == ""){
                        $('#path_name').val("Path名");
                        $('#path_name').css('color', '#a1a1a1');
                    }
                });
                $("#req_key1").click(function(){
                    if($('#req_key1').val() == "User"){
                        $('#req_key1').val("");
                    }
                });
                $("#req_key1").keyup(function(){
                    if($('#req_key1').val() != ""){
                        $('#req_key1').css('color', '#000000');
                    }
                });
                $("#req_key1").skOuterClick(function(){
                    if($('#req_key1').val() == ""){
                        $('#req_key1').val("User");
                        $('#req_key1').css('color', '#a1a1a1');
                    }
                });
                $("#req_key2").click(function(){
                    if($('#req_key2').val() == "Path"){
                        $('#req_key2').val("");
                    }
                });
                $("#req_key2").keyup(function(){
                    if($('#req_key2').val() != ""){
                        $('#req_key2').css('color', '#000000');
                    }
                });
                $("#req_key2").skOuterClick(function(){
                    if($('#req_key2').val() == ""){
                        $('#req_key2').val("Path");
                        $('#req_key2').css('color', '#a1a1a1');
                    }
                });
            });
            function InputCharCheck( minnum, target, report ) {
               var diff = minnum - document.getElementById("delete_code").value.length;
               var reps, repc;
               if( diff > 0 ) {
                  // 足りない場合
                  reps = "（あと " + diff + " 文字足りません）";
                  repc = "red";
               }
               else if(diff == 0) {
                  // 足りた場合
                  reps = "OK！";
                  repc  = "blue";
               }else{
                  // 足りた場合
                diff = diff * -1;
                  reps = "（" + diff + " 文字オーバー）";
                  repc = "red";
               }
               document.getElementById(report).innerHTML = reps;
               document.getElementById(report).style.color = repc;
            }
            function polyline_check(){
                if(switch_status == 1){
                    polyline.setVisible(true);
                }
            }
        </script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-64495011-2', 'auto');
          ga('send', 'pageview');

        </script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/whispath.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body onLoad="button_click(); get_param()">
        <?php include_once("analyticstracking.php") ?>
        <div class="container" id="title">
            <span style="float:left">
                <a href="http://web.sfc.keio.ac.jp/~ni9zhang/seichitechou/index.php"><h1><font color=2fcdb4>漫步-Walk in the Story</font></h1></a>
            </span>
            <span style="float:right">
                &nbsp;
                <form name="form1" action="User_Login.php" method="post">
                    <?php 
                    if (isset($_SESSION['userID']))
                    {
                        echo '<br>user:'. $_SESSION['userID'] .'</br>';
                    }
                    else
                    {
                        echo "<input type=\"text\" id=\"req_key1\" name=\"req_key1\" size=\"10\" style=\"color:#a1a1a1\" value=\"User\" /> \n";
                        echo "<input type=\"text\" id=\"req_key2\" name=\"req_key2\" size=\"10\" style=\"color:#a1a1a1\" value=\"Password\" /> \n";
                        echo "<input id=\"login\" type=\"submit\" value=\"Login\"/>\n";
                    }
                    ?>                   
                    
                </form>
            </span>
        </div>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">TimeLine</a> 
                    <a class="navbar-brand" href="weibo_view.php">Map</a>
                    <a class="navbar-brand" href="edit_view.php">Edit</a>
				</div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="http://www.fromfpf.net">From4.5</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse --> 
                </div>
            </div>
            <!-- /.container-fluid --> 
        </nav>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://iwb.jp/s/js/jquery.skOuterClick.js"></script> 
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="js/bootstrap.min.js"></script>
        
        <div class="container">
            <form name="posting" id="posting">
                &nbsp;
				<br>
				<?php
					if (isset($_SESSION['userID']))
					{
						echo "<input type=\"text\" id = \"user_name\" name=\"user_name\" size=\"25\" style=\"color:#a1a1a1\" value=\"".$_SESSION['userID']."\"/>";
					}
					else
					{
						echo "<input type=\"text\" id = \"user_name\" name=\"user_name\" size=\"25\" style=\"color:#a1a1a1\" value=\"User名\"/>";
					}
				?>
                <input type="text" id="path_name" name="path_name" size="25" style="color:#a1a1a1" value="Path名" /><br>
                <input type="text" id="latitude" name="latitude" size="25" value=""/>
                <input type="text" id="longitude" name="longitude" size="25" value=""/><br>
                <textarea name="content" id="content" onkeyup="strlength(value)" style="color:#a1a1a1" cols="51" rows="3">いまどこにいる？</textarea><br>
                <div id="idStrlength" style="margin-left:350px;";>150</div>
                編集用コード：<input type="password" id = "delete_code" name="delete_code" size="10" onkeyup="InputCharCheck(8,'sample1','report1');" value="" /><span id="report1">（半角英数8文字）</span>
                <input type="file" id="upfile" name="upfile" size="30" style="display:none;" onchange="$('#fake_input_file').val($(this).val()); $('#fake_input_file').show();">
                <img src="camera.png" value="ファイル選択" style="margin-left:30px;" onClick="$('#upfile').click();">
                <input id="fake_input_file" readonly type="text" style="display:none;">
                <input type="hidden" name="MAX_FILE_SIZE" value="0" />
                <input type="file" id="upfile2" name="upfile2" size="30" style="display:none;" onchange="$('#fake_input_file2').val($(this).val()); $('#fake_input_file2').show(); $('#content').val('sound_file'); $('#content').css('color', '#000000');">
                <img src="sound.png" value="ファイル選択" style="margin-left:10px;" onClick="$('#upfile2').click();">
                <input id="fake_input_file2" readonly type="text" style="display:none;">
                <!--id = "toukou"--> 
                <input type="button" value="投稿" style="margin-left:10px;" onclick="send_message()" />
                <input type="button" value="編集を終了して説明文を書く" style="margin-left:10px;" onclick="finish_tracking()" />
                <br>まずはじめに左クリックで位置を選択して、コンテンツを投稿してください。カメラマークから写真が、音声マークから音声がそれぞれアップロードできます。また、地図上で右クリックするとpathの登録ができます。投稿内容がなくても曲がり角などを設定したい時はご活用ください。青い点は左クリックすると削除することができます。コンテンツはTimeLineから削除できます。<br>
                <div style="float:left"><font style="font-size:20px">Path&nbsp;</font></div>
                <div style="float:left" class="onoffswitch" id="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
                    <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div><br>&nbsp;
                <div id="map" style=" width: device-width; height: 500px;"></div>
            </form>
            <div id="whispath00"></div>
            <script type="text/javascript"> 
                var n =[];
                var user_name = [];
                var path_name = [];
                var content = [];
                var lat = [];
                var lng = [];
                var center_lat;
                var center_lng;
                var file_list = [];
                var picture = [];
                var path_line_arr = [];
                var polyline;
                var switch_status = -1;
                
                var Marker;
                var req_key1;
                var req_key2;
                var map;
                
                var image = new google.maps.MarkerImage('dot.png',
                    new google.maps.Size(50,36),
                    new google.maps.Point(0,0),
                    new google.maps.Point(6,7)
                );
                
                //検索のデータ渡し
                function send_data(){
                    var req_key1 = document.getElementById("req_key1").value;
                    var req_key2 = document.getElementById("req_key2").value;
                    if(req_key1 == "User"){
                        req_key1 = "";
                    }
                    if(req_key2 == "Path"){
                        req_key2 = "";
                    }
                    window.location.href = "search_result_map.html?user_name=" + req_key1 + "&path_name=" + req_key2 + "&id=";
                }
                
                //path作成の終了
                function finish_tracking(){
                    myPass = confirm("移動しますか？");
                    if (myPass == true){
                        user_name = document.getElementById("user_name").value;
                        path_name = document.getElementById("path_name").value;
                        delete_code = document.getElementById("delete_code").value;
                        window.location.href = "finish.html?user_name=" + user_name + "&path_name=" + path_name + "&hoge=" + delete_code;
                    }else{
                    }
                }
                
                //URLからパラメータの取得
                function get_param(){
                    var url_prm = new Object;
                    var prms = location.search.substring(1).split('&');
                    for(var i=0;prms[i];i++) {
                        var kv = prms[i].split('=');
                        url_prm[kv[0]]=kv[1];
                    }
                    var req1 = url_prm.user_name;
                    var req2 = url_prm.path_name;
                    var req3 = url_prm.hoge;
                    req_key1 = decodeURI(req1);
                    req_key2 = decodeURI(req2);
                    req_key3 = decodeURI(req3);
                    if(req_key1 != ""){
                         document.getElementById("user_name").value = req_key1;
                    }
                    if(req_key2 != ""){
                        document.getElementById("path_name").value = req_key2;
                    }
                    if(req_key3 == undefined || req_key3 == "undefined" || req_key3 == ""){
                         document.getElementById("delete_code").value = "";
                    }
                    if(req_key3 != ""){
                        document.getElementById("delete_code").value = req_key3;
                        InputCharCheck(8,'sample1','report1');
                    }
                    get_data(req_key1, req_key2);
                }
                
                //phpに送ってデータの取得
                function get_data(req_key1, req_key2){
                    $.ajax({
                        type:"post",
                        async:false,
                        cache:false,
                        data:{
                            user_name : req_key1,
                            path_name : req_key2,
                        },
                        dataType:"json",
                        url: "edit.php",
                        success: function(data){
                            var data_array = data;
                            for(var i = 0; i <= data_array[0].length; i++){
                                n.push(data_array[0][i]);
                                user_name.push(data_array[1][i]);
                                path_name.push(data_array[2][i]);
                                content.push(data_array[3][i]);
                                lat.push(data_array[4][i]);
                                lng.push(data_array[5][i]);
                                file_list.push(data_array[6][i]);
                            }
                            center_lat = data_array[4][0];
                            center_lng = data_array[5][0];
                        },
                        error: function(){
                            alert("エラー");
                        }
                    });
                    button_click();
                }
                
                /* アイコン設定 */
                var image2 = new google.maps.MarkerImage('fukidashi.png',
                        new google.maps.Size(50,36),
                        new google.maps.Point(0,0),
                        new google.maps.Point(10,35)
                );
                var image3 = new google.maps.MarkerImage('sound.png',
                        new google.maps.Size(50,36),
                        new google.maps.Point(0,0),
                        new google.maps.Point(10,35)
                );
                
                //位置情報を取得
                function button_click(){
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
                    } else {
                        document.getElementById("latitude").value =  "Geolocationが利用できません";
                        document.getElementById("longitude").value =  "Geolocationが利用できません";
                    }
                }

                function successCallback(position) {
                    //成功したときの処理
                    document.getElementById("latitude").value =  position.coords.latitude;
                    document.getElementById("longitude").value =  position.coords.longitude;
                    var latitude = document.getElementById("latitude").value;
                    var longitude = document.getElementById("longitude").value;
                    initialize(latitude, longitude);
                }
                function errorCallback(error) {
                   //失敗のときの処理
                   document.getElementById("latitude").value = 'Geolocationが利用できません';
                   document.getElementById("longitude").value = 'Geolocationが利用できません';
                   initialize();
                }
                function initialize(latitude, longitude) {
                    var latlng;
                    if(latitude == null && center_lat != null){
                        latlng = new google.maps.LatLng(center_lat, center_lng);
                    }else if(latitude == null && center_lat == null){
                        latlng = new google.maps.LatLng(35.658704,139.745408);
                    }else if(latitude != null && center_lat != null){
                        latlng = new google.maps.LatLng(center_lat, center_lng);
                    }else{
                        latlng = new google.maps.LatLng(latitude,longitude);
                    }
                    var opts = {
                        zoom: 18,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }

                    map = new google.maps.Map(document.getElementById("map"),opts);
                    positioning(map);

                    //地図クリックイベントの登録
                    google.maps.event.addListener(map, 'click',function(event) {
                        if (Marker){
                            Marker.setMap(null);
                            Marker = new google.maps.Marker({
                               position: event.latLng,
                               draggable: true,
                               map: map
                            });
                            infotable3(Marker.getPosition().lat(),
                            Marker.getPosition().lng(),map.getZoom());
                        }else{
                            Marker = new google.maps.Marker({
                               position: event.latLng,
                               draggable: true,
                               map: map
                            });
                            infotable(Marker.getPosition().lat(),
                            Marker.getPosition().lng(),map.getZoom());
                        }
                        //マーカードラッグイベントの登録
                        google.maps.event.addListener(Marker,'dragend',
                        function(event) {
                            infotable3(Marker.getPosition().lat(),
                            Marker.getPosition().lng(),map.getZoom());
                        })
                        //地図ズームチェンジイベントの登録
                        google.maps.event.addListener(map, 'zoom_changed',
                        function(event) {
                            infotable(Marker.getPosition().lat(),
                            Marker.getPosition().lng(),map.getZoom());
                        })
                    })
                    google.maps.event.addListener(map, "rightclick", function(event) {
                        Marker = new google.maps.Marker({
                            position: event.latLng,
                            icon: image,
                            draggable: true,
                            map: map
                        });
                        infotable2(Marker.getPosition().lat(),
                        Marker.getPosition().lng(),map.getZoom());
                        send_position();
                    });

                    //HTMLtagを更新
                    function infotable(ido,keido,level){
                        document.getElementById('latitude').value = ido;
                        document.getElementById('longitude').value = keido;
                        latlng = new google.maps.LatLng(ido, keido);
                        path_line_arr.push(latlng);
                        polyline.setMap(null); 
                        polylineOpts = {
                            map: map,
                            path: path_line_arr,
                            strokeColor: "blue"
                        };
                        polyline = new google.maps.Polyline(polylineOpts);
                    };
                    //HTMLtagを更新
                    function infotable2(ido,keido,level){
                        document.getElementById('latitude').value = ido;
                        document.getElementById('longitude').value = keido;
                        latlng = new google.maps.LatLng(ido, keido);
                        path_line_arr.push(latlng);
                        polylineOpts = {
                            map: map,
                            path: path_line_arr,
                            strokeColor: "blue"
                        };
                        polyline = new google.maps.Polyline(polylineOpts);
                    };
                    //HTMLtagを更新
                    function infotable3(ido,keido,level){
                        document.getElementById('latitude').value = ido;
                        document.getElementById('longitude').value = keido;
                        latlng = new google.maps.LatLng(ido, keido);
                        path_line_arr[path_line_arr.length-1] = latlng;
                        polyline.setMap(null); 
                        polylineOpts = {
                            map: map,
                            path: path_line_arr,
                            strokeColor: "blue"
                        };
                        polyline = new google.maps.Polyline(polylineOpts);
                    };
                };
                
                function polyline_check(){
                    if(switch_status == 1){
                        polyline.setVisible(true);
                    }else{
                        polyline.setVisible(false);
                    }
                }
                function send_position(){
                    var user_name = document.getElementById("user_name").value;
                    var path_name = document.getElementById("path_name").value;
                    var content = document.getElementById("content").value;
                    var latitude = document.getElementById("latitude").value;
                    var longitude = document.getElementById("longitude").value;
                    var delete_code = document.getElementById("delete_code").value;
                    if(delete_code == ""){
                       alert("編集用コードが登録されていません。後から投稿を削除できるように、コードを設定してください"); 
                    }else if(user_name == "" || path_name == "" || user_name == "User名" || path_name == "Path名"){
                       alert("user名とpath名を書いてください"); 
                    }else if(latitude == "Geolocationが利用できません"){
                       alert("位置情報が取得できていません。端末の設定から位置情報の取得を許可してください"); 
                    }else{
                        $.ajax({
                                type: "POST",
                                url: "regist.php",
                                data:  {
                                    "user_name": user_name,
                                    "path_name": path_name,
                                    "latitude": latitude,
                                    "longitude": longitude,
                                    "delete_code": delete_code
                                }
                        });
                    }
                }
                
                function send_message(){
                    var user_name = document.getElementById("user_name").value;
                    var path_name = document.getElementById("path_name").value;
                    var content = document.getElementById("content").value;
                    var latitude = document.getElementById("latitude").value;
                    var longitude = document.getElementById("longitude").value;
                    var delete_code = document.getElementById("delete_code").value;
                    var fd = new FormData();
                    fd.append('user_name', user_name);
                    fd.append('path_name', path_name);
                    fd.append('content', content);
                    fd.append('latitude', latitude);
                    fd.append('longitude', longitude);
                    fd.append('delete_code', delete_code);
                    fd.append('upfile', $('input[type=file]')[0].files[0]);
                    fd.append('upfile2', $('input[type=file]')[1].files[0]);
                    if(user_name == "" || path_name == "" || user_name == "User名" || path_name == "Path名"){
                       alert("user名とpath名を書いてください"); 
                    }else if(latitude == "Geolocationが利用できません" || (latitude == 0 && longitude ==0)){
                       alert("位置情報が取得できていません。端末の設定から位置情報の取得を許可してください"); 
                    }else if(content == "" || content == "いまどこにいる？"){
                       alert("投稿内容がエラーです"); 
                    }else if(delete_code == ""){
                       alert("編集用コードが登録されていません。後から投稿を削除できるように、コードを設定してください"); 
                    }else{
                        $.ajax({
                                type: "POST",
                                url: "regist.php",
                                data: fd,
                                processData: false,
                                contentType: false,
                                success: function(){
                                    window.location.href = "edit.html?user_name=" + user_name + "&path_name=" + path_name + "&hoge=" + delete_code;
                                },
                                error: function(){
                                    alert("エラー");
                                }
                                
                            });
                    }
                }
                
                //写真マーカー作成
                function createMarker(id_select,latlng,marker,map,message,path_name_req){
                    google.maps.event.addListener(marker, 'mouseover', function() {
                        infoWindow.setPosition(latlng);
                        infoWindow.open(map,marker);   
                    });
                    google.maps.event.addListener(marker, 'mouseout', function() {
                        infoWindow.close();   
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        var delete_code2 = window.prompt("削除しますか？\n編集用コードを入力", "");
                        if(delete_code2 == null){
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "delete.php",
                                data:  {
                                    "id_select": id_select,
                                    "delete_code2": delete_code2
                                },             
                                success: function(data){
                                    if(data == "error"){
                                        alert("編集用コードが違います");
                                    }else{
                                        alert("削除しました");
                                        window.location.reload();
                                    }
                                },
                                error: function(){
                                    alert("エラー");
                                    window.location.reload();
                                }
                            });
                        }
                    });

                    var offset = new google.maps.Size(-235, 0);
                    var iwopts = {
                      content: message,
                      positon: latlng,
                      pixelOffset: offset
                    };
                    var infoWindow = new google.maps.InfoWindow(iwopts);
                } 
                //コメントマーカー作成
                function createCoMarker(id_select,latlng,marker,map,message,path_name_req){
                    google.maps.event.addListener(marker, 'mouseover', function() {
                        infoWindow.setPosition(latlng);
                        infoWindow.open(map,marker);   
                    });
                    google.maps.event.addListener(marker, 'mouseout', function() {
                        infoWindow.close();   
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        var delete_code2 = window.prompt("削除しますか？\n編集用コードを入力", "");
                        if(delete_code2 == null){
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "delete.php",
                                data:  {
                                    "id_select": id_select,
                                    "delete_code2": delete_code2
                                },             
                                success: function(data){
                                    if(data == "error"){
                                        alert("編集用コードが違います");
                                    }else{
                                        alert("削除しました");
                                        window.location.reload();
                                    }
                                },
                                error: function(){
                                    alert("エラー");
                                    window.location.reload();
                                }
                            });
                        }
                    });

                    var offset = new google.maps.Size(0, 0);
                    var iwopts = {
                      content: message,
                      positon: latlng,
                      pixelOffset: offset
                    };
                    var infoWindow = new google.maps.InfoWindow(iwopts);
                } 
                
                //ポジションマーカー作成(削除)
                function createPoMarker(id_select,marker,map){
                    google.maps.event.addListener(marker, 'click', function() {
                        delete_button(id_select);
                    });
                } 
                
                //削除
                function delete_button(id_select){
                    var user_name = document.getElementById("user_name").value;
                    var path_name = document.getElementById("path_name").value;
                    if(req_key3 != ""){
                        var delete_code2 = document.getElementById("delete_code").value;
                        $.ajax({
                            type: "POST",
                            url: "delete.php",
                            data:  {
                                "id_select": id_select,
                                "delete_code2": delete_code2
                            },             
                            success: function(data){
                                if(data == "error"){
                                    alert("エラー");
                                    window.location.href = "edit.html?user_name=" + user_name + "&path_name=" + path_name + "&hoge=";
                                }else{
                                    alert("削除しました");
                                    window.location.reload();
                                }
                            },
                            error: function(){
                                alert("エラー");
                                window.location.reload();
                            }
                        });
                    }else{
                        var delete_code2 = window.prompt("編集用コードを入力", "");
                        if(delete_code2 == null){
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "delete.php",
                                data:  {
                                    "id_select": id_select,
                                    "delete_code2": delete_code2
                                },             
                                success: function(data){
                                    if(data == "error"){
                                        alert("編集用コードが違います");
                                    }else{
                                        alert("削除しました");
                                        window.location.reload();
                                    }
                                },
                                error: function(){
                                    alert("エラー");
                                    window.location.reload();
                                }
                            });
                        }
                    }

                }
                
                //音源クリックマーカー作成
                function createSoMarker(id_select,marker,map){
                    google.maps.event.addListener(marker, "click", function(){
                        sound = new Audio("files/" + id_select + ".wav");
                        var ua = window.navigator.userAgent.toLowerCase();
                        if (ua.indexOf('firefox') != -1){
                            alert("Firefoxだと誤動作します。\n別のブラウザをご利用ください");
                            sound.play();
                        }else{
                            sound.autoplay = true;
                            sound.load();
                            $("body").one("touchstart", function () {
                                sound.play();
                            })
                        }
                    })
                }
                
                function positioning(map){
                    for(var i=n.length; i>=0; i= i -1){
                        var contentStr = "";
                        for(var j=0; j<=file_list.length; j++){
                            if(n[i] == file_list[j]){
                                contentStr = '<p><img src="files/' + n[i] + '.jpeg" height="100"/></p>';
                                picture[i]=
                                new google.maps.MarkerImage(
                                    'files/' + n[i] + '.jpeg',
                                    new google.maps.Size(500,360),
                                    new google.maps.Point(0,0),
                                    new google.maps.Point(0,0),
                                    new google.maps.Size(50, 50)
                                );
                            }
                        }
                        if(content[i] == "sound_file"){
                            var latlng =  new google.maps.LatLng(lat[i],lng[i]);
                            path_line_arr.push(latlng);
                            var message = user_name[i] + "：" + content[i];
                            var marker = new google.maps.Marker({
                                icon: image3,
                                position: latlng,
                                zIndex: -i,
                                map: map
                            });
                            path_line_arr.push(latlng);
                            var path_name_req = path_name[i];
                            createSoMarker(n[i],marker,map);
                        }else if(contentStr != ""){
                            var latlng =  new google.maps.LatLng(lat[i],lng[i]);
                            var marker = new google.maps.Marker({
                                icon: picture[i],
                                position: latlng,
                                zIndex: -i,
                                map: map
                            });
                            var message = user_name[i] + "：" + content[i] + contentStr;
                            var path_name_req = path_name[i];
                            createMarker(n[i],latlng,marker,map,message,path_name_req);
                        }else if(content[i] != ""){
                            var latlng =  new google.maps.LatLng(lat[i],lng[i]);
                            path_line_arr.push(latlng);
                            var message = user_name[i] + "：" + content[i];
                            var marker = new google.maps.Marker({
                                icon: image2,
                                position: latlng,
                                zIndex: -i,
                                map: map
                            });
                            var path_name_req = path_name[i];
                            createCoMarker(n[i],latlng,marker,map,message,path_name_req);
                        }else{
                            var latlng =  new google.maps.LatLng(lat[i],lng[i]);
                            var marker = new google.maps.Marker({
                                icon: image,
                                position: latlng,
                                map: map
                            });
                            path_line_arr.push(latlng);
                            createPoMarker(n[i],marker,map);
                        }                                         
                    }
                    // Polylineの初期設定
                    var polylineOpts = {
                        map: map,
                        path: path_line_arr,
                        strokeColor: "blue",
                        visible: false
                    };
                    polyline = new google.maps.Polyline(polylineOpts);
                }
            </script> 
        </div>
    </body>
</html>