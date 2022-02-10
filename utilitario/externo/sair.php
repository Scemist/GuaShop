<?php

// Destroi a sessão e volta para a página de login

session_name('utilitario');
session_start();
session_unset();
session_destroy();

if (isset($_SESSION['logado'])): // Erro ao finalizar sessão

	echo "Opa! Sua sessão não foi finalizada.";
	exit;
else: // Sessão finalizada

	header("Location: ../index.php");
	exit;
endif;