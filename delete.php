<?php
	require_once "connection.php";
	session_start();
	
	if(!isset($_SESSION['username'])){
		 die("ACCESS DENIED");
	}
	if(isset($_POST['del'])){
		$sql = "DELETE FROM autos WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":id" => $_GET['id']));
		$_SESSION['success'] = "Record deleted";
		header("Location:index.php");
		return;
	}
	$sql_2 = "SELECT make FROM autos WHERE id=:id";
	$stmt_2 = $pdo->prepare($sql_2);
	$stmt_2->execute(array(":id" => $_GET['id']));
	$row = $stmt_2->fetch(PDO::FETCH_ASSOC);
	echo "Confirm: Deleting ".$row['make'];
?>
<!DOCTYPE html>
<html>
<head>
<title>SK. ATIK TAJWAR SIHAN</title>
</head>
<body>
	<form method="post">
	<input type="submit" name="del" value="Delete">
	</form>
	<a href="view.php">Cancel</a>
</body>
</html>