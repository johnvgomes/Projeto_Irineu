<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Moto.php';
    include_once '../class/Controles.php';
    $m = new Moto();
    $co = new Controles();

    /* evitar SQL Injection - injeção SQL (tentiva para invadir o banco de dados)
     * A Injeção de SQL, mais conhecida através do termo americano SQL Injection, 
     * é um tipo de ameaça de segurança que se aproveita de falhas em sistemas 
     * que interagem com bases de dados via SQL. A injeção de SQL ocorre quando 
     * o atacante consegue inserir uma série de instruções SQL dentro de uma 
     * consulta (query) através da manipulação das entradas de dados de uma aplicação.
     */
    $id = (int) $co->limparTexto($_GET['id']);
    $vetor = $m->carregar($id);

    include_once '../class/Marca.php';
    $ma = new Marca();
    ?>
    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar Moto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Placa:</label>
                    <input name="txtplaca" type="text" maxlength="10" size="50" 
                           value="<?php echo $vetor[1]; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Modelo:</label>
                    <input name="txtmodelo" type="text" maxlength="100" size="50" 
                           value="<?php echo $vetor[2]; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Marca:</label>
                    <select name="cbomarca">
                        <optgroup label="Opção atual" />
                        //aqui carrega o atual
                        <option value="<?php echo $vetor[9]; ?>">
                            <?php echo $vetor[10]; ?>
                        </option>
                        //aqui carregam todos
                        <optgroup label="Escolha uma nova opção" />
                        <?php
                        $ma->carregarCombo();
                        ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Cilindradas:</label>
                    <input name="txtcc" type="text" maxlength="5" size="50" 
                           value="<?php echo $vetor[3]; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Renavam:</label>
                    <input name="txtrenavam" type="text" maxlength="40" size="50" 
                           value="<?php echo $vetor[4]; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Estoque:</label>
                    <input name="txtestoque" type="number" min="0" max="1"  
                           value="<?php echo $vetor[6]; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Valor:</label>
                    <input name="txtvalor" type="text" 
                           value="<?php echo $vetor[7]; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btncad" type="submit" value="Cadastrar" />
                </td>
            </tr>
        </form>
    </table>
    <?php
    if (isset($_POST['btncad'])) {
        extract($_POST, EXTR_OVERWRITE);

        $m->setId($id);
        $m->setPlaca($txtplaca);
        $m->setModelo($txtmodelo);
        $m->setCC($txtcc);
        $m->setRenavam($txtrenavam);
        $m->setEstoque($txtestoque);
        $m->setValor($txtvalor);
        $m->setId_marca($cbomarca);

        $m->editar();

        header('Location:?p=moto/consultar');
        echo
        '<meta http-equiv="refresh" 
        content="1;URL=?p=moto/consultar">';
    }
}
?>