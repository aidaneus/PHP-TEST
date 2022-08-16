<?php
require_once 'connect.php';
require_once 'classes/request.php';
require_once 'table/table.php';
require_once 'style.html';
?>

<!DOCTYPE HTML>
	<html>
		<head>
			<meta charset="utf-8">
    		<title>Права доступа</title>
  		</head>
  		<body>
    		<style>
				table {
				font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
				text-align: left;
				border-collapse: separate;
				border-spacing: 1px;
				background: #ECE9E0;
				color: #656665;
				border: 8px solid #ECE9E0;
				border-radius: 20px;
				}
				th {
				font-size: 18px;
				padding: 10px;
				}
				td {
				background: #F5D7BF;
				padding: 10px;
				}
    		</style>
			<?php
			table($request);
			?>
		<p><a href="http://localhost/PHP-TEST/add_group/add_group.php">Создать группу-></a></p>
		<p><a href="http://localhost/PHP-TEST/add_users/add_users.php">Добавить пользователя в группу-></a></p>
		<p><a href="http://localhost/PHP-TEST/delete_users/delete_users.php">Удалить пользователя из группы-></a></p>
		<p><a href="http://localhost/PHP-TEST/delete_group/delete_group.php">Удалить группу-></a></p>
 		</body>
	</html>