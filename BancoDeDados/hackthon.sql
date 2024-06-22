-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22/06/2024 às 20:10
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
-- Banco de dados: `hackthon`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `idAgente` int(11) NOT NULL,
  `idIdoso` int(11) NOT NULL,
  `dataVisita` date NOT NULL,
  `horaVisita` time NOT NULL,
  `info` varchar(200) NOT NULL,
  `IdVacina` int(11) NOT NULL,
  `DataAplicacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agenda`
--

INSERT INTO `agenda` (`id`, `idAgente`, `idIdoso`, `dataVisita`, `horaVisita`, `info`, `IdVacina`, `DataAplicacao`) VALUES
(1, 2, 2, '2024-06-26', '10:31:00', 'testa', 3, NULL),
(7, 2, 2, '2024-06-25', '10:30:00', '', 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `agente`
--

CREATE TABLE `agente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agente`
--

INSERT INTO `agente` (`ID`, `nome`) VALUES
(1, 'Joana Darci de Moreira'),
(2, 'Antonio Bernardes ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cuidador`
--

CREATE TABLE `cuidador` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idIdoso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cuidador`
--

INSERT INTO `cuidador` (`id`, `nome`, `idIdoso`) VALUES
(1, 'Marcos', 2),
(2, 'Rosa', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `idoso`
--

CREATE TABLE `idoso` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `historicoMedico` varchar(300) NOT NULL,
  `DataNascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `idoso`
--

INSERT INTO `idoso` (`id`, `nome`, `cpf`, `telefone`, `endereco`, `historicoMedico`, `DataNascimento`) VALUES
(1, 'Andre Luiz Villar', '09463842900', '44123456789', 'Chacará Alto Alegre, Zona rural', 'Retirada do apêndice 2003. Alergico a Morfina. Cirurgia no joelho devido desgaste da cartilagem', '1951-08-27'),
(2, 'Janete Maria De Jesus', '89204694904', '44638499163', 'Rua Java, Vila Rural II', 'Osteoporose, Artrite, Hernia de Disco.', '1937-04-18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vacina`
--

CREATE TABLE `vacina` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dataInicioCampanha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vacina`
--

INSERT INTO `vacina` (`id`, `nome`, `dataInicioCampanha`) VALUES
(2, 'Influenza', '2024-03-18'),
(3, 'Hepatite B', '2024-01-01'),
(4, 'Dupla adulto (difteria e tétano) – dT', '2024-01-01');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idMedico` (`idAgente`),
  ADD KEY `fk_idIdoso` (`idIdoso`),
  ADD KEY `fk_idVacina` (`IdVacina`);

--
-- Índices de tabela `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `cuidador`
--
ALTER TABLE `cuidador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `idoso`
--
ALTER TABLE `idoso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vacina`
--
ALTER TABLE `vacina`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `agente`
--
ALTER TABLE `agente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cuidador`
--
ALTER TABLE `cuidador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `idoso`
--
ALTER TABLE `idoso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vacina`
--
ALTER TABLE `vacina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `fk_idIdoso` FOREIGN KEY (`idIdoso`) REFERENCES `idoso` (`id`),
  ADD CONSTRAINT `fk_idMedico` FOREIGN KEY (`idAgente`) REFERENCES `agente` (`ID`),
  ADD CONSTRAINT `fk_idVacina` FOREIGN KEY (`IdVacina`) REFERENCES `vacina` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
