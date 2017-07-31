<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Carregando...';
    session_destroy();
    //Limpa
    unset($_SESSION['sessao']);
    //Redireciona para a página de autenticação
    echo "<script language='javaScript'>window.location.href='login.php'</script>";
    
}
else{
     echo "<script language='javaScript'>window.location.href='PaginaInicial/paginainicial.php'</script>";
    
}
?>