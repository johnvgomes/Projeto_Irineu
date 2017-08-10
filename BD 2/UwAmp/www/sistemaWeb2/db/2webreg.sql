-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 08-Abr-2015 às 07:58
-- Versão do servidor: 5.6.11-log
-- versão do PHP: 5.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `2webreg`
--
CREATE DATABASE IF NOT EXISTS `2webreg` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `2webreg`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `email`, `telefone`) VALUES
(1, 'marcio', 'marcio@marcio.com', '(11) 1212-1452');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL,
  `plano_curso` varchar(100) DEFAULT NULL,
  `id_eixo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_eixo` (`id_eixo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`, `tipo`, `grade`, `plano_curso`, `id_eixo`) VALUES
(1, 'InformÃ¡tica', 'Ensino TÃ©cnico', NULL, NULL, 3),
(2, 'InformÃ¡tica', 'Ensino TÃ©cnico', NULL, NULL, 3),
(3, 'InformÃ¡tica', 'Ensino TÃ©cnico', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eixo`
--

CREATE TABLE IF NOT EXISTS `eixo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `eixo`
--

INSERT INTO `eixo` (`id`, `nome`) VALUES
(3, 'InformaÃ§Ã£o e ComunicaÃ§Ã£o'),
(4, 'Design e ProduÃ§Ã£o Cultural'),
(5, 'Turismo, Hospitalidade e Lazer'),
(11, 'GestÃ£o e NegÃ³cios');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_noticia`
--

CREATE TABLE IF NOT EXISTS `imagem_noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_noticia` (`id_noticia`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `email`, `senha`) VALUES
(4, 'admin@admin.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(5, 'teste@teste.com', '2e6f9b0d5885b6010f9167787445617f553a735f'),
(6, '123@123.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_eixo` int(11) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `conteudo` text,
  `url` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_eixo` (`id_eixo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
