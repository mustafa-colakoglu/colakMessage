<?php
	include "ayarlar.php";
	include "girisKontrol.php";
	if($_POST){
		$kadi=@$_POST["kadi"];
		$sifre=@$_POST["sifre"];
		$gizliYanit=@$_POST["gizli"];
		if(empty($kadi) or empty($sifre) or empty($gizliYanit)){
			echo "Bos alan";
		}
		else{
			$kontrol=mysql_query("SELECT * FROM kullanicilar WHERE kullaniciAdi='$kadi'");
			if(mysql_num_rows($kontrol)<1){
				mysql_query("INSERT INTO kullanicilar VALUES('','$kadi','$sifre','$gizliYanit')");
				@$_SESSION["giris"]=true;
				@$_SESSION["id"]=mysql_insert_id();
				header("Location:index.php");
			}
			else{
				echo "Ayni Kullanici";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Kayıt Ol!</title>
</head>
<body>
	<?php
		if(!$giris){
		?>
		<form action="" method="post">
			<table>
				<tr>
					<td>Kullanıcı Adı</td><td>:</td><td><input type="text" name="kadi" /></td>
				</tr>
				<tr>
					<td>Şifre</td><td>:</td><td><input type="password" name="sifre" /></td>
				</tr>
				<tr>
					<td>Gizli Yanıt</td><td>:</td><td><input type="text" name="gizli" /></td>
				</tr>
				<tr>
					<td></td><td></td><td><input type="submit" value="Kayıt Ol!" /></td>
				</tr>
			</table>
		</form>
		<?php
		}
		else{
			header("Location:index.php");
		}
	?>
</body>
</html>