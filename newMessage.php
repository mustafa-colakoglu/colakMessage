<?php
	include "ayarlar.php";
	include "girisKontrol.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Yeni Mesaj</title>
</head>
<body>
	<?php
		if($_POST){
			$nick=@$_POST["nick"];
			$konu=@$_POST["konu"];
			$mesaj=@$_POST["mesaj"];
			$kullaniciId1=$_SESSION["id"];
			$kullanici2=@mysql_fetch_array(mysql_query("SELECT * FROM kullanicilar WHERE kullaniciAdi='$nick' LIMIT 1"));
			$kullaniciId2=$kullanici2["id"];
			if($kullaniciId1 and $kullaniciId2){
				mysql_query("INSERT INTO konular VALUES('','$konu','$kullaniciId1','$kullaniciId2','0','1','$kullaniciId1')");
				$konuId=mysql_insert_id();
				mysql_query("INSERT INTO mesajlar VALUES('','$konuId','$mesaj','$kullaniciId1','$kullaniciId2')");
				header("Location:messageDetail.php?id=".$konuId);
			}
			else{
				echo "kullanıcı hatası";
			}
		}
	?>
	<form action="" method="post">
		Nick : <input type="text" name="nick" /><br />
		Konu : <input type="text" name="konu" /><br />
		Mesaj : <textarea name="mesaj"></textarea>
		<input type="submit" value="Gönder" />
	</form>
</body>
</html>