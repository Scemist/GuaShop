<?php

// Destroi a sessão e volta para a página de login

session_name('adm');
session_start();
session_unset();
session_destroy();

if (isset($_SESSION['logado'])) { // Erro ao finalizar sessão

	header("Location: ../index.php?msg=1");
	exit;
}
else { // Sessão finalizada

	header("Location: ../login.php");
	exit;
}