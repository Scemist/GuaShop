<?php

	// Cadastrar - função salvarImagem com atualizar false
	// Atualizar - função salvarImagem com atualizar true
	// Apagar - função apagarImagem com atualizar false

	function salvarImagem($tabela, $referencia, $atualizar) {

		global $conexao;

		// Se existir uma imagem
		if (is_uploaded_file($_FILES['imagem']['tmp_name'])) { 

			$pasta = '../../imagens/';
			$extensao = substr($_FILES['imagem']['name'], -4);
			$nome = $tabela . '_' . date('Y_m_H_i_s') . $extensao;

			// Salva na pasta imagens
			if (move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $nome)) {

				// Se for atualizar
				if ($atualizar == true) {
					
					$imagem = apagarImagem($tabela, $referencia, true);	
					
					$sql = $conexao -> prepare (
						'UPDATE
							imagem
						SET
							arquivo_imag = :arquivo,
							tabela_imag = :tabela,
							referencia_refe = :referencia
						WHERE
							id_imag = :imagem'
					);

					$sql -> bindParam(':arquivo', $nome);
					$sql -> bindParam(':tabela', $tabela);
					$sql -> bindParam(':referencia', $referencia);
					$sql -> bindParam(':imagem', $imagem);
					$sql -> execute();
				}
				// Se for cadastrar
				else if ($atualizar == false) {

					// Salva o nome no banco de dados
					$sql = $conexao -> prepare (
						'INSERT INTO imagem (
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
				}
			}
		}
	}

	function apagarImagem ($tabela, $referencia, $atualizar) {

		global $conexao;

		$sql = $conexao -> prepare ('SELECT id_imag, arquivo_imag FROM imagem WHERE tabela_imag = :tabela AND referencia_refe = :referencia');
		$sql -> bindParam (':tabela', $tabela);
		$sql -> bindParam (':referencia', $referencia);
		$sql -> execute();
		$imagens = $sql -> fetchAll();

		// Se há imagens
		if (($sql -> rowCount()) > 0) { 

			// Apaga todas do servidor
			foreach ($imagens as $imagem) {

				$arquivo = $imagem['arquivo_imag'];
				unlink("../../imagens/$arquivo");	
			}
		}

		// Se está apagando e não atualizando
		if ($atualizar == false) {

			// Apaga todas do banco de dados
			$sql = $conexao -> prepare('DELETE FROM	imagem WHERE tabela_imag = :tabela AND referencia_refe = :referencia');
			$sql -> bindParam(':tabela', $tabela);
			$sql -> bindParam(':referencia', $referencia);
			$sql -> execute();
		}

		return $imagens[0]['id_imag'];
	}
	
?>