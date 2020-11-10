<?php

	session_name('adm');
	session_start();

	if (isset($_SESSION['logado'])) {
		
	}
	else {
		
		header("Location: login.php");
		exit;
	}

?>
