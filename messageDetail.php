<?php
	session_start();
	include "message.class.php";
	$CLKMessage=new CLKMessage();
	$CLKMessage->connectDb("localhost","root","","mesajlasma");
	$giris=$CLKMessage->isLogin();
	if($giris){}
	else{
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Mesaj Detayları</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="js.js"></script>
</head>
<body>
	<table>
		<form action="" method="post">
			<textarea name="mesaj"></textarea><br />
			<input type="submit" value="Cevapla" />
		</form>
		<?php
			$subjectId=@$_GET["id"];
			foreach($CLKMessage->messageDetails() as $message){
			?>
			<tr>
				<td><?php echo $message["user1Id"]; ?></td>
				<td>:</td>
				<td><?php echo $message["message"]; ?></td>
			</tr>
			<?php
			}
		?>
	</table>
</body>
</html>