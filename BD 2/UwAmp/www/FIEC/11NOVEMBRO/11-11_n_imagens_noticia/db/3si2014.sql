-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 16/09/2014 às 19:11
-- Versão do servidor: 5.6.11-log
-- Versão do PHP: 5.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `3si2014`
--
CREATE DATABASE IF NOT EXISTS `3si2014` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `3si2014`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `login`
--

INSERT INTO `login` (`id`, `email`, `senha`) VALUES
(1, 'marcio.ferraz@etec.sp.gov.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(2, 'marcio.ferraz@etec.sp.gov.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'teste@teste.com', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f'),
(4, 'fiec@fiec.com', 'cbf111479ff6b48f792936ac71acf3c283372e12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `pais_origem` varchar(70) DEFAULT NULL,
  `ano_fundacao` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Fazendo dump de dados para tabela `marca`
--

INSERT INTO `marca` (`id`, `nome`, `pais_origem`, `ano_fundacao`) VALUES
(1, 'honda', 'JapÃ£o', 1850),
(2, 'YAMAHA', 'JapÃ£o', 1910),
(3, 'DAFRA', 'Brasil', 2001),
(4, 'FYM', 'JapÃ£o', 2005),
(5, 'SUNDOWN', 'Brasil', 1980),
(6, 'TESTE01', 'Brasil', 1802);

-- --------------------------------------------------------

--
-- Estrutura para tabela `moto`
--

CREATE TABLE IF NOT EXISTS `moto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `valor` double DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_marca` (`id_marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Fazendo dump de dados para tabela `moto`
--

INSERT INTO `moto` (`id`, `nome`, `valor`, `foto`, `estoque`, `id_marca`) VALUES
(1, 'CG', 7900, 'contato.png', 3, 1),
(2, 'YBR', 5900, 'erro.png', 3, 2),
(3, 'TDM', 4500, 'globo.png', 1, 2),
(4, 'twister', 10000, 'console.png', 3, 1),
(5, 'bros', 8000, 'contato.png', 2, 1),
(6, 'Teste000111', 5600, 'disquete.png', 50, 6),
(7, 'Caveira', 45000, 'moto.jpg', 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
