<html>
<head>
<title>Zarbin Network</title>

<?php
require '/var/lib/asterisk/agi-bin/phpagi-asmanager.php';

//DB Settings
$host="localhost";
$user="root";
$pass="decat102030@";
$dbast="asterisk";
$dbcdr="asteriskcdrdb";

//DB connect
$conast = mysqli_connect($host,$user,$pass,$dbast);
mysql_select_db($dbast, $conast);

//check connect to DB
if (mysqli_connect_errno())
{
    echo "Failed connect to MySQL: ".mysqli_connect_error();
}

$concdr = mysqli_connect($host,$user,$pass,$dbcdr);
mysql_select_db($dbcdr,$concdr);

//check connect to DB
if (mysqli_connect_errno())
{
    echo "Failed connect to MySQL: ".mysqli_connect_error();
}

?>

<style>

body{
   background: linear-gradient( rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('pic1.jpg');
   background-size: cover;
   background-position: center;
   background-repeat: no-repeat;
   
}

h1 {
    color:white;
    margin:auto;
    width: 50%;
    border: 3px solid #008CBA;
    padding: 10px;
}


h2 {
    color:white;
    margin:auto;
    width: 50%;
    padding: 10px;
}

.container1 {
    display: grid;
    grid-gap: 5px;
    grid-template-columns: repeat(auto-fit, minmax(100px,1fr));
    grid-template-rows: repeat(0,100px);
}

</style>
    
</head>
<body>

<Center>
<br></br>
<h1><strong></strong>Zarbin Network Extension Monitor</h1>
<br></br>
<h2><strong></strong>Extension Status</h2>
<br></br>
</center>

<?php

$debug=true;
$device_prefix = "Custom:Remote";
$remote_server = "localhost";
$remote_name = "zarbin";
$remote_secret = "123456";
$remote_context = "from-internal";

$remote = new AGI_AsteriskManager();
if ($remote->connect($remote_server,$remote_name,$remote_secret)) {
    $result = mysqli_query($conast,"SELECT extension FROM users");
    while($row = mysqli_fetch_array($result))
    {
        $remote_extension = $row['extension'];
        $foo[$remote_extension] = $remote->ExtensionState($remote_extension);
    }
    $remote->disconnect();
}
else {
    output("can not connect to remote AGI");
}
?>
<?php if(true) { ?>
    <center>
    <div class="body table-responsive" >
        <table class="table table-bordered">
                <tr class="container1">

        <?php
            $result = mysqli_query($conast,"SELECT extension FROM users");
                while($row = mysqli_fetch_array($result))
                {
                    if($foo[$row['extension']]['Status'] == 0){
                        echo "<th style='text-align:center' bgcolor='#00FF00'>".$row['extension'];
                    }
                    if($foo[$row['extension']]['Status'] == 1){
                        echo "<th style='text-align:center' bgcolor='#f50505'>".$row['extension'];
                    }
                    if($foo[$row['extension']]['Status'] == 2){
                        echo "<th style='text-align:center' bgcolor='#f50505'>".$row['extension'];
                    }
                    if($foo[$row['extension']]['Status'] == 4){
                        echo "<th style='text-align:center' bgcolor='#fff'>".$row['extension'];
                    }
                    if($foo[$row['extension']]['Status'] == 8){
                        echo "<th style='text-align:center' bgcolor='#fafd39'>".$row['extension'];
                    }
                    if($foo[$row['extension']]['Status'] == 9){
                        echo "<th style='text-align:center' bgcolor='#fafd39'>".$row['extension'];
                    }
                    if($foo[$row['extension']]['Status'] == 16){
                        echo "<th style='text-align:center' bgcolor='#f50505'>".$row['extension'];
                    }
                    
                }
} else {
    output("can not connect to local AGI");
}

function output($string){
    global $debug;
    if($debug){
        echo $string;
    }
}
?>
</th>
</tr>
</table>
</div>
</center>
</body>
</html>