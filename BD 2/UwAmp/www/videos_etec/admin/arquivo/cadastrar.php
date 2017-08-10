<?php

//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    include_once '../class/Arquivo.php';
    $a = new Arquivo();
    ?>
    <script src="../js/jquery-1.3.2.min.js" type="text/javascript"></script>  
    <script>
        $(document).ready(function() {
            $("#mostrar").click(function(evento) {
                if ($("#mostrar").attr("checked")) {
                    $("#arquivo").css("display", "block");
                    $("#link").css("display", "none");
                } else {
                    $("#arquivo").css("display", "none");
                    $("#link").css("display", "block");
                }
            });
        });
    </script>
    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Arquivo</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Descrição:</label> <br>
                    <input name="txtdescricao" maxlength="100" type="text"> 
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" name="chkmostrar" value="1" id="mostrar">Para inserir um arquivo, habilite aqui
                    <div id="arquivo" style="display: none;">
                        <label>Arquivo:</label>   <br> 
                        <input type="file" name="arquivo">  
                    </div>
                    <div id="link" style="display: block;">
                        <label>Link:</label>   <br> 
                        <input name="txtarquivo" maxlength="100" type="text"> 

                        <select name="cbodestino">
                            <option value="_self" selected>SELF</option>
                            <option value="_blank">BLANK</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Imagem:</label>   <br> 
                    <input type="file" name="imagem">    
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tipo:</label> <br>
                    <select name="cbotipo">
                        <option value="Aluno com arquivo">Aluno com arquivo</option>
                        <option value="Aluno sem arquivo">Aluno sem arquivo</option>
                        <option value="Servidor com arquivo">Servidor com arquivo</option>
                        <option value="Servidor sem arquivo">Servidor sem arquivo</option>
                        <option value="Plano Escolar">Plano Escolar</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Arquivo">
                </td>
            </tr>
        </form>
    </table>

    <?php

    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtdescricao'])) {

            extract($_POST, EXTR_OVERWRITE);

            $imagem = $_FILES['imagem']['name'];
            $imagemtemp = $_FILES['imagem']['tmp_name'];



            $extensoes1 = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");
            $ext1 = strtolower(substr($imagem, -4));

            if (isset($chkmostrar)) {
                $arquivo = $_FILES['arquivo']['name'];
                $arquivotemp = $_FILES['arquivo']['tmp_name'];
                $extensoes2 = array(".pdf");
                $ext2 = strtolower(substr($arquivo, -4));
                if (in_array($ext2, $extensoes2)) {
                    $newnome = date("Ymdhis") . md5($arquivo);
                    $a->setArquivo($newnome . $ext2);
                    $a->setTparquivo($arquivotemp);
                } else {
                    die();
                }
            } else {
                $a->setArquivo($txtarquivo);
            }

            if (in_array($ext1, $extensoes1)) {
                $newnome = date("Ymdhis") . md5($imagem);

                $a->setDescricao(strtr(strtoupper($txtdescricao), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
                $a->setTipo($cbotipo);

                $a->setImagem($newnome . $ext1);
                $a->setTpimagem($imagemtemp);

                $a->salvar($cbotipo, "../imagem-arquivo/", "../arquivo/");
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
