-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: Mai 21, 2013 as 03:53 AM
-- Versão do Servidor: 5.1.54
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `loja`
--
CREATE DATABASE `loja` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `loja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administracao`
--

CREATE TABLE IF NOT EXISTS `administracao` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `login` varchar(35) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `administracao`
--

INSERT INTO `administracao` (`id_adm`, `nome`, `email`, `login`, `senha`) VALUES
(2, 'Lisandro', 'ljobim@gmail.com', 'ljobim', '123'),
(3, 'Carlos', 'car@los.com', 'ccorrea', '1234'),
(4, 'david', 'polivendas@ig.com.br', 'dcorrea', '1234'),
(5, 'Ricardo', 'ric@col.com', 'raoliveira', '1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` text NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(14, 'Banquetas'),
(5, 'puff'),
(4, 'Mesas'),
(15, 'teste'),
(18, 'Luis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `telefone` int(10) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `maladireta` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_usuario`, `nome`, `endereco`, `telefone`, `mail`, `senha`, `login`, `maladireta`) VALUES
(2, 'Carlos', 'R joao tibiriça, 432', 1197758795, 'carluscorrea@gmail.com', '123', 'ccorrea', 0),
(3, 'Carlos', 'R. joao', 11, 'caluso', '123', 'car', 0),
(4, 'Edu', 'efp', 1197758795, 'das@ca.com', '123', 'babdu', 0),
(5, 'Carlos Belmiro Correa Neto', 'R Joao Tibiriça, 432', 11, 'carluscorrea@gmail.com', '1234', 'ccorrea', 0),
(6, 'Lucas Fleury', 'R anronieta', 11, 'lucas@series.com', '1234', 'lfleury', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao`
--

CREATE TABLE IF NOT EXISTS `configuracao` (
  `id_configuracao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `fone` varchar(20) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `inscricao` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_configuracao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `configuracao`
--

INSERT INTO `configuracao` (`id_configuracao`, `nome`, `endereco`, `bairro`, `cep`, `cidade`, `uf`, `fone`, `cnpj`, `inscricao`, `email`, `link`) VALUES
(1, 'Pah Puff', 'joao tibiriça, 432', 'Vila Leis', '13309-100', 'Itu', 'SP', '(011) 2429-4791', '44.192.792.00001-44', '220.3856.658.007', 'pahpuff@uol.com.br', 'www.pahpauff.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `estoque` int(11) NOT NULL,
  `preco` double NOT NULL,
  `lancamento` int(1) NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `id_categoria`, `id_subcategoria`, `produto`, `foto`, `descricao`, `estoque`, `preco`, `lancamento`) VALUES
(1, 5, 5, '30x30', 'a505c40067.jpg', 'Funciona?', 10, 99.9899978637695, 1),
(2, 5, 6, '40x40', 'a505c40067.jpg', 'Eh baum', 20, 88, 0),
(6, 4, 9, '60x60', '83f8db9dbc.jpg', 'Forte pra krai', 40, 66.6399993896484, 0),
(5, 4, 8, '50x50', 'dca73c5bde.jpg', 'melhor que esse pode esperar sentado! tchannnn', 30, 77.75, 0),
(16, 4, 9, 'mesa redonda de centro', 'dca73c5bde.jpg', 'alterar', 99, 18, 0),
(18, 18, 12, 'Teste', '', 'teste pasjldakdkasç	            ', 10, 99.99, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `subcategoria` varchar(35) NOT NULL,
  PRIMARY KEY (`id_subcategoria`,`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `id_categoria`, `subcategoria`) VALUES
(6, 5, 'quadrado'),
(5, 5, 'redondo'),
(8, 4, 'redondo'),
(9, 4, 'quadrado'),
(10, 15, 'buceta'),
(11, 14, 'Alta'),
(12, 18, 'Fernando');
