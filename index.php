<?php
	$mail = $_POST["mail"];
	$login = $_POST["login"];
	$password = $_POST["pass1"];

	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='homework';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль
	
	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу

	$mail_valid = preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail) && preg_match("/(?:[a-zA-Z0-9])/i", $mail);
	
	$uppercase = preg_match('/[A-Z]+/', $password);
	$lowercase = preg_match('/[a-z]+/', $password);
	$number    = preg_match('/[0-9]+/', $password);
	$special = preg_match('/[%$#@&*^|\/~[]{}]+/',$password);
	$password_valid = $special && $uppercase && $lowercase && $number && strlen($password) > 8;
	$login_valid = preg_match('/[A-Za-z_]/', $login) && strlen($login) > 6;

	if(!$password_valid && $password!=$_POST["pass2"]) {
  		echo "This password is too easy. Use 1 number 1 uppercase and 1 lowercase word. The length of pass should be hiher than 8";
  		echo "<br>";
	} 
	if (!$mail_valid){
		echo "The mail is not valid";
		echo "<br>";
	}
	if (!$login_valid){
		echo "The login is not valid";
		echo "<br>";
	}
	if (!$mail_valid && !$password_valid && !$login_valid)
	{
		echo "<a href='index.html'>Go back</a>";
		exit();
	}
	echo "valid";
	$query = "SELECT * FROM $table WHERE mail='$mail'";//формируем запрос
	$res = mysqli_query($link ,$query);//задаем вопрос
	
	if ($res){
		$row = mysqli_fetch_array($res);//вытаскиваем данные из запроса
		if ($row['mail']=="$mail" or $row['login']=="$login"){
			echo "This account is already exist";
			echo "<a href='index.html'>Go back</a>";
		} else {
			$query = "INSERT INTO $table (login, mail, password) VALUES ('$login','$mail','$password')";
			$result = mysqli_query($link ,$query);
			if ($res){
				echo "<hr>";
				echo "Registration successful";
				echo "<a href='login.html'>login</a>";
			}	
		}
	}
	
?>
