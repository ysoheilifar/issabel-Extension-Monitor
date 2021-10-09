<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zarbin Network</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<body>

<div id="result"></div>
<script type="text/javascript">
    function ajaxCall(){
        $('#result').load('zarbinMonitor_Main.php');
    }
    $(document).ready(function(){
        setInterval(ajaxCall, 1000);
    });
</script>
</body>
</html>