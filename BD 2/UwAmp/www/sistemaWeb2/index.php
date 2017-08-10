<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php include_once 'head.php'; ?>
    </head>
    <body>
        <div class="container">

            <div class="header">
                <a href="index.html" 
                   title="Pagina Inicial"
                   target="_self">
                    <img src="imagem/globo.png"
                         alt="Logo da Pagina">
                </a>
                <span>Empresa</span>
            </div>

            <div class="nav">
                <?php include_once 'nav.php'; ?>
            </div>

            <div class="content">
                conteudo
            </div>
        </div><!--fim container-->

        <div class="footer">
            <div class="mapadosite">
                <h3>Mapa do Site</h3>
                <a href="index.html" 
                   title="Pagina Principal"
                   target="_self">
                    Página Principal
                </a>
                <br>
                <a href="contato.html" 
                   title="Fale Conosco"
                   target="_self">
                    Fale Conosco
                </a>
                <br>
                <a href="folha.html" 
                   title="Folha de Pagamento"
                   target="_self">
                    Folha de Pagamento
                </a>
                <br>
                <a href="erro.html" 
                   title="Erros"
                   target="_self">
                    Erro
                </a>
            </div><!--fim mapadosite-->
            <div class="mapadosite">
                <h3>Localização</h3>

            </div>
            <div class="empresa">
                <h3>Empresa XYZ</h3>
                <p>Rua: teste, 100 - Itu/SP</p>
                <p>E-mail: contato@empresaxyz.com</p>
                <p>Telefones: (11) 4444-4444 | 5555-5555</p> 
            </div>
        </div><!--fim do footer-->
    </body>
</html>
