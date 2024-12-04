-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/12/2024 às 00:16
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
-- Banco de dados: `cidades_estados`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id_cidade` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `populacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sigla` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estados`
--

INSERT INTO `estados` (`id_estado`, `nome`, `sigla`) VALUES
(11, 'Rondônia', 'RO'),
(12, 'Acre', 'AC'),
(13, 'Amazonas', 'AM'),
(14, 'Roraima', 'RR'),
(15, 'Pará', 'PA'),
(16, 'Amapá', 'AP'),
(17, 'Tocantins', 'TO'),
(21, 'Maranhão', 'MA'),
(22, 'Piauí', 'PI'),
(23, 'Ceará', 'CE'),
(24, 'Rio Grande do Norte', 'RN'),
(25, 'Paraíba', 'PB'),
(26, 'Pernambuco', 'PE'),
(27, 'Alagoas', 'AL'),
(28, 'Sergipe', 'SE'),
(29, 'Bahia', 'BA'),
(31, 'Minas Gerais', 'MG'),
(32, 'Espírito Santo', 'ES'),
(33, 'Rio de Janeiro', 'RJ'),
(35, 'São Paulo', 'SP'),
(41, 'Paraná', 'PR'),
(43, 'Rio Grande do Sul', 'RS'),
(50, 'Mato Grosso do Sul', 'MS'),
(51, 'Mato Grosso', 'MT'),
(52, 'Goiás', 'GO'),
(53, 'Distrito Federal', 'DF');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE `log` (
  `idlog` int(11) NOT NULL,
  `datahora` timestamp NOT NULL DEFAULT current_timestamp(),
  `numeroregistros` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `log`
--

INSERT INTO `log` (`idlog`, `datahora`, `numeroregistros`) VALUES
(1, '2024-12-04 22:45:35', 27),
(2, '2024-12-04 23:05:34', 27),
(3, '2024-12-04 23:11:58', 27);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id_cidade`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Índices de tabela `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`),
  ADD UNIQUE KEY `sigla` (`sigla`);

--
-- Índices de tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idlog`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `cidades_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
