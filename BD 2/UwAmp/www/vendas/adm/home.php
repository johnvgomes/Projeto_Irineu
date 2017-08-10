<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    include_once '../class/Admin.php';
    $a = new Admin();
    include_once '../class/Categorias.php';
    $c = new Categorias();
    include_once '../class/Clientes.php';
    $cl = new Clientes();
    include_once '../class/Marcas.php';
    $m = new Marcas();
    include_once '../class/Produtos.php';
    $p = new Produtos();
    include_once '../class/Subcategorias.php';
    $s = new Subcategorias();
    include_once '../class/Textos.php';
    $t = new Textos();
    include_once '../class/Tipospagamento.php';
    $tp = new Tipospagamento();
    include_once '../class/Vendas.php';
    $v = new Vendas();
    ?>

    <div id="home">
        <p><span id="welcome">Bem-vindo</span>, administrador(a) <?php echo $_SESSION['adm']; ?>.</p>
        <p>Utilize o <span class="underline">menu lateral</span> para navegar entre as tabelas. E, caso queira localizar-se de maneira r&aacute;pida,
            observe a <span class="underline">navega&ccedil;&atilde;o estrutural</span> do rodap&eacute;.</p>
        <table id="homeTable">
            <thead>
                <tr>
                    <td>Tabela</td>
                    <td>N&uacute;m. de registros</td>
                    <td>N&uacute;m. de registros ativos</td>
                    <td>&Uacute;ltimo registro</td>
                </tr>
            </thead>
            <?php $a->dadosTabela(); ?>
            <?php $c->dadosTabela(); ?>
            <?php $cl->dadosTabela(); ?>
            <?php $m->dadosTabela(); ?>
            <?php $p->dadosTabela(); ?>
            <?php $s->dadosTabela(); ?>
            <?php $t->dadosTabela(); ?>
            <?php $tp->dadosTabela(); ?>
            <?php $v->dadosTabela(); ?>
        </table>
    </div>
    <?php
}
?>