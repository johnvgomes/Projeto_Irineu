<!--Inicio Fotos Nivo-Slider Eventos-->
<div class="slider-wrapper theme-pascal">
    <div id="slider" class="nivoSlider">
        <!--
        <a href="http://vestibulinhoetec.com.br/calendario/" target="_blank">
            <img src="imagem/banner.png" alt="" />
        </a>
        
        <img src="imagem/Banner_EPA_2014_site.png" alt="EPA 2014" />
        -->
        <a href="<?php echo URL::getBase(); ?>epa" >
            <img src="imagem/Banner_Frente_EPA_2014_site.png" alt="EPA 2014" />
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
        $n->carregarIndex();
    ?>                       
</div>