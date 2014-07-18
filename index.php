<?
#$gd = NULL;
my_calendar(array(date("Y-m-d")));
$gd = $_GET['date'];

if (isset($gd)) 
{
echo "список дел на ".$gd;
;

}

$mysqli = new mysqli('localhost', 'root', '', 'test_base');
	if (mysqli_connect_errno()){
	printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
	exit;
	}
#var_dump($gd);	
#$res = $mysqli->query("SELECT * FROM section ");
$query = "SELECT ALL * FROM section WHERE date='$gd'";
$res = $mysqli->query($query);
$row = mysqli_fetch_array($res);
var_dump($row);
$ob = $row['objective'];
var_dump($ob);
$test = $_GET['comment'];

echo "<form method='post' name='diary_data'> <textarea name='comment'>$ob</textarea><br><input type='submit'></form>";
echo $test;

if (!empty($row)){
$upd = "UPDATE section SET objective='$test'";
//UPDATE `section` SET `objective` = '{$test}' WHERE `data` = '{$_GET['data']}'
$rs1 = $mysqli->query($upd);
echo" XXXXX ";
var_dump($rs1);
}
else{
$ins = "INSERT INTO section (date objective) VALUES('$gd' '$test')";
$rs2 = $mysqli->query($ins);
var_dump($rs2);
}
#$query_r = "SELECT ALL * FROM section WHERE date='$gd'";

 #echo <br><textarea>$ob</textarea>

?> 

<?
function my_calendar($fill=array()) 
{ 
  $month_names=array("январь","февраль","март","апрель","май","июнь",
  "июль","август","сентябрь","октябрь","ноябрь","декабрь"); 
  if (isset($_GET['y'])) $y=$_GET['y'];
  if (isset($_GET['m'])) $m=$_GET['m']; 
  if (isset($_GET['date']) AND strstr($_GET['date'],"-")) list($y,$m)=explode("-",$_GET['date']);
  if (!isset($y) OR $y < 1970 OR $y > 2037) $y=date("Y");
  if (!isset($m) OR $m < 1 OR $m > 12) $m=date("m");

  $month_stamp=mktime(0,0,0,$m,1,$y);
  $day_count=date("t",$month_stamp);
  $weekday=date("w",$month_stamp);
  if ($weekday==0) $weekday=7;
  $start=-($weekday-2);
  $last=($day_count+$weekday-1) % 7;
  if ($last==0) $end=$day_count; else $end=$day_count+7-$last;
  $today=date("Y-m-d");
  $prev=date('?\m=m&\y=Y',mktime (0,0,0,$m-1,1,$y));  
  $next=date('?\m=m&\y=Y',mktime (0,0,0,$m+1,1,$y));
  $i=0;
?> 

<table border=1 cellspacing=0 cellpadding=2> 
 <tr>
 <td colspan=7> 
   <table width="100%" border=0 cellspacing=0 cellpadding=0> 
    <tr> 
     <td align="left"><a href="<? echo $prev ?>">&lt;&lt;&lt;</a></td> 
     <td align="center"><? echo $month_names[$m-1]," ",$y ?></td> 
     <td align="right"><a href="<? echo $next ?>">&gt;&gt;&gt;</a></td> 
    </tr> 
   </table> 
  </td> 
 </tr> 
 <tr><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td><tr>
 
 
 
 <? 
  for($d=$start;$d<=$end;$d++) { 
    if (!($i++ % 7)) echo " <tr>\n";
    echo '  <td align="center">';
    if ($d < 1 OR $d > $day_count) {
      echo "&nbsp";
    } else {
      $now="$y-$m-".sprintf("%02d",$d);
      ##if (is_array($fill) AND in_array($now,$fill)) {
	  ###
       # echo '<a href="'.$_SERVER['PHP_SELF'].'?date='.$now.'"><font color="red">'.$d.'</font></a>'; 
      ###
	 # } else {
        echo '<a href="'.$_SERVER['PHP_SELF'].'?date='.$now.'"><font color="green">'.$d.'</font></a>';
     # }
    } 
    echo "</td>\n";
    if (!($i % 7))  echo " </tr>\n";
  } 
?>
</table>
<? } ?> 
