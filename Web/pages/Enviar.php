<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<style>
.datepicker{z-index:1151 !important;}
</style>
<?php
if(isset($_POST['simpan'])){ 
// data from module enviar datos
$Command=$_POST['Command'];
// form submitted
 
// where is the socket server?
$host="127.0.0.1";
$port = 7774;
//echo $Command;
$message=$Command . "\r\n";
 
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket\n");
 
// connect to server
$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");
 
//socket_read ($socket, 1024) or die("Could not read server response\n");
 
// send string to server
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
 
// get server response
//$result = socket_read ($socket, 1024) or die("Could not read server response\n");
 
// end session
//socket_write($socket, "exit", 3) or die("Could not end session\n");
 
// close socket
socket_close($socket);
 
// clean up result
//$result = trim($result);
//$result = substr($result, 0, strlen($result)-1);
 
// print result to browser

    echo "<br><br><br><br><br><br><br><br>";
    echo '<div align="center">';
    echo "<h1>The command was send to the DAU</h1>";
    echo "</div>";
    echo "</br></br></br></br></br></br></br></br>";
	echo "<script>setTimeout(\"location.href = '?page=Enviar';\", 3000);</script>";
}else{
	echo "<body onLoad=$('#myModal').modal('show')>";
}
?>

 <!-- Modal -->
           
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Send command's to DAU </h4>
                            </div>
                        <div class="modal-body">
                        <form id="modal-form" action="" method="post">
                             <div class="form-group">
							<label for="sel1">Select list:</label>
							<select class="form-control" id="Command" name="Command">
							<option value="C=1">DAU Testmode ON</option>
							<option value="C=2">DAU Testmode OFF</option>
  </select>
</div> 
							<div class="text-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" name="simpan" value="Sign up">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

            </head>
</html>