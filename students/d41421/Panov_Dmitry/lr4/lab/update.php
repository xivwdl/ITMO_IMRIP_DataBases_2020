<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<title>Изменение данных</title>
	</head>
	<body>
		<hr>
		<h3>Введите ID врача и его новые данные, для внесения изменений</h3>
		<ul>
			<form name="update" action="update.php" method="POST" >
				<ul>ID существующего врача:</ul><ul><input type="int" name="doc_id"/></ul>
				<ul>ФИО врача:</ul><ul><input type="text" name="doc_name"/></ul>
				<ul>Пол врача:</ul><ul><input type="text" name="doc_gender"/></ul>
				<ul>Дата рождения:</ul><ul><input type="date" name="doc_birth"/></ul>
				<ul>Специальность:</ul><ul><input type="text" name="doc_spec"/></ul>
				<ul>Вуз:</ul><ul><input type="text" name="doc_edu"/></ul>
				<br/>
				<ul><input type="submit" name="Update" /></ul>
			</form>
		</ul>
		<hr>
	
		<?php
			echo "<br/>";
			$dbuser = "postgres";
			$dbpass = "123";
			$host = "localhost";
			$dbname= "hospital";
			$table = '"hospitalDB".doctors';
			$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (isset($_POST["Update"])) {
						$sql = "update $table set \"doc_name\"='$_POST[doc_name]', \"doc_gender\"='$_POST[doc_gender]',
						\"doc_birth\"='$_POST[doc_birth]', \"doc_spec\"='$_POST[doc_spec]' where \"doc_id\"='$_POST[doc_id]'";
						$result = pg_query($db, $sql);
						$result = pg_fetch_all($result);
						pg_close($db);
					}
			}

			$dbuser = "postgres";
			$dbpass = "123";
			$host = "localhost";
			$dbname= "hospital";
			$table = '"hospitalDB".doctors';
			$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
			$info = "select * from $table";
			$result = pg_query($db, $info);
			$result = pg_fetch_all($result);
		?>

		<table>
		<thead>
			<tr>
			<th><?php echo implode('</th><th>', array_keys($result[0])); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($result as $row): array_map('htmlentities', $row); ?>
			<tr>
			<td><?php echo implode('</td><td>', $row); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
		</br>
		<a href="index.html">На главную</a><br/>
	</body>
</html>
