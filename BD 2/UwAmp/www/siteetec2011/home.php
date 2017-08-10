<!--Inicio Fotos Nivo-Slider Eventos-->
<div class="slider-wrapper theme-pascal">
    <div id="slider" class="nivoSlider">
        <a href="http://vestibulinhoetec.com.br" target="_blank">
            <img src="imagem/banner.png" alt="" />
        </a>
    </div>
    <div id="htmlcaption" class="nivo-html-caption">
    </div>
</div>
<!--Fim Fotos Nivo-Slider Eventos-->
            
            
<div class="bloco_box">                    
    <?php
        require_once 'class/Noticia.php';
        $n = new Noticia;
        $n->carregarIndex("");
    ?>                       
</div>