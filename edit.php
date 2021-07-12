<?php
	session_start();
	require_once "connection.php";
	
	if(!isset($_SESSION['username'])){
		die("ACCESS DENIED");
	}
	$sql ="SELECT * FROM autos WHERE id=:id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":id" => $_GET['id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row === false){
		error_log("Bad value");
		header("Location:index.php");
		return;
	}
	$input1=htmlentities($row['make']);
	$input2=htmlentities($row['model']);
	$input3=htmlentities($row['year']);
	$input4=htmlentities($row['mileage']);
	
	if(isset($_POST['save']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model'])){
		if(strlen($_POST['year'])<1 || strlen($_POST['mileage'])<1 || strlen($_POST['model'])<1 || strlen($_POST['make'])<1){
			echo "<p style='color:red'>"."All values are required";
		}
		elseif(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
			echo "<p style='color:red'>"."Mileage and year must be numeric<br>";
		}
		else{
			$sql_1 ="UPDATE autos SET make=:mk,model=:md,year=:yr,mileage=:mil WHERE id=:id";
			$stmt_1 = $pdo->prepare($sql_1);
			$stmt_1->execute(array(
				':mk' => $_POST['make'],
				':md' => $_POST['model'],
				':yr' => $_POST['year'],
				':mil' => $_POST['mileage'],
				':id' => $_POST['id']));
				$_SESSION['success'] = "Record edited";
				header("Location:index.php");
				return;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>SK. ATIK TAJWAR SIHAN</title>
</head>
<body>
 <?php echo "<h1>"."Tracking Autos for ".$_SESSION['username']."</h1>"; ?>
	<form method="post">
	<p><lable>Make:</lable></p>
	<input type="text" name="make" size="40" value="<?= $input1 ?>">
	<p><lable>Model:</lable></p>
	<input type="text" name="model" size="40" value="<?= $input2 ?>">
	<p><lable>Year:</lable></p>
	<input type="text" name="year" size="40" value="<?= $input3 ?>">
	<p><lable>Make:</lable></p>
	<input type="text" name="mileage" size="40" value="<?= $input4 ?>">
	<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	<br><br>
	<input type="submit" name="save" value="Save">
	<input type="button" onclick="location.href='view.php';return false;" value="Cancel">
	</form>
</body>
</html>