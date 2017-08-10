  
      <?php include_once 'head.php';
      ?>
       
   <script type='text/javascript' src='./js/jquerycep.js'></script>
    <form action="/tcc/class/CadFisico.php" method="post" id="formCadastro" name="formCadastro">
       
    <?php
    if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "sucesso") {
            echo "<span class=\"mensagemCadastros\">Profissional foi cadastrado com sucesso!</span>";
        } else if ($_GET["msg"] == "error") {
            echo "<span class=\"mensagemCadastros\">Erro ao cadastrar profissional</span>";
        
        } else if ($_GET["msg"] == "cpfExiste") {
            echo "<span class=\"mensagemCadastros\">Esse CPF já foi cadastrado</span>";
        } else if ($_GET["msg"] == "rgExiste") {
            echo "<span class=\"mensagemCadastros\">Esse RG já foi cadastrado</span>";
        }
    }

   
    
    ?>
           <div id="CadastroTabela" class="CadastroTabela">
        <table>
            <tr>
                <td>
                    <label>Nome:</label>
                </td>
                <td>
                    <input type="text" onchange="mark()" name="txtnome" id="txtNome" placeholder="Digite seu nome" size="60" required>
                </td>
            </tr>


            <tr>
                <td><label>CPF:</label></td>
                <td><input type="text" name="txtcpf" id="txtcpf" OnKeyPress="formatar('###.###.###-##', this)" placeholder="Digite seu CPF" maxlength="14" required/>

                    <label>RG:</label>
                    <input type="text" name="txtrg" id="txtrg" OnKeyPress="formatar('##.###.###-#', this)" placeholder="Digite seu RG" maxlength="12" size="25" required/>
                </td>
            </tr>
            <tr>
                <td>
             <label>CEP:</label>
                </td>
                <td>
                    <input type="text" name="txtcep" id="txtcep" OnKeyPress="formatar('#####-###', this)" maxlength="9" placeholder="Digite o CEP aqui" required/>
            </td>
            </tr>
            

            <tr>
                <td>
                    <label>Rua:</label>
                </td>
                <td>
                    <input type="text" onchange="" ="atualiza()" name="txtrua" id="txtrua" placeholder="Nome da Rua" size="60" required/>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Cidade:</label>
                </td>

                <td>

                    <input type="text" onchange="atualiza()" name="txtcidade" id="txtcidade" placeholder="Nome da Cidade" required/>
                    
                    

                    <label>Número:</label>
                    <input type="text" onchange="atualiza()" name="txtnumero" id="txtnumero" placeholder="Nº da casa" required/>
                </td>


            </tr>

            <tr>
                <td>
                    <label>E-mail:</label>
                </td>
                <td>
                    <input type="Email" onchange="mark()" name="txtemail" id="txtemail" placeholder="exemplo@exemplo.com" required/>

                    <label>Telefone:</label>
                    <input type="text" onchange="mark()" name="txttelefone" id="txttelefone" onkeypress="mascara(this)" maxlength="14" placeholder="(33)33333-3333" required/>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Categoria:</label>
                </td>
                <td> 
                      <select name="cbocategoria" id="cbocategoria" required >
                        
                        <option></option>
                         <?php
                             include_once 'Conectar.php';
                         $con = new Conectar();
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
                    <textarea name="txtdescricao" onchange="mark()" id="txtdescricao" rows="10" cols="40" placeholder="Descreva o serviço..." required></textarea>
            </tr>

         

        </table>
        <button name="btncadastrar" type="submit" 
                            value="Cadastrar" id="btncadastrar">CADASTRAR </button>
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


    
    