<style>
    span {
        display: none;
    }     

</style>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>


<div id="site">

    <div id="conteudo">
        <div id="topo">

            <marquee OnMouseOut="javascript:this.start()"
                     scrolldelay="33">

                <h1 class="cabecalho_um"> Cadastro de Usuário</h1>
            </marquee>
        </div>
        <h1 class="conteudo">
            <?php
            /* session_start();
              if (!isset($_SESSION['sessao'])) {
              echo 'Sem acesso!';
              } else {
             */
            ?>
            <form action="" method="post" >
                <table>
                    <tr>

                       <!--  <td>
                           
                    <h3>Formul&aacute;rio de Cadastro de Usuario</h3>Cadastro de Departamento</h3>
                           
                        </td> 
                        -->
                    </tr>
                    <tr>
                        <td>E-mail:<input name="txtemail" type="email" maxlength="100" size="50" />
                        </td>
                    </tr>
                    <tr>
                        <td>Senha:<input name="txtsenha" type="text" maxlength="10" size="50" />
                        </td>
                    </tr>
                    <tr>
                        <td><input name="enviar" type="submit" id="cadastrar" value="Cadastrar Usuario" />
                        </td>
                    </tr>
                </table>
            </form>
    </div>

    <div id="rodape">
        <h2 class="format">
            <pre>Desenvolvido pelo 3TI ETEC
                                
            </pre></h2>
    </div>

</div>
<?php
//cadastrar.php salvo na pasta adm/eixo
if (!empty($_POST['txtemail']) && !empty($_POST['txtsenha']) && isset($_POST['enviar'])) {
    //instanciando a class
    @require_once '../class/login.php';
    @$l = new Login("", $_POST['txtemail'], $_POST['txtsenha']);
    if ($l->consultarEmail() != 1) {
        @$l->salvar();
    } else {
        echo 'Email já cadastrado';
    }
} else {
    echo 'Preencha todos os campos';
}
echo '<br>';
// include_once 'editar.php';
//}
?>