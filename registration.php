<?php
	$csrf_token = $_POST['csrf_token'];
	session_start();

	if($csrf_token == $_SESSION['csrf_token']) {
		$dbh = new PDO("mysql:dbname=simpelblok;host=localhost","simpelblok","simpelblok");
		$Email = htmlentities($_POST['Email']);
		$Password = htmlentities($_POST['Password']);

		$stm = $dbh->prepare("SELECT * FROM user WHERE email=?");
		if ($stm === false) {
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
		}
		$stm->bindParam(1, $Email);
    	$stm->execute();

    	$isUserExist = False;
    	while ($stm->fetch(PDO::FETCH_ASSOC)) {
    		$isUserExist = True;
    	}

    	if ($isUserExist) {
    		header('Location: register.php');
    	} else {
    		$dbh = new PDO("mysql:dbname=simpelblok;host=localhost", "simpelblok", "simpelblok");
    		$stm = $dbh->prepare("INSERT INTO user (email,password) VALUES (?,?)");
    		if ($stm === false) {
				trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
			}
			$stm->bindParam(1, $Email);
			$stm->bindParam(2, $Password);
			$stm->execute();
			header('Location: login.php');
    	}
	} else {
		header('Location: register.php');
	}
?>
