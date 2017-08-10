<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
} else {


    include_once '../class/Eixo.php';
    $e = new Eixo();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Curso</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Eixo:</label>
                    <select name="cboeixo">
                        <option>Escolha um Eixo Tecnológico</option>
                        <?php $e->carregarSelect(); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nome:</label>
                    <input name="txtnome" type="text" maxlength="70" size="50"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Descrição:</label>
                    <textarea name="txtdescricao" rows="4">
                    </textarea>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Plano de Curso:</label>    
                    <input type="file" name="plano">    
                </td>
            </tr>
            <tr>
                <td>
                    <label>Matriz Curricular:</label>    
                    <input type="file" name="matriz">    
                </td>
            </tr>
            <tr>
                <td>
                    <label>Icone:</label>    
                    <input type="file" name="icone">    
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Curso">
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        $plano = $_FILES["plano"];
        $matriz = $_FILES["matriz"];
        $icone = $_FILES["icone"];

        extract($_POST, EXTR_OVERWRITE);

        include_once '../class/Curso.php';
        $cu = new Curso();
        
        include_once '../class/Controles.php';
        $ct = new Controles();

        $tpplano = $plano['tmp_name'];
        $plano = $plano['name'];
        
        $tpmatriz = $matriz['tmp_name'];
        $matriz = $matriz['name'];
        
        $tpicone = $icone['tmp_name'];
        $icone = $icone['name'];

        $cu->setId_eixo($cboeixo);
        $cu->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $cu->setDescricao($txtdescricao);
        $cu->setMatriz($matriz);
        $cu->setTpmatriz($tpmatriz);
        $cu->setPlano($plano);
        $cu->setTpplano($tpplano);
        $cu->setUrl($ct->retirarAcentos(strtolower($txtnome)));
        $cu->setIcone($icone);
        $cu->setTpicone($tpicone);
        /*
        echo $c->getId_eixo() . " " .$c->getNome() . " "
                .$c->getDescricao() . " "
                .$c->getMatriz()." ".$c->getTpmatriz() . " "
            ." ".$c->getPlano() . " "." ".$c->getTpplano() . " ";
         * 
         */
         
        
        $cu->salvar();
    }
}
?>