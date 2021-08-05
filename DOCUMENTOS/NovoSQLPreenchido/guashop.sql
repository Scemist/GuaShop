CREATE DATABASE guashop CHARACTER SET utf8 COLLATE utf8_general_ci;

USE guashop;

CREATE TABLE imagem (

	id_imag INT PRIMARY KEY AUTO_INCREMENT,
	arquivo_imag VARCHAR(100) NOT NULL,
	tabela_imag VARCHAR(100) NOT NULL,
	referencia_refe VARCHAR(100) NOT NULL

) ENGINE=InnoDB;

CREATE TABLE usuario (

	id_usua INT PRIMARY KEY AUTO_INCREMENT,
	nome_usua VARCHAR(100) NOT NULL,
	sobrenome_usua VARCHAR(100) NOT NULL,
	email_usua VARCHAR(100) NOT NULL,
	senha_usua VARCHAR(100) NOT NULL,
	telefone_usua VARCHAR(17) NULL,
	cpf_usua VARCHAR(11) NULL,
	rg_usua VARCHAR(11) NULL,
	nascimento_usua DATE NULL,
	estado_usua VARCHAR(50) NULL,
	cidade_usua VARCHAR(50) NULL,
	cep_usua INT(8) NULL,
	rua_usua VARCHAR(100) NULL,
	numero_usua VARCHAR(20) NULL,
	complemento_usua VARCHAR(100) NULL

) ENGINE=InnoDB;

CREATE TABLE cartao (

	id_cart INT PRIMARY KEY AUTO_INCREMENT,
	codigo_cart VARCHAR(3) NOT NULL,
	numero_cart VARCHAR(16) NOT NULL,
	nome_cart VARCHAR(255) NOT NULL,
	vencimento_cart DATE NOT NULL,
	nascimento_cart DATE NOT NULL,
	id_usua INT NOT NULL,
	CONSTRAINT fk_CarUsu FOREIGN KEY (id_usua) REFERENCES usuario (id_usua) ON DELETE CASCADE

) ENGINE=InnoDB;

CREATE TABLE loja (

	id_loja INT PRIMARY KEY AUTO_INCREMENT,
	usuario_loja VARCHAR(200) NOT NULL,
	senha_loja VARCHAR(200) NOT NULL,
	nome_loja VARCHAR(100) NOT NULL,
	sobre_loja VARCHAR(5000) NOT NULL,
	estado_loja VARCHAR(50) NOT NULL,
	cidade_loja VARCHAR(50) NOT NULL,
	cep_loja INT(8) NOT NULL,
	rua_loja VARCHAR(100) NOT NULL,
	numero_loja VARCHAR(20) NOT NULL,
	complemento_loja VARCHAR(100) NOT NULL,
	ativo_loja INT(1) NOT NULL

) ENGINE=InnoDB;

CREATE TABLE produto (

	id_prod INT PRIMARY KEY AUTO_INCREMENT,
	nome_prod VARCHAR(100) NOT NULL,
	descricao_prod VARCHAR(100) NOT NULL,
	preco_prod DECIMAL(10,2) NOT NULL,
	caracteristicas_prod VARCHAR(100) NULL,
	promocao_prod DECIMAL(10,2) NULL,
	id_seto VARCHAR(200) NOT NULL,
	id_loja INT NOT NULL,
	CONSTRAINT fk_ProLo FOREIGN KEY (id_loja) REFERENCES loja (id_loja) ON DELETE CASCADE

) ENGINE=InnoDB;

CREATE TABLE setor (

	id_seto INT PRIMARY KEY AUTO_INCREMENT,
	nome_seto VARCHAR(100) NOT NULL,
	descricao_seto VARCHAR(200) NULL

) ENGINE=InnoDB;

CREATE TABLE administrador (

	id_admi INT PRIMARY KEY AUTO_INCREMENT,
	nome_admi VARCHAR(100) NOT NULL,
	usuario_admi VARCHAR(255) NOT NULL,
	senha_admi VARCHAR(100) NOT NULL

) ENGINE=InnoDB;

