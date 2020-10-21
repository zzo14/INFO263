<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TServer Web</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/navigation.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
</head>
<body style="height: 800px;">
<ul>
    <ti><a href="../index.php">Tserver Web</a></ti>
    <li><a href="../login/logout.php">Logout</a></li>
    <li><a href="../search_page/search.php">Search</a></li>
    <li><a href="defnation.php">Define</a></li>
    <li><a href="../index.php">Home</a></li>
</ul>

<div class="container">
    <div class="panel panel-default" style="margin-top: 100px;text-align: center;">
        <div class="panel-heading" style="font-size: 20px;font-weight: bold" >
            Define events
        </div>
        <div class="panel-body">
            <form class="navbar-form navbar-center" role="search" name="myform">
                <div class="row py-2">
                    <div class="navbar-form navbar-left" style="font-weight: bold"> front_event:</div>
                    Event Name:<input type="text" name="event_name" id="event_name" class="forma">
                    Status:<input type="text" name="status" id="status" class="forma">
                    <input type="button" class="btn_event" value="Insert" >
                </div>
                <hr>
                <div class="row py-3">
                    <div class="navbar-form navbar-left" style="font-weight: bold"> front_group:</div>
                    Machine Group:<input type=text id = machine_group name = machine_group>
                    <input type="button" class="btn_group" value="Select">
                </div>
                <hr>
                <div class="row py-3">
                    <div class="navbar-form navbar-left" style="font-weight: bold"> front_cluster:</div>
                    Cluster Name:<input type=text id = cluster_name name = cluster_name>
                    <input type="button" class="btn_cluster" value="Select">
                </div>
                <hr>
                <div class="row py-3">
                    <div class="navbar-form navbar-left" style="font-weight: bold"> front_action:</div>
                    Event ID:<input type=text id = a_event_id name = a_event_id>
                    Time Offset:<select class="form-control" id = time_offset name = time_offset ">
                        <option value="-00:05:00">-00:05:00</option>
                        <option value="00:30:00">00:30:00</option>
                        <option value="01:00:00">01:00:00</option>
                        <option value="01:30:00">01:30:00</option>
                        <option value="02:00:00">02:00:00</option>
                        <option value="02:30:00">02:30:00</option>
                        <option value="03:00:00">03:00:00</option>
                    </select>
                    Cluster ID:<input type=text id = cluster_id name = cluster_id>
                    Activate:<input type=text id = actiate name = actiate>
                    <input type="button" class="btn_action" value="Insert">
                </div>
                <hr>
                <div class="row py-3">
                    <div class="navbar-form navbar-left" style="font-weight: bold"> front_daily:</div>
                    Event ID:<input type=text id = d_event_id name = d_event_id>
                    Group ID:<input type=text id = group_id name = group_id>
                    Day Of Week:<select class="form-control" id = day_of_week name = day_of_week>
                        <?php
                        for($day=1; $day<8; $day++)
                        {
                            echo '<option value= "'.$day.'">'.$day.'</option>';
                        }
                        ?>
                    </select>
                    Start Time:<select class="form-control" id = start_time name = start_time>
                        <?php
                        for($hours=0; $hours<24; $hours++)
                        {
                            for($mins=0; $mins<60; $mins+=30)
                            {
                                $time = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).':00';
                                echo '<option value= "'.$time.'">'.$time.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="button" class="btn_daily" value="insert">
                </div>
                <hr>
                <div class="row py-2">
                    <div class="navbar-form navbar-left" style="font-weight: bold"> front_weekly:</div>
                    Event ID:<input type=text id = w_event_id name = w_event_id>
                    Week Of Year:<input type=text id = week_of_year name = week_of_year>
                    Event Yeat:<input type=text id = event_year name = event_year>
                    <input type="button" class="btn_weekly" value="Insert">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.btn_event').click(function (){
        var event_name=$("#event_name").val();
        var status=$("#status").val();
        $.ajax({
            url:'add_event.php',
            data:{
                name:event_name,
                status:status
            },
            type:'POST',
            dataType : "json",
            success:function(str) {
                if (str[0] == null) {
                    alert("Please enter the correct value");
                } else {
                    alert('Sussess and event_id： ' + str[0]);
                }
            }
        });
    });

    $('.btn_group').click(function (){
        var machine_group=$("#machine_group").val();
        $.ajax({
            url:'get_group_id.php',
            data:{
                machine_group:machine_group
            },
            type:'POST',
            dataType : "json",
            success:function(str) {
                if (str[0] == null) {
                    alert("Please enter the correct value");
                } else {
                    alert('group_id： ' + str[0]);
                }
            }
        });
    });

    $('.btn_cluster').click(function (){
        var cluster_name=$("#cluster_name").val();
        $.ajax({
            url:'get_cluster_id.php',
            data:{
                cluster_name:cluster_name
            },
            type:'POST',
            dataType : "json",
            success:function(str){
                if(str[0] == null){
                    alert("Please enter the correct value");
                } else {
                    alert('cluster_id： ' + str[0]);
                }
            }
        });
    });

    $('.btn_action').click(function (){
        var event_id=$("#a_event_id").val();
        var time_offset=$("#time_offset").val();
        var cluster_id=$("#cluster_id").val();
        var actiate=$("#actiate").val();
        $.ajax({
            url:'add_action.php',
            data:{
                event_id:event_id,
                time_offset:time_offset,
                cluster_id:cluster_id,
                activate:actiate
            },
            type:'POST',
            dataType : "json",
            success:function(str){
                if(str[0] == false){
                    alert("Please enter the correct value");
                } else {
                    alert('Success');
                }
            }
        });
    });

    $('.btn_daily').click(function (){
        var event_id=$("#d_event_id").val();
        var group_id=$("#group_id").val();
        var day_of_week=$("#day_of_week").val();
        var start_time=$("#start_time").val();
        $.ajax({
            url:'add_daily.php',
            data:{
                event_id:event_id,
                group_id:group_id,
                day_of_week:day_of_week,
                start_time:start_time
            },
            type:'POST',
            dataType : "json",
            success:function(str){
                if(str[0] == false){
                    alert("Please enter the correct value");
                } else {
                    alert('Success');
                }
            }
        });
    });
    $('.btn_weekly').click(function (){
        var event_id=$("#w_event_id").val();
        var week_of_year=$("#week_of_year").val();
        var event_year=$("#event_year").val();
        $.ajax({
            url:'add_weekly.php',
            data:{
                event_id:event_id,
                week_of_year:week_of_year,
                event_year:event_year
            },
            type:'POST',
            dataType : "json",
            success:function(str){
                if(str[0] == false){
                    alert("Please enter the correct value");
                } else {
                    alert('Success');
                }
            }
        });
    });
</script>
</body>
</html>>