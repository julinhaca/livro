-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/07/2025 às 19:16
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `livro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `ano_publicacao` int(11) DEFAULT NULL,
  `status` enum('Disponível','Emprestado') NOT NULL DEFAULT 'Disponível',
  `data_cadastrada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `autor`, `genero`, `ano_publicacao`, `status`, `data_cadastrada`) VALUES
(2, 'Dom Casmurro', 'Machado de Assis', 'Romance', 1877, 'Emprestado', '2025-07-16 13:17:19'),
(3, '1984', 'George Orwell', 'Distopia', 1949, 'Emprestado', '2025-07-16 13:17:19'),
(4, 'Harry Potter e a Pedra Filosofal', 'J.K. Rowling', 'Fantasia', 1977, 'Disponível', '2025-07-16 13:17:19'),
(5, 'A Arte da Guerra', 'Sun Tzu', 'Estratégia', -500, 'Emprestado', '2025-07-16 13:17:19'),
(8, 'o livro selvagem', 'alexandre', 'Ficcção', 1985, 'Disponível', '2025-07-23 12:10:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_funcionarios`
--

CREATE TABLE `usuarios_funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuarios` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `sepf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios_funcionarios`
--

INSERT INTO `usuarios_funcionarios` (`id`, `nome`, `usuarios`, `senha`, `sepf`) VALUES
(3, 'marcos', 'marcos silva', '$2y$10$nvHfPGgdZTZ2JMe5IuprkuvDSVOiM6wBsf4tuKWXaTdMQTSfFYJWK', '$2y$10$YFAToo0ylBmHMcqPL18WX.SEPvnwu1jf63U.i1cQPyPXishF0KSci');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_leitores`
--

CREATE TABLE `usuarios_leitores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios_leitores`
--

INSERT INTO `usuarios_leitores` (`id`, `nome`, `usuario`, `senha`) VALUES
(1, 'julia', 'julia@biblioteca.com', '$2y$10$BkRelPzuKKbPsyI9sxR78eVFXuERsROdlsy/KNX6mJcjWL2YHU5Ay'),
(2, 'pedroca', 'pedro@gmail.com', '$2y$10$NgE7/m3unediNMItJkK2GOqSkrYtp3Lq3O/oFTIPB15FiDF92qeo6');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios_funcionarios`
--
ALTER TABLE `usuarios_funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuarios`);

--
-- Índices de tabela `usuarios_leitores`
--
ALTER TABLE `usuarios_leitores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios_funcionarios`
--
ALTER TABLE `usuarios_funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios_leitores`
--
ALTER TABLE `usuarios_leitores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