CREATE TABLE pedido (

	id_pedi INT PRIMARY KEY AUTO_INCREMENT,
	valor_pedi DECIMAL(10,2) NULL,
	horario_pedi TIME NOT NULL,
	data_pedi DATE NOT NULL,
	endereco_pedi VARCHAR(255) NULL,
	formapagamento_pedi VARCHAR(255),
	destinatario_pedi VARCHAR (100),
	estado_pedi VARCHAR(100),
	id_cart INT NULL,
	id_usua INT NOT NULL,
	CONSTRAINT fk_PeUsu FOREIGN KEY (id_usua) REFERENCES usuario (id_usua) ON DELETE CASCADE,
	CONSTRAINT fk_PeCAr FOREIGN KEY (id_cart) REFERENCES cartao (id_cart) ON DELETE CASCADE

) ENGINE=InnoDB;

CREATE TABLE item_pedido (

	id_item INT PRIMARY KEY AUTO_INCREMENT,
	quantidade_item INT NOT NULL,
	promocao_item DECIMAL(10,2) NULL,
	valor_item DECIMAL(10,2) NULL,
	estado_item VARCHAR(100) NOT NULL,
	valorfinal_item DECIMAL(10,2) NOT NULL,
	id_prod INT NOT NULL,
	id_pedi INT NOT NULL,
	CONSTRAINT fk_ItePro FOREIGN KEY (id_prod) REFERENCES produto (id_prod) ON DELETE CASCADE,
	CONSTRAINT fk_ItePe FOREIGN KEY (id_pedi) REFERENCES pedido (id_pedi) ON DELETE CASCADE

) ENGINE=InnoDB;

CREATE TABLE salvo_produto (

	id_salv INT PRIMARY KEY AUTO_INCREMENT,
	tipo_salv VARCHAR(20) NOT NULL,
	quantidade_salv INT NOT NULL,
	id_usua INT NOT NULL,
	id_prod INT NOT NULL,
	CONSTRAINT fk_SaUsu FOREIGN KEY (id_usua) REFERENCES usuario (id_usua) ON DELETE CASCADE,
	CONSTRAINT fk_SaPro FOREIGN KEY (id_prod) REFERENCES produto (id_prod) ON DELETE CASCADE

) ENGINE=InnoDB;

-- Insere os dados dos primeiros administradores e setores

INSERT INTO `administrador` (`nome_admi`, `usuario_admi`, `senha_admi`) VALUES
('Lucas', 'lucas', '3f71c2f545e0331bb971b592f73ac2e4'), -- Senha 'goncalves'
('Nathan', 'nathan', '83a6c8fb8e054de73cb4f76c3c6f9701'), -- Senha 'henrique'
('Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'); -- Senha 'admin'

INSERT INTO `setor` (`id_seto`, `nome_seto`, `descricao_seto`) VALUES
(1, 'Fast Food', ''),
(2, 'Alimentação', ''),
(3, 'Farmácia', ''),
(4, 'Vestuário', ''),
(5, 'Perfumaria', ''),
(6, 'PetShop', ''),
(7, 'Móveis', ''),
(8, 'Eletrodomésticos', ''),
(9, 'Diversos', '');

-- Insere os dados opcionais, já com itens cadastrados

INSERT INTO `imagem` (`id_imag`, `arquivo_imag`, `tabela_imag`, `referencia_refe`) VALUES
(1, 'loja_2020_11_19_05_40.jpg', 'loja', '1'),
(2, 'loja_2020_11_19_08_31.jpg', 'loja', '2'),
(3, 'loja_2020_11_19_17_15.png', 'loja', '3');

INSERT INTO `loja` (`id_loja`, `usuario_loja`, `senha_loja`, `nome_loja`, `sobre_loja`, `estado_loja`, `cidade_loja`, `cep_loja`, `rua_loja`, `numero_loja`, `complemento_loja`, `ativo_loja`) VALUES
(1, 'bruna', '0e00810c8e1d6a7b11516e6ec9b1d0a8', 'Gatteria', 'Gatinho feliz, gatinho dorminhoco, móveis, brinquedos e alimentação.', 'SP', 'Guararapes', 16700000, 'Centro', '213', '', 1),
(2, 'clave', '12313a3d28f802e3a22b07d2e01c6dcf', 'Clave de Sol', 'Instrumentos, partituras, e ferramentas para músicos e musicistas.', 'MG', 'Fronteira', 38230000, 'Avenida Ruaro', '465', 'Frente ao Coreto', 1),
(3, 'crimson', '2d92876b2dfe87d8ac442b581a9f0445', 'Crimson Vinhos', 'A adega oficial do projeto Crimson Vinhos, com o melhor catálogo explicado em scemist.github/crimson', 'MG', 'Prata', 38140000, 'Rua dos tridentes', '50', 'Casa', 0);