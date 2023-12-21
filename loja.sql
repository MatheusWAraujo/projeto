-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/12/2023 às 10:09
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `Id` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Paga` tinyint(1) NOT NULL,
  `Entregue` tinyint(1) NOT NULL,
  `id-user` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itemcompras`
--

CREATE TABLE `itemcompras` (
  `Quantidade` int(100) NOT NULL,
  `IdProduto` int(100) NOT NULL,
  `IdCompra` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `Id` int(100) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Cidade` varchar(100) NOT NULL,
  `Bairro` varchar(100) NOT NULL,
  `Logradouro` varchar(100) NOT NULL,
  `Numero` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`Id`, `Nome`, `Estado`, `Cidade`, `Bairro`, `Logradouro`, `Numero`) VALUES
(0, 'ROOT', 'ROOT', 'ROOT', 'ROOT', 'ROOT', 'ROOT'),
(1, 'Vitor', 'Bahia', 'Rio de Janeiro', 'Mutum', 'De baixo', '43'),
(2, 'ca', 'ca', 'ca', 'ca', 'ca', '12'),
(3, 'c', 'c', 'c', 'c', 'c', '12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Preco` varchar(10000) NOT NULL,
  `Imagem` varchar(100) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `Estrelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`Id`, `Nome`, `Preco`, `Imagem`, `Categoria`, `Estrelas`) VALUES
(1, 'Lanterna Tática SD 2.500', 'R$ 59,00', '../UPLOADS/Lanternas/1.png', 'Lanternas', 4),
(2, 'Lanterna de Mão ultrapix', 'R$ 30,00', '../UPLOADS/Lanternas/2.png', 'Lanternas', 2),
(3, 'Barraca Camping Montana', 'R$ 349,99', '../UPLOADS/Barracas/3.png', 'Barracas', 3),
(4, 'Cordas LI p6', 'R$ 25,99', '../UPLOADS/Cordas/6.png', 'Cordas', 5),
(6, 'Cantil Verde 250ml', 'R$ 15,99', '../UPLOADS/Cantil/8.png', 'Cantil', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `Papel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`Id`, `Email`, `Senha`, `Papel`) VALUES
(0, 'root', 'root', 'ADM'),
(1, 'vitin@gmail.com', 'abcdefg', 'USER'),
(2, '1234', '123456', 'USER'),
(3, 'laz', '123456', 'USER');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`Id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD KEY `fk_pessoa_usuario` (`Id`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_pessoa_usuario` FOREIGN KEY (`Id`) REFERENCES `pessoa` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
