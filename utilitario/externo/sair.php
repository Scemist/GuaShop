<?php

	// Destroi a sessão e volta pra pagina de login

	session_start();
  session_unset();
	session_destroy();

  if (isset($_SESSION['logado'])) {
    echo "Opa! Sua sessão não foi finalizada.";

  }
  else {

    header("Location: ../index.php");
  }


?>
