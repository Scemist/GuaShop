<?php

	function salvarImagem($tabela, $referencia) {

		global $conexao;

		if (is_uploaded_file($_FILES['imagem']['tmp_name'])) { // Se existir uma imagem

			// Salva na pasta imagens

			$pasta = '../../imagens/';
			$extensao = substr($_FILES['imagem']['name'], -4);
			$nome = $tabela . "_" . date('Y_m_H_i_s') . $extensao;

			if (move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $nome)) { // Se for salvo com sucesso

				// Salva o nome no banco de dados

				$sql = $conexao -> prepare (
					'INSERT INTO
						imagem (
							arquivo_imag,
							tabela_imag,
							referencia_refe
						)
					VALUES (
							:arquivo,
							:tabela,
							:referencia
						)'
				);
				$sql -> bindParam(':arquivo', $nome);
				$sql -> bindParam(':tabela', $tabela);
				$sql -> bindParam(':referencia', $referencia);
				$sql -> execute();
				
				apagarImagem();
			}
		}
	}

	function apagarImagem () {

		global $conexao;

		if ($antigaImagem = $_POST['antigaImagem'] == true) {

			echo "havia uma imagem";
					
			$antigaImagemNome = $_POST['antigaImagemNome'];
			unlink("../../imagens/$antigaImagemNome");
			
			$sql = $conexao -> prepare('DELETE FROM	imagem WHERE arquivo_imag = :arquivo');
			$sql -> bindParam(':arquivo', $antigaImagemNome);
			$sql -> execute();
		}
	}
	
?>