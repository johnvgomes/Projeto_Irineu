<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Calendario.php';
    include_once '../class/Controles.php';
    $c = new Calendario();
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

    include_once '../class/Unidade.php';
    $u = new Unidade();
    ?>
    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar Calendário</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Unidade:</label>
                    <select name="cbounidade">
                        <optgroup label="Opção atual" />
                        //aqui carrega o atual
                        <option value="<?php echo $vetor[4]; ?>">
                            <?php echo $vetor[5]; ?>
                        </option>
                        //aqui carregam todos
                        <optgroup label="Escolha uma nova opção" />
                        <?php $u->carregarSelect(); ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Ano:</label>
                    <input name="txtano" type="number" min="2014" max="3000"
                           value="<?php echo $vetor[2]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Editar Calendário">
                </td>
            </tr>
        </form>
    </table>
    <?php
    if (isset($_POST['btn'])) {
        extract($_POST, EXTR_OVERWRITE);

        $c->setId($id);
        $c->setId_unidade($cbounidade);
        $c->setAno($txtano);
        
        $c->editar();

        echo "<script language='javaScript'>window.location.href='?p=calendario/consultar'</script>";
    }
}
?>