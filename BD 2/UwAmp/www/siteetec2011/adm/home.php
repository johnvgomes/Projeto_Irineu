<table style="text-align:center;">
    <tr>
        <td colspan="3">
            <a href="http://www.vestibulinhoetec.com.br" target="_blank" title="Vestibulinho">
                <img src="../imagem/banner.png" alt="Vestibulinho" />
            </a>
        </td>
    </tr>

    <?php
    require_once '../class/Noticia.php';
    $n = new Noticia;
    
    $n->carregarIndex("adm");
    ?>
</table>