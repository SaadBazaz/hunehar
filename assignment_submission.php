<?
@ini_set('zend_monitor.enable', 0);
if(@function_exists('output_cache_disable')) {
	@output_cache_disable();
}
if(isset($_GET['debugger_connect']) && $_GET['debugger_connect'] == 1) {
	if(function_exists('debugger_connect'))  {
		debugger_connect();
		exit();
	} else {
		echo "No connector is installed.";
	}
}
?>



<html>
<head>
<link href="./main.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="main" style="justify-content:center">
        <div class="card" style="margin-top:100px; padding-top:20px">
        <h1>Here's what you submitted...</h1>
            Email: <?php echo $_POST["s_email"]; ?><br />
            Password: <?php echo $_POST["s_password"]; ?> <br />
            Content: <?php echo $_POST["s_content"]; ?><br />
            Email confirmation? <?php echo $_POST["s_getEmail"]; ?> <br />
            Get radio? <?php echo $_POST["s_getRadio"]; ?><br />
            Submitted to: <?php echo $_POST["s_teacher"]; ?> <br />
            <a href="./assignment.html"> <button>Go back</button> </a>
        </div>
    </div>
</body>
    
</html>