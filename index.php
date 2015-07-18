<?php
	include "ayarlar.php";
	include "girisKontrol.php";
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Mesajlaşma scripti</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="js.js"></script>
</head>
<body>
	<?php
		if(!$giris){
		?>
		<form action="login.php" method="post">
			<table>
				<tr>
					<td>Kullanıcı Adı</td><td>:</td><td><input type="text" name="kadi" /></td>
				</tr>
				<tr>
					<td>Şifre</td><td>:</td><td><input type="password" name="sifre" /></td>
				</tr>
				<tr>
					<td></td><td></td><td><input type="submit" value="Giriş" /></td>
				</tr>
				<tr>
					<td><a href="password.php">Şifremi Unuttum</a></td><td><td><a href="register.php">Kayıt Ol!</a></td></td>
				</tr>
			</table>
		</form>
		<?php
		}
		else{
			$id=@$_SESSION["id"];
			$kullaniciBilgi=mysql_query("SELECT * FROM kullanicilar WHERE id='$id'");
			$kullanici=mysql_fetch_array($kullaniciBilgi);
			$konular=mysql_query("SELECT * FROM konular WHERE gelenId='$id' or gonderenId='$id'");
			$gelenSayi=mysql_query("SELECT * FROM konular WHERE 
			(gelenId='$id' and gelenOkuma=0 and enSonGonderenId!='$id')
			or
			(gonderenId='$id' and gonderenOkuma=0 and enSonGonderenId!='$id')
			");
			?>
			<table>
				<tr>
					<td><?php echo $kullanici["kullaniciAdi"]; ?></td>
					<td><a href="messages.php">Mesajlar ( <?php echo mysql_num_rows($gelenSayi); ?> )</a></td>
					<td><a href="cikis.php">Çıkış</a></td>
				</tr>
			</table>
			<?php
		}
	?>
</body>
</html>