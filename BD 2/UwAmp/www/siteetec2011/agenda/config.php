<?php

/**
 * Constantes de configuração do Framework.
 */

// Dados de acesso ao banco de dados

define('DB_TYPE', 'mysql');
define('DB_HOST', '186.202.152.55');
define('DB_NAME', 'site1371059233');
define('DB_USER', 'site1371059233');
define('DB_PASS', 'E1981Adm11');

// Diretórios

define('SITE_URL','http://etecitu.com.br/agenda');
define('STATIC_URL','http://etecitu.com.br/agenda/static');
define('IMG_URL','http://etecitu.com.br/agenda/static/img');

define('SITE_PATH',realpath(dirname(__FILE__)).'/');
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/application/controllers'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/application/views'));
define('MODEL_PATH', realpath(dirname(__FILE__) . '/application/models'));