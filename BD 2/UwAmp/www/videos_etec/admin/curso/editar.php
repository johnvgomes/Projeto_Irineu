<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Curso.php';
    include_once '../class/Controles.php';
    $c = new Curso();
    $co = new Controles();

    /* evitar SQL Injection - injeção SQL (tentiva para invadir o banco de dados)
     * A Injeção de SQL, mais conhecida através do termo americano SQL Injection, 
     * é um tipo de ameaça de segurança que se aproveita de falhas em sistemas 
     * que interagem com bases de dados via SQL. A injeção de SQL ocorre quando 
     * o atacante consegue inserir uma série de instruções SQL dentro de uma 
     * consulta (query) através da manipulação das entradas de dados de uma aplicação.
     */
    $id = (int) $co->limparTexto($_GET['id']);
    $vetor = $c->carregar($id);

    include_once '../class/Eixo.php';
    $e = new Eixo();
    ?>
    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar Curso</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Eixo:</label>
                    <select name="cboeixo">
                        <optgroup label="Opção atual" />
                        //aqui carrega o atual
                        <option value="<?php echo $vetor[8]; ?>">
                            <?php echo $vetor[9]; ?>
                        </option>
                        //aqui carregam todos
                        <optgroup label="Escolha uma nova opção" />
                        <?php $e->carregarSelect(); ?>
                    </select>

                </td>
            </tr>
          
            <tr>
                <td>
                    <label>Nome:</label>
                    <input name="txtnome" type="text" maxlength="70" size="50"
                           value="<?php echo $vetor[2]; ?>"> 
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>CheckBox:</label>
                    <input type="checkbox" 
                           name="chb" <?php if($vetor[0] == 1) echo "checked"; ?>> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Descrição:</label>
                    <textarea name="txtdescricao" rows="4">
                    <?php echo $vetor[3]; ?>
                    </textarea>
                </td>
            </tr>
            
            
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Editar Curso">
                </td>
            </tr>
        </form>
    </table>
    <?php
    if (isset($_POST['btn'])) {
        extract($_POST, EXTR_OVERWRITE);

        $c->setId($id);
        $c->setId_eixo($cboeixo);
        $c->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $c->setDescricao($txtdescricao);
        $c->setUrl($co->retirarAcentos(strtolower($txtnome)));
        
        $c->editar();

        echo "<script language='javaScript'>window.location.href='?p=curso/consultar'</script>";
    }
}
?>