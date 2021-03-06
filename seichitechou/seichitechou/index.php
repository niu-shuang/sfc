<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <title>漫步-Walk in the Story</title>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDfBkCLoapAFTFgfahL-ra9vSseSDEDaq4&sensor=false"></script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/whispath.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body onload="button_click(); get_data(); get_param(); send_check()">
        <?php include_once("analyticstracking.php") ?>
        <div class="container" id="title">
            <span style="float:left">
                <a href="http://web.sfc.keio.ac.jp/~ni9zhang/seichitechou/index.php"><h1><font color=2fcdb4>漫步-Walk in the Story</font></h1></a>
            </span>
            <span style="float:right">
                &nbsp;<br><input id="Regist" type="button" value="Regist" onclick="Regist()" /><br>
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
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Timeline</a> 
                    <a class="navbar-brand" href="weibo_view.php">Map</a>
					<a class="navbar-brand" href="edit_view.php">Edit</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <!-- /.navbar-collapse --> 
                <!-- /.container-fluid -->

                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                <script src="http://iwb.jp/s/js/jquery.skOuterClick.js"></script>
                <script src="jquery.bottom-1.0.js" type="text/javascript"></script>
                
                <!-- Include all compiled plugins (below), or include individual files as needed --> 
                <script src="js/bootstrap.min.js"></script>
                <script type="text/javascript">
                    function map_appear(){
                        document.getElementById("map_canvas").style.display="block";
                        var latitude = document.getElementById("latitude").value;
                        var longitude = document.getElementById("longitude").value;
                        initialize(latitude, longitude);
                    }

					function Regist(){
						window.location.href = "User_Register.php";
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
                            if(send_status == "false"){
                                send_status = "true";
                            }else{
                                send_status = "false";
                            }
                            send_check();
                        });
                        $("#form_btn").click(function(e){
                            e.stopPropagation();
                            $('#posting').show();
                            $('#form_btn').css('display', 'none');
                            $('#form_btn1').css('display', 'none');
                            $('#form_btn2').css('display', 'none');
                        });
                        $("#posting").skOuterClick(function(){
                            $('#posting').css('display', 'none');
                            $('#form_btn').show();
                            $('#form_btn1').show();
                            $('#form_btn2').show();
                            if($('#content').val() == ""){
                                $('#form_btn').val("いまどこにいる？");
                            }else{
                                $('#form_btn').val($('#content').val());
                            }
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
                    
                        
                var diff;
                function InputCharCheck( minnum, target, report ) {
                   diff = minnum - document.getElementById("delete_code").value.length;
                   var reps, repc;
                   if( diff > 0 ) {
                      // 足りない場合
                      reps = "（ " + diff + " 文字足りません）";
                      repc = "red";
                   }else if(diff == 0) {
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

                </script>
                <script>
                  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                  ga('create', 'UA-64495011-2', 'auto');
                  ga('send', 'pageview');

                </script>
            </div>
        </nav>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <br id="form_btn1">
                    <input type="text" id="form_btn" onclick="button_click()" size="35" value="いまどこにいる？">
                    <p id="form_btn2">&nbsp;</p>
                    <form name="posting" id="posting" style="display:none;">
                        &nbsp;<br>
                        <textarea name="content" id="content" onkeyup="strlength(value)" cols="35" rows="3"></textarea>
                        <div id="idStrlength" style="float:right";>150</div>
                        <br>
                        <input type="text" id = "user_name" name="user_name" size="25" style="color:#a1a1a1" value="User名" />
                        &nbsp;
                        <input type="file" id="upfile" name="upfile" size="30" style="display:none;" onchange="$('#fake_input_file').val($(this).val()); $('#fake_input_file').show();">
                        <img id="camera" src="camera.png" value="ファイル選択" onClick="$('#upfile').click();">
                        <input id="fake_input_file" readonly type="text" style="display:none;">
                        <input type="text" id = "path_name" name="path_name" size="25" style="color:#a1a1a1" value="Path名" />
                        
                        <input type="text" id="latitude" name="latitude" size="25" value="" style="display : none"/>
                        <input type="text" id="longitude" name="longitude" size="25" value="" style="display : none"/>
                        <div id="map_canvas" style="width:267px; height:300px;"></div>
                         編集用コード：<input type="password" id = "delete_code" name="delete_code" size="10" onkeyup="InputCharCheck(8,'sample1','report1');" value="" /><span id="report1">（半角英数8文字）</span><br>
                        <div style="float:left" id="onoffswitch1">位置情報送信&nbsp;</div>
                        <div style="float:left" class="onoffswitch" id="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch">
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                        <input style="float:right" id = "toukou" type="button" value="投稿" onclick="send_message()" /><br><br>
                        <div id="finish_button"><input style="float:left" type="button" value="終了する" onclick="finish_tracking()" /><br><br></div>
                    </form>
                    
                    
                    <script type="text/javascript">
                        
                        var user_name;
                        var path_name;
                        var delete_code;
                        
                        //位置情報取得初期化
                        var send_status = "false";
                        
                        //URLからパラメータの取得
                        function get_param(){
                            var url = location.href;
                            if(url.indexOf("?") == -1){
                                document.getElementById("finish_button").style.display = "none";
                            }else{
                                var url_prm = new Object;
                                var prms = location.search.substring(1).split('&');
                                for(var i=0;prms[i];i++) {
                                    var kv = prms[i].split('=');
                                    url_prm[kv[0]]=kv[1];
                                }
                                var req1 = url_prm.user_name;
                                var req2 = url_prm.path_name;
                                var req3 = url_prm.hoge;
                                var req4 = url_prm.send_status;
                                req_key1 = decodeURI(req1);
                                req_key2 = decodeURI(req2);
                                req_key3 = decodeURI(req3);
                                req_key4 = decodeURI(req4);
                                if(req_key1 == "undefined"){
                                    document.getElementById("user_name").value = "User名";
                                }else{
                                    document.getElementById("user_name").value = req_key1;
                                    document.getElementById("finish_button").style.display = "";
                                } 
                                if(req_key2 == "undefined"){
                                    document.getElementById("path_name").value = "Path名";
                                }else{
                                    document.getElementById("path_name").value = req_key2;
                                }
                                if(req_key3 == "undefined"){
                                    document.getElementById("delete_code").value = "";
                                }else{
                                    document.getElementById("delete_code").value = req_key3;
                                    InputCharCheck(8,'sample1','report1');
                                }
                                if(req_key4 != ""){
                                    send_status = req_key4;
                                }
                            }
                        }
                        
                        //位置情報の送信するかチェック
                        function send_check(){
                            if(send_status == "true"){
                                document.posting.elements["onoffswitch"].checked = true;
                                get_position_start();
                            }else{
                                document.posting.elements["onoffswitch"].checked = false;
                                get_position_stop();
                            }
                        }
                        
                        var get_position;
                        function get_position_start(){
                            send_status = "true";
                            //関数button_clickとsend_positionを10000ミリ秒間隔で呼び出す
                            get_position = setInterval("button_click(), send_position()",10000);
                        }
                        function get_position_stop(){
                            send_status = "false";
                            document.posting.elements["onoffswitch"].checked = false;
                            if (get_position) {
                                clearInterval(get_position);
                            }
                        }
                        //path作成の終了
                        function finish_tracking(){
                            myPass = confirm("終了しますか？");
                            if (myPass == true){
                                user_name = document.getElementById("user_name").value;
                                path_name = document.getElementById("path_name").value;
                                delete_code = document.getElementById("delete_code").value;
                                window.location.href = "finish.html?user_name=" + user_name + "&path_name=" + path_name + "&hoge=" + delete_code;
                            }else{
                            }
                        }
                        
                        //位置情報の送信
                        function send_position(){
                            user_name = document.getElementById("user_name").value;
                            path_name = document.getElementById("path_name").value;
                            var latitude = document.getElementById("latitude").value;
                            var longitude = document.getElementById("longitude").value;
                            delete_code = document.getElementById("delete_code").value;
                            if(user_name == "" || path_name == "" || user_name == "User名" || path_name == "Path名"){
                               alert("User名とPath名を書いてください"); 
                               get_position_stop();
                            }else if(latitude == "Geolocationが利用できません" || latitude == "" || (latitude == 0 && longitude ==0)){
                               alert("位置情報が取得できていません。端末の設定から位置情報の取得を許可してください"); 
                               get_position_stop();
                            }else if(delete_code == ""){
                               alert("削除用コードが登録されていません。後から投稿を削除できるように、コードを設定してください"); 
                               get_position_stop();
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
                        
                        //位置情報を取得
                        function button_click(){
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
                            } else {
                                document.getElementById("latitude").value =  "Geolocationが利用できません";
                                document.getElementById("longitude").value =  "Geolocationが利用できません";
                                alert("位置情報が取得できません。端末の設定から許可してください。");
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
                            alert("位置情報が取得できません。端末の設定から許可してください。");
                        }
                        function initialize(latitude, longitude) {
                            var Marker;
                            var map;
                            var latlng;
                            var image = new google.maps.MarkerImage('dot.png',
                                new google.maps.Size(50,36),
                                new google.maps.Point(0,0),
                                new google.maps.Point(6,7)
                            );
                            
                            if(latitude == null){
                                latlng = new google.maps.LatLng(35.658704,139.745408);
                            }else{
                                latlng = new google.maps.LatLng(latitude,longitude);
                            }
                            var opts = {
                                zoom: 18,
                                center: latlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }

                            map = new google.maps.Map(document.getElementById("map_canvas"),opts);
                            
                            var marker= new google.maps.Marker({
                                   icon: image,
                                   position: latlng,
                                   map: map,
                            });

                            //地図クリックイベントの登録
                            google.maps.event.addListener(map, 'click',
                            function(event) {
                                if (Marker){Marker.setMap(null)};
                                Marker = new google.maps.Marker({
                                   position: event.latLng,
                                   draggable: true,
                                   map: map
                                });
                                infotable(Marker.getPosition().lat(),
                                Marker.getPosition().lng(),map.getZoom());
                                geocode();
                                //マーカードラッグイベントの登録
                                google.maps.event.addListener(Marker,'dragend',
                                function(event) {
                                    infotable(Marker.getPosition().lat(),
                                    Marker.getPosition().lng(),map.getZoom());
                                    geocode();
                                })
                                //地図ズームチェンジイベントの登録
                                google.maps.event.addListener(map, 'zoom_changed',
                                function(event) {
                                    infotable(Marker.getPosition().lat(),
                                    Marker.getPosition().lng(),map.getZoom());
                                })
                            })

                            //HTMLtagを更新
                            function infotable(ido,keido,level){
                                document.getElementById('latitude').value = ido;
                                document.getElementById('longitude').value = keido;
                            };
                        };
                        
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
                            if(diff != 0){
                               alert("編集用コードが不正です。後から投稿を削除できるように、コードを設定してください"); 
                            }else if(user_name == "" || path_name == "" || user_name == "User名" || path_name == "Path名" ){
                               alert("user名とpath名を書いてください"); 
                            }else if(content == "" || content == "いまどこにいる？"){
                               alert("投稿内容がエラーです"); 
                            }else if(latitude == "" || latitude == "Geolocationが利用できません" || (latitude == 0 && longitude ==0)){
                               alert("位置情報が取得できていません。端末の設定から位置情報の取得を許可してください"); 
                            }else{
                                $.ajax({
                                        type: "POST",
                                        url: "regist.php",
                                        data: fd,
                                        processData: false,
                                        contentType: false,
                                        success: function(){
                                            window.location.href = "index.php?user_name=" + user_name + "&path_name=" + path_name + "&hoge=" + delete_code + "&send_status=" + send_status;
                                        }
                                    });
                            }
                        }
                        
                        function like_button(id_select){
                            $.ajax({
                                    type: "POST",
                                    url: "like.php",
                                    data:  {
                                        "id_select": id_select,
                                    },             
                                    success: function(){
                                        window.location.reload();
                                    }
                            });
                        }
                        
                        function delete_button(id_select){
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
                        //ajaxでindex.phpからデータ取得
                        var n = [];
                        var user_name = [];
                        var path_name = [];
                        var created_at = [];
                        var content = [];
                        var contentStr = [];
                        var likes = [];
                        
                        var i_limit = 0;
                        var i_count;

                        
                        function get_data(){
                            $.ajax({
                                type:"get",
                                async:false,
                                cache:false,
                                dataType:"json",
                                url: "index_get.php",
                                success: function(data){
                                    var data_array = data;
                                    for(var i = 0; i <= data_array[0].length; i++){
                                        n.push(data_array[0][i]);
                                        user_name.push(data_array[1][i]);
                                        path_name.push(data_array[2][i]);
                                        created_at.push(data_array[3][i]);
                                        content.push(data_array[4][i]);
                                        contentStr.push(data_array[5][i]);
                                        likes.push(data_array[6][i]);
                                    }
                                },
                                error: function(){
                                    alert("エラー");
                                }
                            });
                            output(i_limit);
                        }
                        
                        //書き出し
                        function output(i_limit){
                            var load_count = 0;
                            for(var i = i_limit; i <= n.length; i++){
                                if(content[i] != undefined && content[i] != "" && load_count < 30){
                                    if(content[i] == "sound_file"){
                                        content[i] = "音声ファイルの投稿です。Radio表示で聞くことができます。";
                                    }
                                    var div_element = document.createElement("div");
                                    div_element.innerHTML = 
                                        '<div style="border-style: solid ; border-width: 1px; border-color: #f2f2f2; background-color: white;"><p><a style="color: #000000; font-weight:bold;" href="search_result_map.html?user_name=' + user_name[i] + '&path_name=&id=' + n[i] + '"; return false;>' + user_name[i] + '</a> <span style="color: #a1a1a1;">(<a style="color: #a1a1a1;" href="search_result_map.html?user_name=&path_name=' + path_name[i] + '&id=' + n[i] + '"; return false;>' + path_name[i] + '</a>)</span>&nbsp;&nbsp;' + created_at[i] + '<br>' + contentStr[i] + '<div style="text-align:center;">「' + content[i] + '」</div><span style="float:left;"><a onclick="like_button(' + n[i] + ')">いいね！</a>' + likes[i] + '件</span><span style="float:right;"><a style="font-size:10px; color:#a1a1a1;" onclick="delete_button(' + n[i] + ')">削除&nbsp;</a></span><br></p></div>';
                                    var parent_object = document.getElementById("result_print_area");
                                    parent_object.appendChild(div_element);
                                    load_count ++;
                                    i_count = i;
                                }
                            }
                        }
                        
                        //下までスクロールすると読み込み
                        $(function() {
                            $(window).bottom({proximity: 0.05});
                            $(window).on('bottom', function() {
                                var obj = $(this);
                                if (!obj.data('loading')) {
                                    obj.data('loading', true);
                                    $('#bottomImg').html('<img src="loading.gif" />');

                                    setTimeout(function() {
                                        i_limit = i_count + 1;
                                        output(i_limit);
                                        $('#bottomImg').html('');
                                        obj.data('loading', false);
                                    }, 1000);
                                }
                            });
                            $('html,body').animate({ scrollTop: 0 }, '1');
                        });
                        
                    </script> 
                </div>
                <div class="col-lg-9">
                    <div id = "result_print_area"></div>
                    <div align="center" id="bottomImg"></div>
                    <div id="loadarea"></div>
                </div>
            </div>
        </div>
    </body>
</html>