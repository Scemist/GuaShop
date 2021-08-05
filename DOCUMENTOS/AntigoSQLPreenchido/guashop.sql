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
('Lucas', 'lucasgoncalves', 'lucas'),
('Nathan', 'nathanhenrique', 'nathan');

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

INSERT INTO `imagem` (`arquivo_imag`, `tabela_imag`, `referencia_refe`) VALUES
('1507202008070650.jpg', 'loja', '1'),
('1507202008070753.jpg', 'loja', '2'),
('1507202008070813.png', 'loja', '3'),
('1507202008071533.jpg', 'loja', '4'),
('1507202008071232.jpg', 'loja', '5'),
('1507202008071312.jpg', 'loja', '6'),
('1507202008071337.jpg', 'loja', '7'),
('square.png', 'loja', '8'),
('1507202008071637.png', 'loja', '9'),
('Calça Jeans Skinny com Laicra1507202008074452.jpg', 'produto', '1'),
('Coxinha de Brócolis Roxo1507202008074736.jpg', 'produto', '2'),
('Pasteis, sabores1507202008074755.jpg', 'produto', '8'),
('Açaí Gelado na Tigela1507202008074808.jpg', 'produto', '9'),
('Hambúrger Caseiro1507202008074827.jpg', 'produto', '10'),
('Arranhador Simples com Ratinho1507202008074938.jpg', 'produto', '3'),
('Bebedouro Inox para Gatos1507202008074958.jpg', 'produto', '4'),
('Arranhador1507202008075024.jpg', 'produto', '24'),
('Guitarra Stratocaster 6 cordas Ibanez1507202008075128.jpg', 'produto', '5'),
('Partitura Dream Theater - Metropolis Pt. I1507202008075142.png', 'produto', '6'),
('Hambúrguer1507202009071841.jpg', 'produto', '11'),
('Bolo1507202009071901.jpg', 'produto', '12'),
('Bistrô Funcional1507202009071912.jpg', 'produto', '13'),
('Benalet1507202009072244.jpg', 'produto', '16'),
('Cloridrato de betaina1507202009072258.png', 'produto', '17'),
('Allegra1507202009072307.jpg', 'produto', '18'),
('Resfenol1507202009072410.jpg', 'produto', '19'),
('Kit calça Jogger1507202009073851.jpg', 'produto', '20'),
('Camisa Jeans1507202009074134.jpg', 'produto', '21'),
('Jaqueta Nike1507202009074220.jpg', 'produto', '22'),
('Buffet Classic1507202009074401.jpg', 'produto', '25'),
('Conjunto Sala de Jantar1507202009074450.jpg', 'produto', '26'),
('Rack para TV1507202009074517.jpg', 'produto', '27'),
('Cama casal1507202009074536.jpg', 'produto', '28'),
('Cafeteira 1507202009075102.jpg', 'produto', '29'),
('Smart Tv1507202009075145.jpg', 'produto', '30'),
('Computador1507202009075213.jpg', 'produto', '32'),
('Refrigerado1507202003070918.jpg', 'produto', '31'),
('Picolé1507202009075718.jpg', 'produto', '14'),
('Ovomaltine1507202009075849.jpg', 'produto', '15');

INSERT INTO `loja` (`id_loja`, `usuario_loja`, `senha_loja`, `nome_loja`, `sobre_loja`, `estado_loja`, `cidade_loja`, `cep_loja`, `rua_loja`, `numero_loja`, `ativo_loja`) VALUES
(1, 'alucard', '1234', 'Alucard', 'Uma loja de roupas para zumbis do bem.', 'Minas Gerais', 'Prata', '16700000', 'Av. Brasil', '1836', 1),
(2, 'bruna', 'oliveramora', 'Gatteria', 'Gatinho feliz, gatinho dorminhoco. Móveis, brinquedos e alimentação.', 'São Paulo', 'São José do Rio Preto', '16700000', 'Av. Badi Ba City', '365', 1),
(3, 'clavede', 'sol', 'Clave de Sol', 'Clave de Sol é uma loja de música, uma das mais antigas da cidade, agora, vendendo também online. Desde instrumentos, partituras e palhetas a acessórios básicos e avançados.', 'São Paulo', 'Guararapes', '16700000', 'Padre Vadir Oitu', '124', 1),
(4, 'good food', 'comida boa', 'Good Food', 'O melhor cardápio da cidade', 'São Paulo', 'São Paulo', '16700000', 'José Augusto', '122', 1),
(5, 'luanda', '12345', 'Manipura', 'Os melhores Remédios você encontra aqui', 'Amazonas', 'Manaus', '16700000', 'Dom Pão I', '722', 1),
(6, 'alicia', 'santosalmeida', 'Yourbrand', 'Onde você se encontra ', 'São Paulo', 'Birigui', '16700000', 'Escapena', '347', 1),
(7, 'detalhe', 'moveis1906', 'Detalhe', 'Detalhe móveis, seu móvel melhor que nunca', 'Paraíba', 'Campina Grande', '16700000', 'Sumida', '15', 1),
(8, 'shopclub12', 'carlosalmeida', 'Shopclub', 'Eletrodomésticos: geladeira, fogão, freezer e mais ofertas ShopClub', 'São Paulo', 'Araçatuba', '16700000', 'Dom Pão I', '45', 1),
(9, 'klaus', 'melhor123', 'Sorveteria Klaus', 'Uma sorveteria que pensa em você', 'Rio de janeiro', 'Niterói', '16700000', 'Dom Pão I', '2424', 1);

