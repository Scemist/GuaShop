# GuaShop
GuaShop é o sistema de um projeto de unificação de comércio de uma cidade.

> _Desenvolvida tendo em mente Guararapes SP.
> O objetivo é uma plataforma online, onde qualquer cliente possa comprar de todas as lojas dos mais diversos tipos cadastradas no site.
> Sempre e somente trabalhando com delivery._

### É um sistema conceitual que não chegou a ser implantado, mas continua sendo desenvolvido com outros fins
    
As linguagens usadas são: HTML, CSS e PHP.
Com o front-end em Boostrap (explica a contagem errada do GitHub, pelo jQuery e Javascript usado pelo framework).

### O sistema é dividido em três sites

Na pasta raiz, pode-se ver como a página __index.php__ apenas redireciona para a pasta __utilitario__, isso acontece pois o sistema é dividido em 3 sites diferentes para o mesmo sistema:

* adm
* loja
* utilitario

O conceito do sistema é unificar o comercio da cidade em uma única plataforma.
Onde os administradores, responsáveis pelo sistema cadastram e administram as lojas, o site responsável por isso está na pasta __adm__.
Onde as lojas cadastradas entram e cadastram seus produtos, o site para isso está na pasta __loja__.
Onde as pessoas comuns, podem se tornar clientes cadastrando no site de vendas, localizado na pasta __utilitario__, e fazendo seus pedidos entregues às lojas no site __loja__.

### Para clonar o repositório

Na pasta raiz __> DOCUMENTOS > sql > Banco com dados como exemplo__ há tudo o que você precisa se quiser um banco de dados já preenchido para usar como exemplo e ver o site preenchido.
Basta executar o documento guashop.sql do local, e mover as imagens do local para a pasta __imagens__ vazia na pasta raiz do projeto.
