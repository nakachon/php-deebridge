<html>
<head><title>DeeBridge TEST</title></head>
<body>

<p>
Enter Command (コマンド入力してください）
</p>

<form method="POST" action="./deebridgePHP.php">
<input type="text" name="text1">
<input type="submit" name="btn1" value="submit">
</form>

<?php

if (isset($_POST['text1'])) {
	$command = $_POST['text1'];
	
	$fp = stream_socket_client("tcp://DeeBridge_IP_NO:PORT_NO", $errno, $errstr, 30);
	// Example : $fp = stream_socket_client("tcp://169.254.80.200:8421", $errno, $errstr, 30);

	if (!$fp) {
    	echo "$errstr ($errno)<br />\n";
	} else {
	$r = fwrite($fp, $command);
	
	fflush($fp);
	    
    $r = fwrite($fp, "#DISCONNECT#");
    
   	var_dump($r);
    
    socket_shutdown($fp,1);
    	while (!feof($fp)) {
        	echo fgets($fp, 1024);
    	}
    
   	fclose($fp);
   	}
}
?>
</body>
</html>