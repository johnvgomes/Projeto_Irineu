<?php
require_once "class/Url.php";
$endereco="http://www.etecitu.com.br";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="ETEC Itu, Informatica, Informatica para Internet, WEB, Administracao, Meio Ambiente, Paisagismo, Hospedagem, Agenciamento de Viagem, Turismo, Escola Tecnica, Logistica, Integrado, Ensino Medio, Itu, Sao Paulo, Brasil, gratuito" />
<meta name="description" content="Site da ETEC Itu - cursos tecnicos gratuitos" />
<title>Etec Itu - Martinho Di Ciero</title> 
<link href="<?php echo $endereco; ?>/estilo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo $endereco; ?>/imagem/etec.ico" />

<!--In�cio do c�digo do Banner Rotativo-->
    <link rel="stylesheet" href="<?php echo $endereco; ?>/themes/pascal/pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $endereco; ?>/nivo-slider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo $endereco; ?>/scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $endereco; ?>/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
<!--Fim do c�digo do Banner Rotativo-->
<link rel="stylesheet" href="<?php echo $endereco; ?>/01/lavalamp_test.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo $endereco; ?>/01/jquery-1.1.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $endereco; ?>/01/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo $endereco; ?>/01/jquery.lavalamp.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#2").lavaLamp({
                fx: "backout", 
                speed: 700,
                click: function(event, menuItem) {
                    return true;
                }
            });
        });
    </script>
 


</head> 
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    
<body> 
    <div id="header">
    	<div id="top">
			<div id="logo_top"><img src="<?php echo $endereco; ?>/images/logo_etec.png"/></div>
			<div id="titulo_top">
                            <a href="http://centropaulasouza.sp.gov.br" target="_blank">
                                <img src="<?php echo $endereco; ?>/images/logo_centro.png" border="0" />
                            </a>
                        </div>
            <div class="linha"></div>
            <!--In�cio do Menu em JQuery-->
        
            <div id="menu_lavaLamp" >              
                <ul class="lavaLampNoImage" id="2">
                    
                    <li><a href="<?php echo URL::getBase(); ?>home">HOME</a></li>
                    <li><a href="<?php echo URL::getBase(); ?>curso">CURSOS</a></li>
                    <li><a href="<?php echo URL::getBase(); ?>calendario">CALEND&Aacute;RIO ESCOLAR</a></li>
                    <li><a href="<?php echo URL::getBase(); ?>localizacao">LOCALIZA&Ccedil;&Atilde;O</a></li>
                    <li><a href="<?php echo URL::getBase(); ?>noticia">NOT&Iacute;CIAS</a></li>
                    <li><a href="<?php echo URL::getBase(); ?>contas">PRESTA&Ccedil;&Atilde;O DE CONTAS</a></li>
                    <li><a href="<?php echo URL::getBase(); ?>contato">FALE CONOSCO</a></li>
                </ul>
            </div>
            <!--Fim do Menu em JQuery-->
        </div> 
    </div>

    <div id="centro">
        <div id="lateral">
            <div id="utilitarios">
                <p>CONFIRA AQUI</p>
                <a href="<?php echo URL::getBase(); ?>epa">
                    <img src="<?php echo $endereco; ?>/imagem/epa.png" alt="EPA" border="0" />
                </a>
                <a href="<?php echo $endereco; ?>/arquivo/normas.pdf" target="_blank">
                    <img src="<?php echo $endereco; ?>/imagem/normas.png" alt="normas" border="0" />
                </a>
                
                <a href="<?php echo $endereco; ?>/arquivo/biblioteca.pdf" target="_blank">
                    <img src="<?php echo $endereco; ?>/imagem/biblioteca.png" alt="Biblioteca" border="0" />
                </a>
                
                <!--
                <a href="<?php //echo $endereco; ?>/novo/nota" target="_self">
                    <img src="<?php //echo $endereco; ?>/imagem/notaVence.png" alt="Notas Vence" border="0" />
                </a>
                -->
                <a href="<?php echo $endereco; ?>/arquivo/manual_professor_ingressante_CPS.pdf" target="_blank">
                    <img src="<?php echo $endereco; ?>/imagem/manualProfessor.png" alt="Manual Professor" border="0" />
                </a>
                <a href="<?php echo $endereco; ?>/arquivo/manualTCC.pdf" target="_blank">
                    <img src="<?php echo $endereco; ?>/imagem/tcc.png" alt="Manual TCC" border="0" />
                </a>
                
                <!--
                <a href='<?php //echo $endereco; ?>/morpheus' target='_blank'>
                    <img src="<?php //echo $endereco; ?>/imagem/aluno.png" alt="Notas" border="0" />
                </a>
                -->
                <a href='<?php echo $endereco; ?>/arquivo/ppg.pdf' title='PPG - Plano Escolar' target='_blank'>
                    <img src="<?php echo $endereco; ?>/imagem/ppg.png" alt="PPG" border="0" />
                </a>
                <!--
                <a href='<?php //echo $endereco; ?>/arquivo/economia_Criativa.pdf' title='Economia Criativa' target='_blank'>
                    <img src="<?php //echo $endereco; ?>/imagem/econCriativa.png" alt="econ" border="0" />
                </a>
                -->
                
                <a href="https://recadastramentoanual.gestaopublica.sp.gov.br/recadastramentoanual/noauth/LoginPrepare.do" target="_blank">
                  <img src="<?php echo $endereco; ?>/imagem/recadastramento.png" alt="Recadastramento" border="0" />
                </a>
                <a href="http://www.e-folha.sp.gov.br/desc_dempagto/entrada.asp?cliente=092" target="_blank">
                  <img src="<?php echo $endereco; ?>/imagem/prodesp.png" alt="Prodesp" border="0" />
                </a>
            </div>
            <div id="parceiro">
                <p>PARCEIROS CULTURAIS</p>
                <?php
                    require_once 'class/Banner.php';
                    @$b = new Banner();
                    @$b->carregarBanner("   ");
                ?>  
            </div>
        </div>
        <div id="conteudo">
            <?php
                $modulo = Url::getURL( 0 );

                if( $modulo == null )
                    $modulo = "home";

                if( file_exists( $modulo . ".php" ) )
                    require_once $modulo . ".php";
                else
                require_once "home.php";
            ?>
        </div>
    </div>  
    
    <div id="rodape">
        
        <table width="750" align="center">
    	
    	<tr>
            <td colspan="2"><div align="center"><h3>Avenida Barata Ribeiro, 410 Vila Prudente de Moraes - Itu/SP</h3></div></td>
            <td class="alinhamento"> </td>
        </tr>
        <tr>
            <td>(11) 4024-1009 | Email: eteitu@uol.com.br | op86@centropaulasouza.sp.gov.br</td>
            <td><div align="right">Copyright &copy; ETEC Itu | <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | </div></td>
            <td>&nbsp;<br /><br /><br /></td>   
        </tr>
    </table>
        
    </div>
</body> 
</html>

