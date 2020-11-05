function cep() {
				
	const adicionar = window.document.querySelector('#adicionar')
	
	function pegarCep(){
		
		var resposta
		var cep = window.document.querySelector('#cep').value
		const localidade = window.document.querySelector('#localidade')
		const uf = window.document.querySelector('#uf')
		const xhr = new XMLHttpRequest()

		xhr.responseType = 'json'
		xhr.onreadystatechange = function (){

			if (xhr.readyState == 4 && xhr.status == 200) {

				resposta  = xhr.response
				localidade.value = resposta['localidade']
				uf.value = resposta['uf']
			}
		}
		xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/')
		xhr.send()
	}
	
	adicionar.addEventListener('click', pegarCep)
}

cep()