<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en" xmlns:wb=“http://open.weibo.com/wb”>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <title>漫步-Walk in the Story</title>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://iwb.jp/s/js/jquery.skOuterClick.js"></script>
		<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
       

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
    
    <body onLoad="get_data()">
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
		<div class = "weibo" align="center">
			<wb:topic topmid="DByWtC6sd" column="n" border="n" width="80%" height="1190" tags="%E5%A5%BD%E7%94%A8%E5%90%97" language="zh_cn" version="base" appkey="1uzq4r" refer="y" footbar="y" url="http%3A%2F%2Fweb.sfc.keio.ac.jp%2F~ni9zhang%2Fseichitechou%2Findex.php" filter="n" ></wb:topic>
		</div>
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
			</script> 
    </body>
</html>