-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Maio-2024 às 00:53
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `modulo2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `ID` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Hora` time NOT NULL,
  `Cliente` varchar(50) NOT NULL DEFAULT 'N/A',
  `Telefone` varchar(20) NOT NULL DEFAULT 'N/A',
  `Status` varchar(10) NOT NULL DEFAULT 'N/A',
  `DT_Cadastro` datetime DEFAULT current_timestamp(),
  `DT_Agendamento` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`ID`, `Data`, `Hora`, `Cliente`, `Telefone`, `Status`, `DT_Cadastro`, `DT_Agendamento`) VALUES
(1, '2002-11-28', '10:00:00', 'Jamis', '81995660112', 'Finalizado', '2024-05-02 20:15:49', '2024-05-03 20:49:13'),
(2, '2024-03-25', '23:11:00', 'João Almeida', '81997847788', 'Pendente', '2024-05-02 20:17:07', NULL),
(3, '2021-08-24', '11:17:00', 'Aruan Felix', '81995774422', 'Finalizado', '2024-05-02 20:18:06', NULL),
(4, '2024-10-25', '11:27:00', 'Maria', '81995660113', 'Pendente', '2024-05-06 21:25:49', NULL),
(5, '2024-10-25', '11:27:00', 'Maria', '81995660113', 'Pendente', '2024-05-06 21:25:53', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(80) NOT NULL DEFAULT 'N/A',
  `CPF` varchar(14) NOT NULL,
  `Celular` varchar(16) NOT NULL,
  `Salario` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`ID`, `Nome`, `CPF`, `Celular`, `Salario`) VALUES
(1, 'Jamis', '148.722.854-16', '81995660111', '4500.00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
