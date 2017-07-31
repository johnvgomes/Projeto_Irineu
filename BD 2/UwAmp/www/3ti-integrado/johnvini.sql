-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 19-Nov-2015 às 08:48
-- Versão do servidor: 5.6.11-log
-- versão do PHP: 5.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `johnvini`
--
CREATE DATABASE IF NOT EXISTS `johnvini` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `johnvini`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `nrfuncionarios` int(11) DEFAULT NULL,
  `planta` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`id`, `nome`, `nrfuncionarios`, `planta`) VALUES
(17, 'RH', 12, 'fifa-12-manuals_Sony Playstation 3.pdf'),
(18, 'PRODUÃ‡ÃƒO', 24, 'fifa-12-manuals_Sony Playstation 3.pdf'),
(23, 'ADMINISTRAÃ‡ÃƒO', 3, 'competencias, habilidades e bases tecnologicas PCI.docx'),
(24, 'CPD', 10, '2015-04-07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE IF NOT EXISTS `fabricante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `datafundacao` varchar(10) DEFAULT NULL,
  `logomarca` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `fabricante`
--

INSERT INTO `fabricante` (`id`, `nome`, `endereco`, `datafundacao`, `logomarca`) VALUES
(2, 'TEREZINA', 'Rua tereza PiauÃ­', '29/05/1814', 'Hydrangeas.jpg'),
(3, 'TEREZINA', 'Rua tereza PiauÃ­', '29/05/1814', 'Hydrangeas.jpg'),
(4, 'CHICO FRANCISCO', 'Rua jacaranda ', '21/20/2014', 'Lighthouse.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `id_depto` int(11) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_depto` (`id_depto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `salario`, `id_depto`, `url`) VALUES
(9, 'Jose Luis', 8000, 18, 'jose-luis'),
(10, 'CampeÃ£o', 8000, 18, 'campeao'),
(11, '24', 0, 4500, 'aula-de-php'),
(12, 'Aula de PHP', 4550, 24, 'aula-de-php'),
(13, 'Joaquim', 2300, 23, 'joaquim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_funcionario`
--

CREATE TABLE IF NOT EXISTS `imagem_funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_funcionario` (`id_funcionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `imagem_funcionario`
--

INSERT INTO `imagem_funcionario` (`id`, `nome`, `id_funcionario`) VALUES
(21, '20151029090658987a9b2c872ca170f543814f68db96e760298f95.jpg', 12),
(20, '20151029090658da405a634b6e23353a86a1acdff0a847b16770ca.jpg', 12),
(19, '20151029090543987a9b2c872ca170f543814f68db96e760298f95.jpg', 11),
(18, '2015102909054380d172edd16c3e72166685de9b3f3a4a671aea4c.jpg', 11),
(17, '20151029090543d09246081d7ce8259ddb9bfebdb4017eae033707.jpg', 11),
(9, '20150910073919241c359c09f22c1cfbfb298fbafadc1abeec6a90.jpg', 9),
(10, '20150910073920d09246081d7ce8259ddb9bfebdb4017eae033707.jpg', 9),
(11, '201509100739209de279788ec0cef219c72bb583f449ccba289c40.jpg', 9),
(12, '2015091007392080d172edd16c3e72166685de9b3f3a4a671aea4c.jpg', 9),
(13, '20150924080424241c359c09f22c1cfbfb298fbafadc1abeec6a90.jpg', 10),
(14, '20150924080424d09246081d7ce8259ddb9bfebdb4017eae033707.jpg', 10),
(15, '201509240804249de279788ec0cef219c72bb583f449ccba289c40.jpg', 10),
(16, '2015092408042480d172edd16c3e72166685de9b3f3a4a671aea4c.jpg', 10),
(22, '20151112092444d09246081d7ce8259ddb9bfebdb4017eae033707.jpg', 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_produto`
--

CREATE TABLE IF NOT EXISTS `imagem_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produto` (`id_produto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `imagem_produto`
--

INSERT INTO `imagem_produto` (`id`, `nome`, `id_produto`) VALUES
(1, '20151112111635987a9b2c872ca170f543814f68db96e760298f95.jpg', 1),
(2, '20151112111726987a9b2c872ca170f543814f68db96e760298f95.jpg', 2),
(3, '201511121145328118173f6961cbfe79d7861da85d0dd35158492f.jpg', 3),
(4, '201511121145522360caf2992d2d569804b0cc926e17a6ff5fcaae.jpg', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `email`, `senha`) VALUES
(1, 'teste@teste.com', '2e6f9b0d5885b6010f9167787445617f553a735f'),
(2, 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(3, '123@123.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(4, 'admin@admin.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `valorunit` double DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `id_fabricante` int(11) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fabricante` (`id_fabricante`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `valorunit`, `estoque`, `id_fabricante`, `url`) VALUES
(1, 'sgfs', 2, 2, 4, 'sgfs'),
(2, 'sgfs', 2, 2, 4, 'sgfs'),
(3, 'Coca cola', 5, 15, 2, 'coca-cola'),
(4, 'Pepsi', 3, 13, 2, 'pepsi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
