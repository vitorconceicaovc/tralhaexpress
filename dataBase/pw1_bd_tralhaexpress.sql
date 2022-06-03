-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Maio-2022 às 20:56
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pw1_bd_tralhaexpress`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id_agenda` int(11) NOT NULL,
  `data_agenda` datetime NOT NULL,
  `morada_agenda` varchar(50) NOT NULL,
  `tipo_agenda` varchar(100) NOT NULL,
  `obs_agenda` varchar(100) NOT NULL,
  `estado_agenda` varchar(30) NOT NULL DEFAULT 'Agendado',
  `id_cliente` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL DEFAULT 1,
  `id_gerente` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id_agenda`, `data_agenda`, `morada_agenda`, `tipo_agenda`, `obs_agenda`, `estado_agenda`, `id_cliente`, `id_funcionario`, `id_gerente`) VALUES
(7, '2022-05-26 20:02:00', 'rua do contumil 724, b1 C22', 'Remodelação', 'Embalagens frágeis!', 'Agendado', 5, 1, 1),
(8, '2022-05-27 14:50:00', 'rua depois da escola', 'Transportes', 'Apenas quarto e cozinha', 'Concluido', 5, 1, 1),
(9, '2022-05-30 21:05:00', 'Palmeirim Verdim', 'Remodelação', 'Quarto, Casa de banho ', 'Em serviço', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(30) NOT NULL,
  `email_cliente` varchar(30) NOT NULL,
  `contacto_cliente` varchar(9) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` varchar(10) NOT NULL DEFAULT 'user',
  `foto_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome_cliente`, `email_cliente`, `contacto_cliente`, `senha`, `tipo`, `foto_cliente`) VALUES
(1, 'Manel da Silva', 'manel@tralha.com', '918274123', 'e10adc3949ba59abbe56e057f20f883e', 'user', ''),
(2, 'Mário Costa', 'mario@costa.com', '912837111', 'e10adc3949ba59abbe56e057f20f883e', 'user', ''),
(3, 'Mário Costa', 'mario@costa.com', '912837111', 'e10adc3949ba59abbe56e057f20f883e', 'user', ''),
(4, 'Joaquina Pinto', 'joaquina@pinto.com', '918274612', 'e10adc3949ba59abbe56e057f20f883e', 'user', ''),
(5, 'Vitor Conceição', 'vitor@conceicao.com', '912837222', 'e10adc3949ba59abbe56e057f20f883e', 'user', ''),
(6, 'teste', 'teste@teste.com', '123456789', 'e10adc3949ba59abbe56e057f20f883e', 'user', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `nome_funcionario` varchar(40) NOT NULL,
  `email_funcionario` varchar(30) NOT NULL,
  `contacto_funcionario` varchar(9) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` varchar(30) DEFAULT 'func',
  `foto_funcionario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `nome_funcionario`, `email_funcionario`, `contacto_funcionario`, `senha`, `tipo`, `foto_funcionario`) VALUES
(1, 'Albertino da Silva', 'albertino@gmail.com', '918274111', 'e10adc3949ba59abbe56e057f20f883e', 'func', ''),
(2, 'António Silva', 'antonio@gmail.com', '918274222', 'e10adc3949ba59abbe56e057f20f883e', 'func', ''),
(3, 'Marcella Cunha', 'marcella@gmail.com', '923182746', 'e10adc3949ba59abbe56e057f20f883e', 'func', ''),
(4, 'Rui Costa', 'rui@gmail.com', '918274615', 'e10adc3949ba59abbe56e057f20f883e', 'func', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerentes`
--

CREATE TABLE `gerentes` (
  `id_gerente` int(11) NOT NULL,
  `nome_gerente` varchar(40) NOT NULL,
  `email_gerente` varchar(30) NOT NULL,
  `contacto_gerente` varchar(9) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` varchar(10) NOT NULL DEFAULT 'admin',
  `foto_gerente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `gerentes`
--

INSERT INTO `gerentes` (`id_gerente`, `nome_gerente`, `email_gerente`, `contacto_gerente`, `senha`, `tipo`, `foto_gerente`) VALUES
(1, 'Senhor Conceição', 'senhor@conceicao.com', '918274111', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_gerente` (`id_gerente`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices para tabela `gerentes`
--
ALTER TABLE `gerentes`
  ADD PRIMARY KEY (`id_gerente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `gerentes`
--
ALTER TABLE `gerentes`
  MODIFY `id_gerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`),
  ADD CONSTRAINT `agendamentos_ibfk_3` FOREIGN KEY (`id_gerente`) REFERENCES `gerentes` (`id_gerente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
