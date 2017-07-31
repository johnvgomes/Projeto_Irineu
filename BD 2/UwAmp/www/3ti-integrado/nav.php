

<div id='cssmenu'>
    <ul>
        <li <?php if($url->getUrl(0) == 'pagina-inicial') echo "class='active'"; ?> ><a href='<?php echo $url->getBase(); ?>pagina-inicial'><span>Página Inicial</span></a></li>
        <li <?php if($url->getUrl(0) == 'contato') echo "class='active'"; ?>><a href='<?php echo $url->getBase(); ?>contato'><span>Fale Conosco</span></a></li>
        <li <?php if($url->getUrl(0) == 'funcionario') echo "class='active'"; ?>><a href='<?php echo $url->getBase(); ?>funcionario'><span>Funcionário</span></a></li>
       <li <?php if($url->getUrl(0) == 'produto') echo "class='active'"; ?>><a href='<?php echo $url->getBase(); ?>produto'><span>Produto</span></a></li> 
    </ul>
</div>