-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 03/04/2020 às 03:11
-- Versão do servidor: 5.7.29-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pontoprojecta`
--
CREATE DATABASE IF NOT EXISTS `pontoprojecta` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pontoprojecta`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `members`
--

CREATE TABLE `members` (
  `id_member` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `members`
--

INSERT INTO `members` (`id_member`, `name`) VALUES
(5, 'teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `point`
--

CREATE TABLE `point` (
  `id_point` int(10) UNSIGNED NOT NULL,
  `begin_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `begin_datetime` varchar(50) DEFAULT NULL,
  `end_datetime` varchar(50) DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  `fk_members` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Índices de tabela `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`id_point`),
  ADD KEY `fk_point_members1_idx` (`fk_members`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de tabela `point`
--
ALTER TABLE `point`
  MODIFY `id_point` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `point`
--
ALTER TABLE `point`
  ADD CONSTRAINT `fk_point_members1` FOREIGN KEY (`fk_members`) REFERENCES `members` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
