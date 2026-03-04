-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/03/2026 às 19:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mkengenharia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `cidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cidades`
--

INSERT INTO `cidades` (`id`, `cidade`) VALUES
(1, 'araçatuba'),
(2, 'Andradina'),
(3, 'Avanhandava'),
(4, 'Curitiba'),
(5, 'Três Lagoas'),
(6, 'Diversas'),
(7, 'teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `cpf_cnpj` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo_cliente` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`cpf_cnpj`, `nome`, `tipo_cliente`) VALUES
('07571710871', 'Lenilde Merlo Ravagnani', 'pf'),
('10337204000', 'Rumo Certo/Lacal', 'pj'),
('11111111111111', 'Lacal e Vasco', 'pj'),
('14798865000150', 'Edifica empreendimentos/Cardassi', 'pj'),
('26517583000116', 'Emma Holding', 'pj');

-- --------------------------------------------------------

--
-- Estrutura para tabela `gastosobras`
--

CREATE TABLE `gastosobras` (
  `id` int(11) NOT NULL,
  `id_obra` int(11) NOT NULL,
  `valor_gasto` decimal(10,2) NOT NULL,
  `data_gasto` date NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `gastosobras`
--

INSERT INTO `gastosobras` (`id`, `id_obra`, `valor_gasto`, `data_gasto`, `descricao`) VALUES
(16, 5, 104.57, '2026-02-05', 'Fatura SAMAR'),
(17, 5, 166.77, '2026-02-05', 'Fatura SAMAR'),
(18, 5, 2000.00, '2026-02-05', '2º pgto Evandro eletricista'),
(19, 5, 10605.00, '2026-02-10', 'Cavazzana portão 4º galpão'),
(20, 5, 1300.00, '2026-02-11', 'Cão guarda'),
(21, 5, 495.00, '2026-02-11', 'Atacado do revestimento - 15 sacos de gesso'),
(22, 5, 8000.00, '2026-02-13', 'Oitava medição Vilson'),
(23, 5, 1800.00, '2026-02-13', 'Terraplanagem Caiçara'),
(24, 5, 5298.00, '2026-02-18', 'Construforte'),
(25, 10, 5930.00, '2026-02-03', 'Fechamento Alameda Tintas'),
(26, 10, 84.76, '2026-02-04', 'CPFL G03 '),
(27, 10, 84.76, '2026-02-04', 'CPFL G04'),
(28, 10, 1258.50, '2026-02-04', 'Fechamento Estoril'),
(29, 10, 2280.00, '2026-02-04', 'Construart'),
(30, 10, 98.96, '2026-02-05', 'Fatura SAMAR'),
(31, 10, 98.25, '2026-02-05', 'Fatura SAMAR'),
(32, 10, 6400.00, '2026-02-11', 'Terceira parcela Bracale Forro  Tabicado'),
(33, 10, 1700.00, '2026-02-11', 'Quarta parcela final bracale forro tabicado'),
(34, 10, 400.00, '2026-02-12', 'Cris Caçamba'),
(35, 10, 4800.00, '2026-02-13', 'Petit Pavet'),
(36, 10, 3800.00, '2026-02-13', 'Vigésima segunda medição Rodrigo Aparecido'),
(37, 10, 4224.00, '2026-02-13', 'Aguinaldo Rosa'),
(38, 10, 500.00, '2026-02-13', 'Vitor Hugo pintor'),
(39, 10, 2517.00, '2026-02-16', 'Buzo e Lima'),
(41, 4, 10000.00, '2026-02-04', '6a medição seu João'),
(42, 4, 2550.00, '2026-02-04', 'Limpeza pós-obra dona Regina'),
(43, 4, 15225.00, '2026-02-05', 'Terraplanagem'),
(44, 4, 11925.00, '2026-02-09', 'Ishida Jardinagem'),
(45, 4, 230.50, '2026-02-12', 'Rizzo sacos de cimento e fita zebrada'),
(46, 4, 381.40, '2026-02-13', 'Serviço Munck'),
(47, 4, 325.00, '2026-02-16', 'Buzo e Lima'),
(48, 4, 10000.00, '2026-02-19', '7a medição seu João'),
(49, 4, 3600.00, '2026-02-19', 'Concresp concretagem'),
(50, 4, 1746.00, '2026-02-19', 'Concresp concregatem'),
(51, 4, 3690.00, '2026-02-20', 'Alameda tintas'),
(52, 4, 209.00, '2026-02-20', 'Rizzo - torneiras de jardim'),
(53, 10, 639.00, '2026-02-19', '22a medição Rodrigo Azulejista'),
(54, 10, 8000.00, '2026-02-19', '1º pagto marmoraria universo'),
(55, 10, 500.00, '2026-02-20', '5º pgto pintor'),
(56, 10, 2327.50, '2026-02-20', 'Ranchos Grill'),
(57, 6, 2980.00, '2026-02-10', 'Petit Pavet'),
(58, 6, 400.00, '2026-02-12', 'Porte de areia três irmãos'),
(59, 6, 468.00, '2026-02-12', 'Cimaferro - 12 sacos de cimento'),
(60, 6, 127.00, '2026-02-16', 'Fechamento estoque materiais de construção'),
(61, 8, 123.80, '2026-02-05', 'Materiais Araçapar'),
(62, 8, 8000.00, '2026-02-06', '3a medição Hélio'),
(63, 8, 680.00, '2026-02-09', 'Estoril cimentos'),
(64, 8, 1900.00, '2026-02-11', 'Madeireira Araçatuba'),
(65, 8, 970.00, '2026-02-12', 'Estoril cimentos'),
(66, 8, 3009.32, '2026-02-20', 'Gerdau - 80 barras de 10mm'),
(67, 8, 4000.00, '2026-02-20', '4a medição Hélio'),
(68, 8, 548.00, '2026-02-20', 'Higor correia hidraulica'),
(69, 8, 628.82, '2026-02-23', 'Comercial Gerdau'),
(70, 9, 1040.00, '2026-02-03', 'Fechamento de janeiro valmir camçambas'),
(71, 9, 1000.00, '2026-02-10', '3º pgto Evandro eletricista'),
(72, 9, 8000.00, '2026-02-12', '24a medição João Carlos Queiroz'),
(73, 9, 2000.00, '2026-02-13', '1º pgto Jerson pintor'),
(74, 9, 780.00, '2026-02-13', 'Calhar e Rufos divisa vizinho'),
(75, 9, 710.47, '2026-02-16', 'Fechamento estoque materiais'),
(76, 9, 3000.00, '2026-02-19', '2º pgto Jerson pintor'),
(77, 9, 1209.92, '2026-02-23', 'Portobello shop'),
(78, 5, 3000.00, '2026-02-20', '1º pgto pintor Evandro'),
(79, 5, 9000.00, '2026-02-20', '5a medição Vilson'),
(80, 9, 3800.00, '2026-02-05', 'Banheiro químico'),
(81, 7, 91.81, '2026-02-05', 'Neoenergia'),
(82, 7, 91.85, '2026-02-05', 'Neoenergia'),
(83, 7, 780.00, '2026-02-06', 'Serviço de reparo em 2 salas (vedação, telhas, etc)'),
(84, 7, 780.00, '2026-02-09', 'Disk caçamba'),
(85, 7, 1000.00, '2026-02-09', 'Vigilante'),
(86, 7, 500.00, '2026-02-10', 'Serviço de reparo em 2 salas '),
(87, 7, 2070.00, '2026-02-11', 'Porto de areia 3 irmãos'),
(88, 7, 20000.00, '2026-02-13', '20a medição Messias'),
(89, 7, 759.00, '2026-02-16', 'Estoque materiais de construção'),
(90, 7, 2240.00, '2026-02-18', 'Depósito Kombina'),
(91, 7, 4500.00, '2026-02-20', '21a medição Messias'),
(92, 7, 1170.00, '2026-02-20', 'Cimaferro'),
(93, 7, 702.00, '2026-02-20', 'Cimaferro'),
(94, 7, 468.00, '2026-02-20', 'Cimaferro'),
(95, 7, 1500.00, '2026-02-23', 'Aluguel'),
(96, 11, 680.00, '2026-02-04', 'SR Três Lagoas - calhas e rufos'),
(97, 11, 130.00, '2026-02-05', 'Fechamento Avante Locação'),
(98, 11, 1469.09, '2026-02-10', 'Taxa alvará habite-se'),
(99, 11, 7404.07, '2026-02-10', 'Taxa alvará habite-se'),
(100, 11, 452.00, '2026-02-11', 'Danizete de fátima ribeiro'),
(101, 10, 4200.00, '2026-02-23', 'Casa das molduras');

-- --------------------------------------------------------

--
-- Estrutura para tabela `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf_cnpj_cliente` varchar(20) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numObra` char(10) NOT NULL,
  `porcentagem_cobranca` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `obras`
--

INSERT INTO `obras` (`id`, `nome`, `cpf_cnpj_cliente`, `id_cidade`, `rua`, `numObra`, `porcentagem_cobranca`) VALUES
(4, 'Cemitério Andradina', '14798865000150', 2, 'Sebastião Arantes', '1251', '10'),
(5, 'Barracões São Bernardo', '10337204000', 1, 'São Bernardo', 'Diversos', '9.5'),
(6, 'Capela/Sala VIP', '14798865000150', 5, 'Quixeramobim', '1584', '10'),
(7, 'Barracões Três Lagoas', '11111111111111', 5, 'Av Ranulpho Marques Leal', '3478', '10'),
(8, 'Casa Royal Boulevard', '07571710871', 1, 'Maria Gerardi Ferreira', 'lote 09', '10'),
(9, 'Funerária Três Lagoas', '14798865000150', 5, 'Advogado Rosário Congro', '1149', '10'),
(10, 'Casas G03 e G04 VM', '26517583000116', 1, 'Ipê Rosa', '236, 246', '10'),
(11, 'Reformas Cardassi', '14798865000150', 6, 'Diversas', 'Diversos', '10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cpf` varchar(15) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`cpf`, `nome`, `senha`) VALUES
('11111111111', 'Matheus', '$2y$10$6xm8kF139Y4yeeCBHJvmwe6GZvGDZZv.wXC2kvteT/2Rmw5dii/2C');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cpf_cnpj`);

--
-- Índices de tabela `gastosobras`
--
ALTER TABLE `gastosobras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_obra` (`id_obra`);

--
-- Índices de tabela `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `gastosobras`
--
ALTER TABLE `gastosobras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `gastosobras`
--
ALTER TABLE `gastosobras`
  ADD CONSTRAINT `gastosobras_ibfk_1` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
