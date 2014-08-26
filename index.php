<?PHP
include 'constructComment_tree.php'; ## подключаем файл для использования функцыи outTree(0, 0)
include 'check_connection_database.php'; ##подключаем файл для использования функцыи checkConnection_database()
$name = $_POST['n'];
$ucomment = $_POST['ucomment'];

if ($name!=NULL && $ucomment!=NULL){
	$mysqli = checkConnection_database();## вызов функцыи из файла check_connection_database.php
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
<input name='n' type="text" size="20">
</p>
<p>Comment<br>
<textarea name='ucomment'></textarea></p>
 
<br><input type='submit'>

</form>
