/*
Navicat MySQL Data Transfer

Source Server         : admin
Source Server Version : 50134
Source Host           : localhost:3306
Source Database       : mendapp

Target Server Type    : MYSQL
Target Server Version : 50134
File Encoding         : 65001

Date: 2014-11-26 21:11:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `fotos`
-- ----------------------------
DROP TABLE IF EXISTS `fotos`;
CREATE TABLE `fotos` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `name_foto` varchar(20) NOT NULL,
  `id_queixas` int(11) NOT NULL,
  PRIMARY KEY (`id_foto`),
  KEY `fk_id_queixa` (`id_queixas`),
  CONSTRAINT `fk_id_queixa` FOREIGN KEY (`id_queixas`) REFERENCES `queixas` (`id_queixas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fotos
-- ----------------------------

-- ----------------------------
-- Table structure for `orgao`
-- ----------------------------
DROP TABLE IF EXISTS `orgao`;
CREATE TABLE `orgao` (
  `id_orgao` int(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `endereco` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `num` varchar(20) NOT NULL,
  `ddd` varchar(2) NOT NULL,
  `tel` varchar(9) NOT NULL,
  `icon` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orgao
-- ----------------------------
INSERT INTO `orgao` VALUES ('1', 'SAAE', 'SAAE', 'Augusto Lùcio', 'saae@saae.com', '123', '19', '99999999', 'saae.png');

-- ----------------------------
-- Table structure for `queixas`
-- ----------------------------
DROP TABLE IF EXISTS `queixas`;
CREATE TABLE `queixas` (
  `id_queixas` int(11) NOT NULL AUTO_INCREMENT,
  `txt_queixas` text,
  `txt_rua` varchar(100) DEFAULT NULL,
  `txt_numero` varchar(25) DEFAULT NULL,
  `txt_bairro` varchar(200) DEFAULT NULL,
  `txt_cidade` varchar(50) DEFAULT NULL,
  `txt_cep` varchar(9) DEFAULT NULL,
  `txt_uf` varchar(2) DEFAULT NULL,
  `txt_categoria` varchar(20) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `dateTime` varchar(50) DEFAULT NULL,
  `id_usuario` int(12) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_queixas`),
  KEY `fk_queixa_usuario` (`id_usuario`),
  CONSTRAINT `fk_queixa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of queixas
-- ----------------------------

-- ----------------------------
-- Table structure for `respostas`
-- ----------------------------
DROP TABLE IF EXISTS `respostas`;
CREATE TABLE `respostas` (
  `id_resposta` int(11) NOT NULL AUTO_INCREMENT,
  `resposta` longtext,
  `data` datetime DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `id_queixa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_resposta`),
  KEY `id_queixas` (`id_queixa`),
  CONSTRAINT `id_queixas` FOREIGN KEY (`id_queixa`) REFERENCES `queixas` (`id_queixas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of respostas
-- ----------------------------

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `block` bit(1) NOT NULL,
  `id_usuario` int(12) NOT NULL AUTO_INCREMENT,
  `txt_usuario` varchar(255) NOT NULL,
  `txt_senha` varchar(500) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `txt_email` varchar(100) NOT NULL,
  `desk` bit(1) NOT NULL DEFAULT b'1',
  `orgao` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `txt_usuario` (`txt_usuario`),
  UNIQUE KEY `txt_usuario_2` (`txt_usuario`),
  UNIQUE KEY `txt_email` (`txt_email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('', '14', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', '', '');
INSERT INTO `usuarios` VALUES ('', '18', 'Mateus', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mate@us.com', '', '');
