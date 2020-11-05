function exibirImagem() {

	const arquivoImagem = document.querySelector('#arquivoImagem')

	function exibir () {

		var vizualizacao = document.querySelector('img')
		var file = document.querySelector('input[name="imagem"]').files[0]
		var leitor = new FileReader();

		leitor.onloadend = function () {

			vizualizacao.src = leitor.result
		}

		if (file) {

			leitor.readAsDataURL(file)
		} 
	}

	arquivoImagem.addEventListener('change', exibir)
}

exibirImagem()
