<?PHP
## PHP4
## Построение дерева

## подключаемся к базе данных
$mysqli = new mysqli('localhost', 'root', '', 'test_base');
	if (mysqli_connect_errno()){
			printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
			exit;
	}
	
## метод читает из таблицы comment_table все строки, и
## возвращает двумерный массив, в котором первый ключ - id родителя 
## категории (parent_id)
## @return Array
function getComment_table(){
	global $mysqli;
	$query = "SELECT * FROM `comment_table`";
	$res = $mysqli->query($query);
	$result = array();
	while ($row = mysqli_fetch_array($res)){
		$result[$row["parent_id"]][] = $row;
	}
	return $result;
}

## в переменную $name_arr записываем все имена
$name_arr = getComment_table();

## вывод дерева
## @param Integer $parent_id - id-родителя
## @param Integer $level - уровень вложенности
function outTree($parent_id, $level){
	global $name_arr; ## делаем переменную $name_arr видимой в функции
	if (isset($name_arr[$parent_id])){ ##если категория с таким id существует
		foreach ($name_arr[$parent_id] as $value){ ## обходим
			## выводим категорию
			## $level * 25 - отступ, $level - хранит текущий уровень вложенности (0,1,2..)
			#print_r ($value);
			echo "<div style=\"margin-left:".($level * 25)."px;\">".$value["name"]."<br>".$value["comment"]."</div>"; 
			$level++; ## увеличиваем уровень вложености
			## рекурсивно вызываем эту же функцыю, но с новым parent_id и $level
			outTree($value["id"], $level);
			$level--; ## уменьшаем уровень вложености
		}
	}
}
?>