INSERT INTO `produto` (`id_prod`, `nome_prod`, `descricao_prod`, `preco_prod`, `caracteristicas_prod`, `promocao_prod`, `id_seto`, `id_loja`) VALUES
(1, 'Calça Jeans Skinny com Laicra', 'Uma calça jeans para vestir. É grande e também curta. Mas as vezes da trabalho. Uma calça jeans para', '899.00', 'Azul PP																														', '0.00', '4,', 1),
(2, 'Coxinha de Brócolis Roxo', 'Coxinha vegana de brócolis', '2.00', 'Sabor: Brócolis Roxo\r\n								', '0.00', '1,2,', 1),
(3, 'Arranhador Simples com Ratinho', 'Arranhador simples e divertido para gatinhos.', '80.00', 'Arranhador de cordas com brinquedos.\r\n\r\nAltura: 65cm						', '10.00', '6,', 2),
(4, 'Bebedouro Inox para Gatos', 'Bebedouro tipo fonte em inox para gatos.', '70.00', 'Tensão: 110v e 220v\r\nCapacidade: 2.5l\r\nMaterial: Inox\r\nAltura: 30cm\r\nPeso: 700g						', '0.00', '6,', 2),
(5, 'Guitarra Stratocaster 6 cordas Ibanez', 'Guitarra para versátil desde rock a metal da marca Ibanez. Novinha, acompanha tarrachas e ponte trem', '1200.00', 'Marca: Ibanez\r\nCordas: 6\r\nEstado: Novo\r\nCor: Preto e branco						', '0.00', '9,', 3),
(6, 'Partitura Dream Theater - Metropolis Pt. I', 'Partitura da banda Dream Theater na música Metropolis, The Miracle and the Sleeper Pt. II', '45.00', 'Música: Metropolis, The Miracle and the Sleeper Pt. II\r\nBanda: Metropolis\r\nPáginas: 27						', '5.00', '9,', 3),
(7, 'Arco para violinos Tly 4/4', ' Um arco da marca Tly para violinos, tem 30 cm de comprimento, e um timbre mais agudo.', '139.00', 'Marca: Tly\r\nMaterial: Madeira de carvalho\r\nTamanho: 4/4																														', '10.00', '9,', 3),
(8, 'Pasteis, sabores', 'Pastel frito, sabores: Frango, Pizza, ou Queijo', '4.00', 'Sabores: Frango, pizza ou quiejo						', '0.00', '1,', 1),
(9, 'Açaí Gelado na Tigela', 'Pote de açaí na tigela, pode adicionar acompanhamentos, caso prefira', '13.00', 'Acompanhamentos possíveis.						', '0.00', '1,', 1),
(10, 'Hambúrger Caseiro', 'Hambúrguer caseiro com carne de vaca, totalmente carnívoro', '13.00', 'Carne: patinho.\r\nSalada, molho e pimenta						', '0.00', '1,', 1),
(11, 'Hambúrguer', 'mega Hambúrguer ', '14.00', 'Pão, hambúrguer, queijo, alface, tomate 						', '0.00', '1,2,', 4),
(12, 'Bolo', 'Bolo sobremesa', '27.00', 'Sabor leite ninho, morango, calda.						', '8.00', '2,', 4),
(13, 'Bistrô Funcional', 'Bistrô Funcional: Prato de Comida Funcional', '24.00', 'queijo, carne moída, pepino, alface.						', '1.00', '2,', 4),
(14, 'Picolé', 'Picolé ao leite com Fruta', '19.00', 'Sabores: morango, uva, leite condensado, chocolate						', '1.00', '2,', 9),
(15, 'Ovomaltine', 'Soverte sabor Ovomaltine', '13.00', 'Sorvete edição limita Ovomaltine												', '1.00', '2,', 9),
(16, 'Benalet', 'Contra tosse, irritação na garganta e faringite ', '10.00', 'Leia a Bula						', '0.00', '3,', 5),
(17, 'Cloridrato de betaina', 'Ajuda na sua digestão', '9.00', 'Leia a Bula						', '1.00', '3,', 5),
(18, 'Allegra', 'Allegra: o Aliado no Controle da Alergia, Urticária e Rinite Alérgica', '23.00', 'Leia a Bula						', '0.00', '3,', 5),
(19, 'Resfenol', 'Gripes e Resfriados', '12.00', 'Leia a Bula						', '1.00', '3,', 5),
(20, 'Kit calça Jogger', 'Kit C/10 Calça Jogger Roupas Femininas Modinha Atacado', '350.00', 'Bolsa, tênis e calça 						', '0.00', '4,', 6),
(21, 'Camisa Jeans', 'Camisa Jeans Masculina ', '89.00', 'Shirt Blue light Jeans Jacket Mens Casual Sports Stylish Long Sleeve\r\n						', '12.00', '4,', 6),
(22, 'Jaqueta Nike', 'Jaqueta Nike Windrunner', '179.00', 'Jaqueta Nike Windrunner\r\nMarca: NIKE						', '0.00', '4,', 6),
(23, 'Brinquedo Arranhador', 'Brinquedo Arranhador Gatos Arco Massageador Com Catnip\r\n', '46.00', 'Brinquedo Arranhador Gatos Arco Massageador Com Catnip', '1.00', '6,', 2),
(24, 'Arranhador', 'Arranhador para Gato Castelinho', '793.00', 'Casa de dois andares com escada para seu gato se manter ativo!						', '0.00', '6,', 2),
(25, 'Buffet Classic', 'Buffet Classic Off White com Freijó', '524.00', ' O Buffet Classic - Imcal Móveis possui design requintado, que mistura sofisticação e modernidade, p', '12.00', '7,', 7),
(26, ' Conjunto Sala de Jantar', 'Conjunto Sala de Jantar Mesa Tampo MDF 4 Cadeiras Espanha', '661.00', 'Se você pretende completar a sua casa com bom gosto e charme, então veja que mimo este lindo Conjunt', '0.00', '7,', 7),
(27, 'Rack para TV', 'Rack para TV Até 55 Polegadas 2 Gavetas Uno Dover ', '212.00', 'Compre Rack para TV Até 55 Polegadas 2 Gavetas Uno Dover - Entrega 100% Garantida. Confira agora!			', '17.00', '7,', 7),
(28, 'Cama casal', 'Cama Casal Madri ', '379.00', 'Cama Casal Madri Espresso Móveis Canion Hfw						', '0.00', '7,', 7),
(29, 'Cafeteira ', 'Cafeteira Elétrica', '199.00', 'Cafeteira Elétrica Lenoxx PCA 031 Preta ou Vermelha\r\n						', '12.00', '8,', 8),
(30, 'Smart Tv', 'Smart TV HD LED 32” Samsung J4290 - Wi-Fi 2 HDMI 1 USB', '1299.00', 'A Smart TV LED HD J4290 da Samsung tem 32\", conversor digital, sistema operacional Tízen, Wi-Fi, 2 e', '16.00', '8,', 8),
(31, 'Refrigerador / Geladeira', 'Refrigerador | Geladeira Brastemp Frost Free 2 Portas 375 Litros Inox - BRM44HK', '2499.00', 'A Geladeira Brastemp Frost Free Duplex BRM44 375 litros conta com design sofisticado e grande capaci', '0.00', '8,', 8),
(32, 'Computador', 'Computador Easypc Standard', '3499.00', 'Computador Easypc Standard+ Intel Core I7 3.8Ghz 4Gb Hd 500Gb Monitor 19.5 Windows 10 + Pacote Offic', '150.00', '8,', 8);
