  
<?php include_once 'head.php'; 
?>

<script type='text/javascript' src='./js/jquerycep.js'></script>
<form action="/tcc/class/EditarFisico.php" method="post" id="formCadastro" name="formCadastro">

    <?php
    include_once 'Conectar.php';
    $con = new Conectar();

    if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "sucesso") {
            echo "<span class=\"mensagemCadastros\">Profissional foi atualizado com sucesso!</span>";
        } else if ($_GET["msg"] == "error") {
            echo "<span class=\"mensagemCadastros\">Erro ao atualizar profissional</span>";

        } else if ($_GET["msg"] == "cpfExiste") {
            echo "<span class=\"mensagemCadastros\">Esse CPF já foi cadastrado</span>";
        } else if ($_GET["msg"] == "rgExiste") {
            echo "<span class=\"mensagemCadastros\">Esse RG já foi cadastrado</span>";
        }
    }
    //pego o id do usuário que está na sessão 
    $idusuario =  $_SESSION['IdUsuario'];

//aqui pego as informações do profissional a partir do id que está na sessão
    $sql = "select * from profissional where id_usuario = '".$idusuario."'";  

    $res = $con->query($sql); 

    $row = $res->fetch(PDO::FETCH_NUM);

//informação de categoria de acordo com a categoria que estã em profissional 
   $sqlcategoria = "select * from categoria where id_categoria = '".$row[7]."'";  

    $categoria = $con->query($sqlcategoria); 

    $cat = $categoria->fetch(PDO::FETCH_NUM);
    
    //endereço 
    $sqlendereco = "select * from endereco where id_profissional = '".$row[0]."'";  

    $endereco = $con->query($sqlendereco); 

    $end = $endereco->fetch(PDO::FETCH_NUM);

    //email
    $sqlemail= "select * from email where id_profissional = '".$row[0]."'";  

    $email = $con->query($sqlemail); 

    $ema = $email->fetch(PDO::FETCH_NUM);

