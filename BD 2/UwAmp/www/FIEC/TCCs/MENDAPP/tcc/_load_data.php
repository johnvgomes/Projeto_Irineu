<?php


$mysql_hostname = "robb0187.publiccloud.com.br";
$mysql_user = "ene_s_tcc";
$mysql_password = "fiec@2014";
$mysql_database = "ene_sa_tcc_fiec";
$prefix = "";
@$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Erro ao Conectar Banco. Volte mais tarde");
mysql_select_db($mysql_database, $bd) or die("Erro ao Conectar Banco. Volte mais tarde");




session_start();
if($_POST['page'])
{
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 8;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

//$query_pag_data = "SELECT * from queixas LIMIT $start, $per_page";
$query_pag_data = "SELECT *, concat(' Rua:',txt_rua,' N: ', txt_numero,', ', txt_bairro,' - ', txt_cidade,' / ', txt_uf) AS endereco,
        date_format(dateTime, '%d/%m/%Y - %H:%ih') AS fdatahora FROM queixas WHERE id_usuario = '".$_SESSION['id']."' ORDER BY id_queixas DESC LIMIT $start, $per_page";
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());

$msg = "";
while ($row = mysql_fetch_array($result_pag_data)) {
    $part = explode("-",$row['fdatahora']);
$categoria=htmlentities($row['txt_categoria']);
$data=$part[0];
$endereco=utf8_encode($row['endereco']);

if($_POST['url'] == 'queixas')
    $detalhes ='<a href="descricao.php?queixa='.$row['id_queixas'].'"><span class="textoDireita">Detalhes</span><br><hr></a>';
elseif($_POST['url'] == 'listarespostas')
    $detalhes ='<a href="respostas.php?queixa='.$row['id_queixas'].'"><span class="textoDireita">Detalhes</span><br><hr></a>';



    $msg .= "<li><b>" . $row['id_queixas'] . "</b><span id='vermelho'>  ". $categoria ."  </span><b> ".$data." </b>". $endereco." ". $detalhes. "</li>";
}
$msg = "<div class='data'><ul>" . $msg . "</ul></div>"; 



/* --------------------------------------------- */
$query_pag_num = "SELECT COUNT(*) AS count FROM queixas";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>Primeira</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>Primeira</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Anterior</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Anterior</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#820000;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Próxima</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Próxima</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Última</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Última</li>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Ir'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Página <b>" . $cur_page . "</b> de <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
echo $msg;
}

?>