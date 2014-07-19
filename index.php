#пока все работает



<form name='data_base' method='post'>
	  <p><b>Name: </b>
	  <input name="n" type="text" size="20">
	  </p>
	  <p>Data<br>
      <textarea name='ucomment'></textarea></p>
	  
      <br><input type='submit'>
	  
	  </form>
<?PHP
	 $name = $_POST['n'];
	 $ucomment = $_POST['ucomment'];
	 echo "Name ".$name."<br>";
     echo "Data ".$ucomment."<br>";
	 if ($name!=NULL && $ucomment!=NULL)
	 {
		$mysqli = new mysqli('localhost', 'root', '', 'test_base');
		if (mysqli_connect_errno()){
			printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
			exit;
		}
	
		$ins = "INSERT INTO  `comment_table` (`name` , `comment`) VALUES ('$name', '$ucomment')";
		echo $ins;
		$w_b = $mysqli->query($ins);
		$mysqli->close();
	}
	  ?>	   
