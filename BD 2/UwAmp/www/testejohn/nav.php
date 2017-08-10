<?php
/*<div id='cssmenu'>
    <ul>
        <li <?php if ($url->getUrl(0) == 'pagina-inicial') echo "class='active'" ?>><a href='<?php echo $url->getBase(); ?>pagina-inicial'><span>Home</span></a></li>
        <li <?php if ($url->getUrl(0) == 'contato') echo "class='active'" ?>><a href='<?php echo $url->getBase(); ?>contato'><span>Fale Conosco</span></a></li>
        <li <?php if ($url->getUrl(0) == 'noticias') echo "class='active'" ?>><a href='<?php echo $url->getBase(); ?>noticias'><span>Noticías</span></a></li>
    </ul>
</div>
*/?>
<div id='cssmenu'>
<ul>
   <li><a href='#'>Home</a></li>
   <li class='active has-sub'><a href='#'>Products</a>
      <ul>
         <li class='has-sub'><a href='#'>Product 1</a>
            <ul>
               <li><a href='#'>Sub Product</a></li>
               <li><a href='#'>Sub Product</a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'>Product 2</a>
            <ul>
               <li><a href='#'>Sub Product</a></li>
               <li><a href='#'>Sub Product</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'>About</a></li>
   <li><a href='#'>Contact</a></li>
</ul>
</div>