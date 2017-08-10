-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 01-Out-2014 às 13:16
-- Versão do servidor: 5.6.11
-- versão do PHP: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `doce_feitico`
--
CREATE DATABASE IF NOT EXISTS `doce_feitico` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `doce_feitico`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acai`
--

CREATE TABLE IF NOT EXISTS `acai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `valor` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `acai`
--

INSERT INTO `acai` (`id`, `id_produto`, `valor`) VALUES
(1, 1, 'R$ 3,50'),
(2, 2, 'R$ 4,50'),
(3, 3, 'R$ 6,50'),
(4, 4, 'R$ 8,00'),
(5, 5, 'R$ 18,00'),
(6, 6, 'R$ 35,00'),
(7, 7, 'R$ 10,00'),
(8, 8, 'R$ 12,50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `name`) VALUES
(1, '200ml'),
(2, '300ml '),
(3, '500ml'),
(4, '770ml'),
(5, '1 Litro'),
(6, '2 Litros'),
(7, 'Tigela Média'),
(8, 'Tigela Grande');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salada_de_frutas`
--

CREATE TABLE IF NOT EXISTS `salada_de_frutas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `valor` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `salada_de_frutas`
--

INSERT INTO `salada_de_frutas` (`id`, `id_produto`, `valor`) VALUES
(1, 1, 'R$ 5,50'),
(2, 2, 'R$ 7,50'),
(3, 3, 'R$ 12,50'),
(4, 4, 'R$ 14,50'),
(5, 5, 'R$ 25,00'),
(6, 6, 'R$ 48,00'),
(7, 7, 'R$ 13,00'),
(8, 8, 'R$ 15,50');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acai`
--
ALTER TABLE `acai`
  ADD CONSTRAINT `acai_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `salada_de_frutas`
--
ALTER TABLE `salada_de_frutas`
  ADD CONSTRAINT `salada_de_frutas_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
