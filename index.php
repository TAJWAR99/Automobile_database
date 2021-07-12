<?php
	session_start();
	require_once "connection.php";

	if(isset($_SESSION['success'])){
		echo "<p style='color:green'>".$_SESSION['success']."<br><br>";
		unset($_SESSION['success']);
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>SK. ATIK TAJWAR SIHAN</title>
</head>
<body>
	<h1>Welcome to the Automobiles Database</h1>
	<?php
		if(!isset($_SESSION['username'])){ ?>
			<a href="login.php">Please log in</a>
	        <p>Attempt to <a href="add.php">add data</a> without logging in</p>
	<?php	}else{ ?>
	
	<table border="1">
	<?php
	
	$statement = $pdo->query("SELECT make,model,year,mileage,id FROM autos");
	
	echo "<tr><td>";
	echo "<b>Make</b>";
	echo "</td><td>";
	echo "<b>Model</b>";
	echo "</td><td>";
	echo "<b>Year</b>";
	echo "</td><td>";
	echo "<b>Mileage</b>";
	echo "</td><td>";
	echo "<b>Action</b>";
	echo "</td></tr>";
		
	while($row=$statement->fetch(PDO::FETCH_ASSOC)){
		echo "<tr><td>";
		echo htmlentities($row['make']);
		echo "</td><td>";
		echo htmlentities($row['model']);
		echo "</td><td>";
		echo htmlentities($row['year']);
		echo "</td><td>";
		echo htmlentities($row['mileage']);
		echo "</td><td>";
		echo ('<a href="edit.php?id='.$row['id'].'">Edit</a>');
	    echo "/";
	    echo ('<a href="delete.php?id='.$row['id'].'">Delete</a>');
		echo "</td></tr>";
	}
	?>
	</table>
	<br><br>
	<p>
	<a href="add.php">Add New Entry</a> |
	<a href="logout.php">Logout</a>
	</p>
	<?php } ?>
</body>
</html>