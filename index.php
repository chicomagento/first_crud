<?php
	session_start();
?>
<html lang="pt-br">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<meta charset = "utf8">
<title> CRUD </title>
</head>

<?php 
	$server = "localhost";
	$user = "root";
	$pass = "123123";
	$db_name = "chicomagento";
	
	$connect_mysql = mysqli_connect($server, $user, $pass, $db_name);

	$cmd_sql = "select users.*, 
	sit.name sitname, acclvl.name accname
	from user users 
	join situation sit on sit.id = users.situation_id
	join access_lvl acclvl on acclvl.id = users.access_lvl_id";
	$connect_sql = mysqli_query($connect_mysql, $cmd_sql);
?>

<body>
<?php
	if(isset($_SESSION['msg'])) {
		echo "<p>".($_SESSION['msg'])."</p>";
		unset($_SESSION['msg']);
	} 
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Mail</th>
      <th scope="col">Created</th>
	  <th scope="col">Situation</th>
	  <th scope="col">Access Level</th>
    </tr>
  </thead>
  <tbody>
	<?php
	while($result_sql = mysqli_fetch_assoc($connect_sql)) {
	?>	
		<tr>
		  <td><?php echo $result_sql['id'] ?></td>
		  <td><?php echo $result_sql['name'] ?></td>
		  <td><?php echo $result_sql['mail'] ?></td>
		  <td><?php echo $result_sql['created'] ?></td>
		  <td><?php echo $result_sql['sitname'] ?></td>
		  <td><?php echo $result_sql['accname'] ?></td>
		</tr>
		
	<?php
	}
	?>
  </tbody>
</table>

<a href="user_cadastrer.php">User Cadastrer</a>

<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>