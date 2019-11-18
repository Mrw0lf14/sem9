<?php
	$login_log = $_POST['login_log'];
	$pass_log = $_POST['pass_log'];
	echo "string";
	$host='localhost'; // имя хоста (уточняется у провайдера)
	$database='homework'; // имя базы данных, которую вы должны создать
	$user='root'; // заданное вами имя пользователя, либо определенное провайдером
	$table='homework';//название таблицы
	$pswd='gavl228_A'; // заданный вами пароль
	echo "string";
	$link = mysqli_connect($host, $user, $pswd, $database) or die("Ошибка " . mysqli_error($link));// подключаемся к серверу
	echo "Connected<br>";
	
	$query = "SELECT * FROM $table WHERE login ='$login_log'";//создаем запрос
	$res = mysqli_query($link ,$query);//выполняем запрос
	echo "query<br>";

	if ($res){
		$row = mysqli_fetch_array($res);//вытаскиваем данные из запроса
		if ($row['login']=="$login_log" && $row['password']=="$pass_log"){
			echo "Content";
		}
		else{
			echo "Wrong password or login";
			echo "<a href='login.html'>Go back</a>";
		}
	}
?>
