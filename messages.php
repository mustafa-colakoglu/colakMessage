<?php
	session_start();
	include "message.class.php";
	$CLKMessage=new CLKMessage();
	$CLKMessage->connectDb("localhost","root","","mesajlasma");
	$giris=$CLKMessage->isLogin();
	if($giris){}
	else{
		if($_POST){
			$kadi=@$_POST["kadi"];
			$sifre=@$_POST["sifre"];
			$giris=$CLKMessage->userLogin($kadi,$sifre);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Mesajlar</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="js.js"></script>
</head>
<body>
	<?php
		$id=$_SESSION["id"];
		$konular=mysql_query("SELECT * FROM konular WHERE gelenId='$id' or gonderenId='$id'");
		$yeniGelenler=mysql_query("SELECT * FROM konular WHERE
			(gelenId='$id' and (enSonGonderenId!='$id' and gelenOkuma='0'))
			or
			(gonderenId='$id' and (enSonGonderenId!='$id' and gonderenOkuma='0'))
			ORDER BY id DESC");
		$eklenmeyecekler=array();
		?>
		<a href="newMessage.php">Yeni Mesaj</a>
		<table>
			<tr>
				<td><b>Kullanıcı Adı</b></td><td><b>Konu</b></td><td><b>Mesaj</b></td>
			</tr>
			<?php
				while($yeni=mysql_fetch_array($yeniGelenler)){
					array_push($eklenmeyecekler,$yeni["id"]);
					if($yeni["gelenId"]==$id){
						$mesajlasilanId=$yeni["gonderenId"];
					}
					else{
						$mesajlasilanId=$yeni["gelenId"];
					}
					$mesajlasilanBilgi=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$mesajlasilanId' LIMIT 1"));
					$konuId=$yeni["id"];
					$sonMesaj=mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE konuid='$konuId' ORDER BY id DESC LIMIT 1"));
					?>
						<tr class="okunmamislar">
							<td><?php echo $mesajlasilanBilgi["kullaniciAdi"]; ?></td>
							<td><?php echo $yeni["konu"]; ?></td>
							<td><?php echo $sonMesaj["mesaj"]; ?></td>
							<td><a href="messageDetail.php?id=<?php echo $yeni["id"]; ?>">Devamı ...</a></td>
						</tr>
					<?php
				}
				$digerMesajlar=mysql_query("SELECT * FROM konular WHERE gelenId='$id' or gonderenId='$id' ORDER BY id DESC");
				while($diger=mysql_fetch_array($digerMesajlar)){
					$kontrol=0;
					for($i=0;$i<count($eklenmeyecekler);$i++){
						if($diger["id"]==$eklenmeyecekler[$i]){
							$kontrol=1;
							break;
						}
					}
					if($kontrol==1){
						continue;
					}
					if($diger["gelenId"]==$id){
						$mesajlasilanId=$diger["gonderenId"];
					}
					else{
						$mesajlasilanId=$diger["gelenId"];
					}
					$mesajlasilanBilgi=mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE id='$mesajlasilanId' LIMIT 1"));
					$konuId=$diger["id"];
					$sonMesaj=mysql_fetch_array(mysql_query("SELECT * FROM mesajlar WHERE konuid='$konuId' ORDER BY id DESC LIMIT 1"));
					?>
						<tr>
							<td><?php echo $mesajlasilanBilgi["kullaniciAdi"]; ?></td>
							<td><?php echo $diger["konu"]; ?></td>
							<td><?php echo $sonMesaj["mesaj"]; ?></td>
							<td><a href="messageDetail.php?id=<?php echo $diger["id"]; ?>">Devamı ...</a></td>
						</tr>
					<?php
				}
			?>
		</table>
		<?php
	?>
</body>
</html>