<div id='cssmenu'>
    <ul>
        <li <?php if ($url->getUrl(0) == 'pagina-inicial')  ?>><a href='<?php echo $url->getBase(); ?>pagina-inicial'>Home</a></li>
        <li class='active has-sub'><a href='#'>Cadastrar</a>
            <ul>
                <li <?php if ($url->getUrl(0) == 'cadastrar-departamento') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>cadastrar-departamento'>Departamento</a>
                </li>
                <li <?php if ($url->getUrl(0) == 'cadastrar-fabricante') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>cadastrar-fabricante'>Fabricante</a>
                </li>
                <li <?php if ($url->getUrl(0) == 'cadastrar-funcionario') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>cadastrar-funcionario'>Funcionario</a>
                </li>
                <li <?php if ($url->getUrl(0) == 'cadastrar-produto') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>cadastrar-produto'>Produto</a>
                </li>
            </ul>
        </li>
        <li class='active has-sub'><a href='#'>Consultar</a>
            <ul>
                <li <?php if ($url->getUrl(0) == 'consultar-departamento') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>consultar-departamento'>Departamento</a>
                </li>
                <li <?php if ($url->getUrl(0) == 'consultar-fabricante') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>consultar-fabricante'>Fabricante</a>
                </li>
                <li <?php if ($url->getUrl(0) == 'consultar-funcionario') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>consultar-funcionario'>Funcionario</a>
                </li>
                <li <?php if ($url->getUrl(0) == 'consultar-produto') echo "class='has-sub'" ?>><a href='<?php echo $url->getBase(); ?>consultar-produto'>Produto</a>
                </li>
            </ul>
        </li>
        <li <?php if ($url->getUrl(0) == 'contato')  ?>><a href='<?php echo $url->getBase(); ?>contato'>Contato</a></li>
    </ul>
</div>