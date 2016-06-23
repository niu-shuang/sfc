<!DOCTYPE html>
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
            $(function() {
                $("#onoffswitch :checkbox").click(function() {
                    switch_status = switch_status * (-1);
                    polyline_check(switch_status);
                });
                $("#path_switch :checkbox").click(function() {
                    switch2_status = switch2_status * (-1);
                    path_check();
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
            function polyline_check(switch_status){
                if(switch_status == 1){
                    polyline.setVisible(true);
                }else{
                    polyline.setVisible(false);
                }
            }
            function path_check(){
                if(switch2_status == 1){
                    for (i in markers) {
                        markers[i].setMap(map);
                    }
                }else{
                    for (i in markers) {
                        markers[i].setMap(null);
                    }
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
    
    <body onLoad="get_data(); polyline_check(1)">
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
                    <input type="text" id = "req_key2" name="req_key2" size="10" style="color:#a1a1a1" value="Path" />
                    <input id = "kensaku" type="button" value="Search" onclick="send_data()" />
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
                    <a class="navbar-brand" href="map_view.php">Map</a>
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
            <!-- /.container-fluid --> 
        </nav>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://iwb.jp/s/js/jquery.skOuterClick.js"></script> 
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="js/bootstrap.min.js"></script>
		<p>
        <div class="InnerNavi">
			<table width="200" border="1" cellpadding="1" cellspacing="1" align="center">
				<tr>
					<td width="100" align="center"><a href='weibo_view.php'>weibo</td>
					<td width="100" align="center"><a href='map_view.php'>record</td>
				</tr>
			</table>
		</div>
		</p>
        <div class="container">
            <div style="float:left"><font style="font-size:20px">Path&nbsp;</font></div>
            <div style="float:left" class="onoffswitch" id="onoffswitch">
                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                <label class="onoffswitch-label" for="myonoffswitch">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div>
            <div style="float:left"><font style="font-size:20px">&nbsp;&nbsp;投稿&nbsp;</font></div>
            <div style="float:left" class="onoffswitch" id="path_switch">
                <input type="checkbox" name="path_switch" class="onoffswitch-checkbox" id="myauto_play_switch" checked>
                    <label class="onoffswitch-label" for="myauto_play_switch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                </label>
            </div>&nbsp;<br>&nbsp;
            <div id="map" style=" width: device-width; height: 500px"></div>
            <div id="whispath00"></div>
            <script type="text/javascript"> 
                var n =[];
                var user_name = [];
                var path_name = [];
                var content = [];
                var lat = [];
                var lng = [];
                var file_list = [];
                var path_line_arr =[];
                var polyline = null;
                var polylineOpts;
                var switch_status = 1;
                var switch2_status = 1;
                var markers = [];
                    
                function get_data(){
                    $.ajax({
                        type:"get",
                        async:false,
                        cache:false,
                        dataType:"json",
                        url: "map.php",
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
                        },
                        error: function(){
                            alert("エラー");
                        }
                    });
                    setting();
                }
                
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
                    window.location.href = "map_view.php?user_name=" + req_key1 + "&path_name=" + req_key2 + "&id=";
                }

                //地図の設定
                function setting(){
                    for(var i=0; i<lat.length; i++){
                        if(lat[i] != ""){    
                            var myLatlng = new google.maps.LatLng(lat[i], lng[i]);
                            break;
                        }
                    }
                    var myOptions={
                        zoom: 18,
                        center: myLatlng,
                        mapTypeID: google.maps.MapTypeId.HYBRID
                    };
                    var map1 = document.getElementById("map"); 
                    map1.style.height = window.innerHeight -180+ "px";
                    map = new google.maps.Map(map1, myOptions); 
                    positioning(map);
                }
                /* アイコン設定 */
                var image2 = new google.maps.MarkerImage('fukidashi.png',
                        new google.maps.Size(50,36),
                        new google.maps.Point(0,0),
                        new google.maps.Point(10,35)
                );
                
                var picture = [];
                
                //写真マーカー作成
                function createMarker(latlng,marker,map,message,path_name_req){
                    google.maps.event.addListener(marker, 'mouseover', function() {
                        infoWindow.setPosition(latlng);
                        infoWindow.open(map,marker);   
                    });
                    google.maps.event.addListener(marker, 'mouseout', function() {
                        infoWindow.close();   
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        location.href = "search_result_map.html?user_name=&path_name="+ path_name_req + "&id=";
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
                function createCoMarker(n_id,latlng,marker,map,message,path_name_req){
                    google.maps.event.addListener(marker, 'mouseover', function() {
                        infoWindow.setPosition(latlng);
                        infoWindow.open(map,marker);   
                    });
                    google.maps.event.addListener(marker, 'mouseout', function() {
                        infoWindow.close();   
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        location.href = "search_result_map.html?user_name=&path_name="+ path_name_req + "&id=" + n_id;
                    });

                    var offset = new google.maps.Size(0, 0);
                    var iwopts = {
                      content: message,
                      positon: latlng,
                      pixelOffset: offset
                    };
                    var infoWindow = new google.maps.InfoWindow(iwopts);
                } 
                function positioning(map){
                    for(var i=500; i>=0; i= i -1){
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
                        if(contentStr != ""){
                            var latlng =  new google.maps.LatLng(lat[i],lng[i]);
                            var marker = new google.maps.Marker({
                                icon: picture[i],
                                position: latlng,
                                zIndex: -i,
                                map: map
                            });
                            path_line_arr.push(latlng);
                            markers.push(marker);
                            var message = user_name[i] + "：" + content[i] + contentStr;
                            var path_name_req = path_name[i];
                            createMarker(latlng,marker,map,message,path_name_req);
                        }else if(content[i] != ""){
                            var n_id = n[i];
                            var latlng =  new google.maps.LatLng(lat[i],lng[i]);
                            var message = user_name[i] + "：" + content[i];
                            var marker = new google.maps.Marker({
                                icon: image2,
                                position: latlng,
                                zIndex: -i,
                                map: map
                            });
                            path_line_arr.push(latlng);
                            markers.push(marker);
                            var path_name_req = path_name[i];
                            createCoMarker(n_id,latlng,marker,map,message,path_name_req);
                        }else{
                            var latlng =  new google.maps.LatLng(lat[i],lng[i]);
                            path_line_arr.push(latlng);
                        }                                      
				        if(content[i] != undefined){
                            // Polylineの初期設定
                            polylineOpts = {
                                map: map,
                                path: path_line_arr,
                                strokeColor: "blue",
                                visible:false
                            };
                            polyline = new google.maps.Polyline(polylineOpts);
				        }                                     
                    }
                }
            </script> 
        </div>
    </body>
</html>