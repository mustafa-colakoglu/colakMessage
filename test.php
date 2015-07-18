<?php
	session_start();
	include "message.class.php";
	$mes=new CLKMessage();
	$mes->connectDb("localhost","root","","mesajlasma");
	$kont=$mes->isLogin();
	//$mes->addUser("emrah","mustafa","mustafa");
	$mes->newMessage(1,2,321,2);
	if($kont){
		$mesajDetay=$mes->messageDetails(1);
		foreach($mesajDetay as $mesaj){
			if($mesaj["user1Id"]!=$_SESSION["CLKId"]){
				echo "ben :".$mesaj["message"]."<br />";
			}
			else{
				echo $mesaj["user2UserName"].":".$mesaj["message"]."<br />";
			}
		}
	}
	else{
		$login=$mes->userLogin("mustafa220","mustafa");
		if($login){
			echo "giris tamam";
		}
		else{
			if($mes->data["userLoginFail"]==2){
				echo "kullanıcı adı veya sifre yanlis";
			}
			else if($mes->data["userLoginFail"]==3){
				echo "kullanici girisi yapilmis";
			}
		}
	}
?>