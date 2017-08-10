-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 05/07/2013 às 10h37min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(45) NOT NULL,
  `telefone` char(15) NOT NULL,
  `celular` char(15) NOT NULL,
  `email` char(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`id`, `nome`, `telefone`, `celular`, `email`) VALUES
(1, 'Pedro', '(11) 9999-8888', '(11) 9999-8888', 'pedro@site.com.br'),
(2, 'Roberto', '(11) 9999-8888', '(11) 9999-8888', 'roberto@site.com.br'),
(3, 'José', '(11) 9999-8888', '(11) 9999-8888', 'jose@site.com.br'),
(4, 'Leandro', '(11) 9999-8888', '(11) 9999-8888', 'leandro@site.com.br'),
(5, 'Leandro', '(11) 9999-8888', '(11) 9999-8888', 'leandro@site.com.br'),
(6, 'Leandro', '(11) 9999-8888', '(11) 9999-8888', 'leandro@site.com.br'),
(9, 'Marcio Ferraz', '11 40254264', '11 964110175', 'marcio.ferraz@etec.sp.gov.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` char(60) DEFAULT '',
  `email` char(100) DEFAULT '',
  `senha` char(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'treinaweb', 'treinaweb@treinaweb.com.br', '202cb962ac59075b964b07152d234b70'),
(2, 'Marcio', 'marcio.ferraz@etec.sp.gov.br', '202cb962ac59075b964b07152d234b70');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