//telegone
    $sqltelefone= "select * from telefone where id_profissional = '".$row[0]."'";  

    $telefone = $con->query($sqltelefone); 

    $tel = $telefone->fetch(PDO::FETCH_NUM);

    ?>
    <div id="CadastroTabela" class="CadastroTabela">
        <table>
            <tr>
                <td>
                    <label>Nome:</label>
                </td>
                <td>
                    <input type="text" onchange="mark()" name="txtnome" id="txtNome" value="<?php echo utf8_encode($row[1]); ?>"placeholder="Digite seu nome" size="60" required>
                </td>
            </tr>

            <?php
            if ($row[2] == null){



            ?>


            <tr>
                <td><label>RG:</label></td>
                <td><input type="text" name="txtrg" id="txtrg" value="<?php echo utf8_encode($row[3]); ?>" OnKeyPress="formatar('##.###.###-#', this)" placeholder="Digite seu RG" maxlength="12" size="25" required/>

                    <label>CPF:</label>
                    <input type="text" name="txtcpf" id="txtcpf" value="<?php echo utf8_encode($row[4]); ?>" OnKeyPress="formatar('###.###.###-##', this)" placeholder="Digite seu CPF" maxlength="14" required/>
                    
                </td>
            </tr>
            <?php
        }else{


        ?>
          <tr>
                <td>
                    <label>CNPJ:</label>
                </td>
                <td>
                    <input type="text" name="txtcnpj" id="txtcnpj" value="<?php echo utf8_encode($row[2]); ?>" OnKeyPress="formatar('##.###.###/####-##', this)" placeholder="Digite o CNPJ " maxlength="18" required/>

                    <label>IE:</label> 
                    <input type="text" name="txtie" id="txtie" value="<?php echo utf8_encode($row[6]); ?>" placeholder="Inscrição Estadual" required/>
                </td>
            </tr>
            <?php
        }
        ?>
            <tr>
                <td>
                   <label>CEP:</label>
               </td>
               <td>
                <input type="text" name="txtcep" id="txtcep" value="<?php echo utf8_encode($end[2]); ?>" OnKeyPress="formatar('#####-###', this)" maxlength="9" placeholder="Digite o CEP aqui" required/>
            </td>
        </tr>


        <tr>
            <td>
                <label>Rua:</label>
            </td>
            <td>
                <input type="text" onchange="" ="atualiza()" value="<?php echo utf8_encode($end[0]); ?>" name="txtrua" id="txtrua" placeholder="Nome da Rua" size="60" required/>
            </td>
        </tr>

        <tr>
            <td>
                <label>Cidade:</label>
            </td>

            <td>

                <input type="text" onchange="atualiza()" name="txtcidade"  id="txtcidade" value="<?php echo utf8_encode($end[3]); ?>" placeholder="Nome da Cidade" required/>



                <label>Número:</label>
                <input type="text" onchange="atualiza()" name="txtnumero" id="txtnumero" value="<?php echo utf8_encode($end[1]); ?>" placeholder="Nº da casa" required/>
            </td>


        </tr>

        <tr>
            <td>
                <label>E-mail:</label>
            </td>
            <td>
                <input type="Email" onchange="mark()" name="txtemail" id="txtemail" value="<?php echo utf8_encode($ema[0]); ?>" placeholder="exemplo@exemplo.com" required/>

                <label>Telefone:</label>
                <input type="text" onchange="mark()" name="txttelefone" id="txttelefone" value="<?php echo utf8_encode($tel[0]); ?>" onkeypress="mascara(this)" maxlength="14" placeholder="(33)33333-3333" required/>
            </td>
        </tr>

        <tr>
            <td>
                <label>Categoria:</label>
            </td>
            <td> 
              <select name="cbocategoria" id="cbocategoria"  required >

                <option value="<?php echo utf8_encode($cat[1]); ?>"><?php echo utf8_encode($cat[0]); ?></option>
                <?php

                $sql = "SELECT * FROM categoria";

                $r = $con->query($sql);

                while ($linha = $r->fetch(PDO::FETCH_NUM)) {
                    echo utf8_encode("<option value='$linha[1]'>$linha[0]</option>");
                }

                ?>

            </select >
        </td>

        <tr>
            <td>
                <label></label>
            </td>
            <td>
                <textarea name="txtdescricao" onchange="mark()" id="txtdescricao" rows="10" cols="40" placeholder="Descreva o serviço..." required><?php echo utf8_encode($row[5]); ?></textarea>
            </tr>



        </table>
        <button name="btncadastrar" type="submit" 
        value="Cadastrar" id="btncadastrar">ATUALIZAR </button>
    </div>
</form>



<script>
$(document).ready( function() {
 /* Executa a requisição quando o campo CEP perder o foco */
 $('#txtcep').blur(function(){
     /* Configura a requisição AJAX */
     $.ajax({
        url : 'class/consultar_cep.php', /* URL que será chamada */ 
        type : 'POST', /* Tipo da requisição */ 
        data: 'txtcep=' + $('#txtcep').val(), /* dado que será enviado via POST */
        dataType: 'json', /* Tipo de transmissão */
        success: function(data){
            if(data.sucesso == 1){
                $('#txtrua').val(data.rua);

                $('#txtcidade').val(data.cidade);


                $('#txtnumero').focus();
            }
        }
    });   
     return false;    
 })
});</script>
<script type="text/javascript">
var txtrua;
var txtcidade;
var txtnumero;
var txtnome;
var txtemail;
var txttelefone;
var txtdescricao;
function atualiza(){
    txtrua = document.getElementById('txtrua').value;
    txtcidade = document.getElementById('txtcidade').value;
    txtnumero = document.getElementById('txtnumero').value;
    if(txtrua!="" && txtcidade!="" && txtnumero!=""){
     initialize(txtrua+","+txtnumero+","+txtcidade);
 }  
}

function mark(){

    txtrua = document.getElementById('txtrua').value;
    txtcidade = document.getElementById('txtcidade').value;
    txtnumero = document.getElementById('txtnumero').value;
    txtnome =document.getElementById('txtNome').value;
    txtemail =document.getElementById('txtemail').value;
    txttelefone =document.getElementById('txttelefone').value;
    txtdescricao =document.getElementById('txtdescricao').value;
    if(txtnome!="" && txtemail!="" && txttelefone!="" && txtdescricao!=""){
        markThatShit(txtrua+","+txtnumero+","+txtcidade,txtnome, txtdescricao, txtemail,txttelefone);
    } 
}


</script>



