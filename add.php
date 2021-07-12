<?php
	session_start();
	require_once "connection.php";
	
	$input1=isset($_POST['make'])?$_POST['make']:'';
	$input2=isset($_POST['model'])?$_POST['model']:'';
	$input3=isset($_POST['year'])?$_POST['year']:'';
	$input4=isset($_POST['mileage'])?$_POST['mileage']:'';
	if(!isset($_SESSION['username'])){
		die("ACCESS DENIED");
	}
	elseif(isset($_POST['add']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model'])){
		if(strlen($_POST['year'])<1 || strlen($_POST['mileage'])<1 || strlen($_POST['model'])<1 || strlen($_POST['make'])<1){
			echo "<p style='color:red'>"."All values are required";
		}
		elseif(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
			echo "<p style='color:red'>"."Mileage and year must be numeric<br>";
		}
		else{
			$sql = "INSERT INTO autos(make,model,year,mileage,id) VALUES(:mk,:md,:yr,:mil, :id)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':mk' => $_POST['make'],
				':md' => $_POST['model'],
				':yr' => $_POST['year'],
				':mil' => $_POST['mileage'],
				':id' => $_POST['id']));
			if(isset($_POST['add']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model'])){
				$_SESSION['success'] = "added";
				header("Location:index.php");
				return;
			}
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
	<input type="text" name="make" size="40" value="<?= htmlentities($input1) ?>">
	<p><lable>Model:</lable></p>
	<input type="text" name="model" size="40" value="<?= htmlentities($input2) ?>">
	<p><lable>Year:</lable></p>
	<input type="text" name="year" size="40" value="<?= htmlentities($input3) ?>">
	<p><lable>Mileage:</lable></p>
	<input type="text" name="mileage" size="40" value="<?= htmlentities($input4) ?>"><br>
	<input type="submit" name="add" value="Add">
	<input type="button" onclick="location.href='view.php';return false;" value="Cancel">
	</form>
</body>
</html>