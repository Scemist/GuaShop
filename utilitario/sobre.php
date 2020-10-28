<?php

  include_once('conexao/conexao.php');

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
    <meta charset="utf-8">
		<meta name="theme-color" content="#6b2278"> <!-- Cor do brownser -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Tag de viewport -->

		<link rel="icon" type="imagem/png" href="../favicon.ico"> <!-- Flavicon -->
		<link rel="stylesheet" href="../bootstrap/bootstrap-4.5.3.min.css"> <!-- CSS Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/navbar.css"> <!-- CSS NavBar -->
		<link rel="stylesheet" type="text/css" href="css/geral.css"> <!-- CSS Personalizado -->

		<style type="text/css">
			.collapse {
				transition: transform .4s ease-in-out,-webkit-transform .4s ease-in-out;
			}
		</style>

		<title>Sobre - GuaShop</title>
	</head>

	<body class="bg-light">

		<?php require_once('externo/navbar.php') ?>

		<main class="container">
			<div class="jumbotron jumbotron-fluid mx-2 rounded">
				<div class="container">
					<h1 class="my-2 display-4">Sobre nós</h1>

					<p class="my-2 text-muted lead">O que nós fazemos. O que queremos fazer.</p>

					<hr class="my-4">

					<h4 class="lead">O GuaShop foi desenvolvido especialmente para você comerciante de <strong>Guararapes SP</strong></h4>
				</div>
    		</div>

    		<div class="col-12 col-xl-12 text-center">
    			<div class="card card-body my-3 shadow-lg">
		    		<p class="lead font-weight-normal paragrafo text-muted my-5">
		    			Há algum tempo nós percebemos que a cidade de Guararapes por mais que fosse antiga, possui um mercado interno simples e mal desenvolvido. <br><br> Parecia que o comércio da cidade não conseguia se modernizar, ou pelos menos se atualizar de acordo com a maioria dos mercados atuais. <br><br> Dado isso, havia uma dificuldade de expandir o seu comércio para outras áreas não abordadas ainda na cidade, mesmo que ela necessitasse de um salto econômico para melhorar a qualidade de consumo da cidade.
		   			</p>

		   			<p class="lead font-weight-normal paragrafo text-muted mb-5">
			    		Além disso, notamos uma falta de conforto para o consumidor, devido a necessidade de sair de casa sempre que quisesse comprar algo, mesmo que a situação não o permita, ele deveria sair de seu domicílio para alcançar determinado produto.<br><br>
						Outro aspecto negativo desse antigo sistema, era a falta de informação sobre determinado produto ou loja, a desinformação do consumidor gerada pelo mercado atual, ocasionava em uma queda econômica para o vendedor.
			   		</p>
				</div>

				<!-- <img src="../icones/risco_mercado.png" class="mt-2" width="180px"> -->

	    		<hr class="my-5">

    			<div class="card card-body my-3 shadow-lg">
			    	<p class="lead font-weight-normal paragrafo text-muted my-5">
			    		Pensando nisso, desenvolvemos um sistema que é capaz de entregar todo o conforto que o consumidor merece, e toda a segurança que o comerciante necessita. <br><br> Um site que oferece toda a informação necessária sobre algum produto ou loja que o cliente deseja. <br><br> Abrangemos um vasto mercado com uma incrível diversidade de loja e setores disponíveis, tudo isso em apenas um sistema.
			   		</p>
	    		</div>
    		</div>

    		<div class="row faixa mb-5 mx-2 rounded">
				<div class="col-12">
					<hr class="m-1">
				</div>
			</div>

    		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    			<p class="lead font-weight-normal text-muted text-center">Garantimos pra você o conforto, a informação, a facilidade e a qualidade necessária para o seu consumo. </p>
        	</div>
		</main>

  		<?php  require_once('externo/footer.php')  ?>

		<script src="../bootstrap/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
		<script src="../bootstrap/bootstrap.bundle-4.5.3.min.js"></script> <!-- Bundle -->
    	<script type="text/javascript" src="jquery/navbar.js"></script> <!-- jQuery NavBar -->
	</body>
</html>
