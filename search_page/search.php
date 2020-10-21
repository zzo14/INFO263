<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>TServer Web</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">'
    <link rel="stylesheet" href="../css/navigation.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body>
<ul>
    <ti><a href="../index.php">Tserver Web</a></ti>
    <li><a href="../login/logout.php">Logout</a></li>
    <li><a href="search.php">Search</a></li>
    <li><a href="../define_page/defnation.php">Define</a></li>
    <li><a href="../index.php">Home</a></li>
</ul>

<div class="container">
    <div class="panel panel-default" style="margin-top: 100px;text-align: center;">
        <div class="panel-heading" style="font-size: 20px;font-weight: bold">
            Search
        </div>
        <div class="panel-body">
            <form class="navbar-form navbar-center">
                <input type="text" id="name" name="name" class="forma" onKeyUp="showHint(this.value)" size="50px">
            </form>
            <hr>
            <div style="font-size: 15px; font-weight: bold">Event Name:</div>
            <p><span id="txtHint"></span></p>
        </div>
    </div>
</div>
<script>
    function showHint(str){
        if(str.length==0){
            document.getElementById("txtHint").innerHTML = "";
            return;
        }else{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200 ){
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET","gethint.php?q=" +str,true);
            xmlhttp.send();
        }
    }
</script>
</body>
</html>