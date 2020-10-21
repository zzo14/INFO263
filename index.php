<?php
session_start();
if(empty($_SESSION['userid'])){
    echo "<script>alert('Please login first');window.location.href='login/login.php';</script>";
    exit();
}
?>
<html>
<head>
    <meta charset="utf-8"/>
    <title>TServer Web</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/navigation.css">
</head>
<body style="height: 800px;">
<ul>
    <ti><a href="index.php">Tserver Web</a></ti>
    <li><a href="login/logout.php">Logout</a></li>
    <li><a href="search_page/search.php">Search</a></li>
    <li><a href="define_page/defnation.php">Define</a></li>
    <li><a href="index.php">Home</a></li>
</ul>

<div class="container">
    <div class="panel panel-default" style="margin-top: 100px;text-align: center;">
        <div class="panel-heading" style="font-size: 20px;font-weight: bold">
            Current Events
        </div>
        <div class="panel-body">
            <form class="navbar-form navbar-center" role="search" name="myform">
                From Date: <input type="text" id="date1" value = '2015-1-1'>

                 —— 

                To Date: <input type="text" id="date2" value = '2015-1-1'>

                <button type="button" class="btn btn-default" onclick="ajaxFunction()">submit</button>
            </form>
            <hr>
            <table class="table table-condensed table-bordered" id="ajaxDiv"></table>
            <p>SQL：<pre id="sql"></pre></p>
        </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">

        $( function() {
            $( "#date1" ).datepicker({ dateFormat: 'yy-mm-dd',
                changeMonth:true,
                changeYear:true});
            $( "#date2" ).datepicker({ dateFormat: 'yy-mm-dd',
                changeMonth:true,
                changeYear:true});
        } );



        function date() {
            var date1=document.getElementById('date1').value;
            var date2=document.getElementById('date2').value;

            var url='?date1='+date1;
            url += '&date2='+date2;
            return url;
        }

        function ajaxFunction()
        {
            var xmlHttp;
            try{
                xmlHttp = new XMLHttpRequest();
            }catch(e){
                try{
                    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                }catch(e){
                    try{
                        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }catch(e){
                        alert("Your browser does not support");
                        return false;
                    }
                }
            }
            xmlHttp.onreadystatechange=function(){
                if(xmlHttp.readyState==4){
                    var ajaxData=document.getElementById("ajaxDiv");
                    var sqlData=document.getElementById('sql');
                    var jsonData=JSON.parse(xmlHttp.responseText);
                    ajaxData.innerHTML=jsonData.data;
                    sqlData.innerHTML=jsonData.sql;
                }
            }

            var url=date();

            xmlHttp.open("GET","ajax_index.php"+url,true);
            xmlHttp.send();
        }
</script>
</body>
</html>>