<?PHP
include 'constructComment_tree.php'; ## подключаем файл для доступа к содержащимся в нем функцыям

$name = $_POST['n'];
$ucomment = $_POST['ucomment'];

if ($name!=NULL && $ucomment!=NULL){
	$mysqli = new mysqli('localhost', 'root', '', 'test_base');
	if (mysqli_connect_errno()){
		printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
		exit;
	}
	
	$ins = "INSERT INTO  `comment_table` (`name` , `comment`) VALUES ('$name', '$ucomment')";
	$w_b = $mysqli->query($ins);
	$mysqli->close();
	}
	
outTree(0, 0); ## вызов функцыи из файла constructComment_tree.php

echo $name."<br>";
echo $ucomment."<br>";
	  ?>	
	  <?PHP

?>
<form name='data_base' method='post'>
<p><b>Name: </b>
<input name="n" type="text" size="20">
</p>
<p>Comment<br>
<textarea name='ucomment'></textarea></p>
 
<br><input type='submit'>

</form>
