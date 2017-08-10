<script src="mtel.js"></script>
<table>
    <form name="frmcontato" id="frmcontato" 
          method="post" action="">
        <tr>
            <td colspan="2"><h3>Fale Conosco</h3></td>
        </tr>
        <tr>
            <td><label>Escolha:</label></td>
            <td>
                <select name="caixa" id="caixa">
                    <option value="rh@empresa.com">
                        Recursos Humanos
                    </option>
                    <option value="vendas@empresa.com">
                        Vendas
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Nome: </label></td>
            <td>
                <!--Comentários-->
                <input type="text" name="txtnome"
                       size="50" maxlength="40"
                       id="txtnome" 
                       placeholder="Nome aqui" 
                       required />           
            </td>
        </tr>
        <tr>
            <td><label>Email: </label></td>
            <td>
                <input type="email" name="txtemail"
                       size="50" maxlength="50"
                       id="txtemail" required />
            </td>
        </tr>
        <tr>
            <td><label>Telefone: </label></td>
            <td>
                <input type="text" name="txttel"
                       size="50" maxlength="15"
                       id="txttel" required
                       onkeyup="mascara(this,mtel);"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Mensagem:</label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <textarea name="txtmsg" id="txtmsg"
                          cols="50" rows="4">
                </textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="btnenviar"
                       value="Enviar" id="btnenviar" />
                
                <input type="reset" name="btnlimpar"
                       value="Limpar" id="btnlimpar" />
            </td>
        </tr>
    </form>
</table>
<?php
    //se o botão btnenviar for utilizado (clicado)
    if(isset($_POST['btnenviar'])){
        $remetente = $_POST['txtemail'];
        $para = $_POST['caixa'];
        $assunto = "Empresa XYZ - mensagem do site";
        $msg = "Mensagem enviada em ".date("d/m/Y").",
            Empresa XYZ<br />".
            "Nome : ".$_POST['txtnome']."<br />
            E-mail: ".$_POST['txtemail']."<br />".
                $_POST['txtmsg'];
        
        $headers = "MIME-Version: 1.1\n";
        $headers .= "Content-type: text/html";
        $headers .= " charset=utf-8\n";
        $headers .= "From: $remetente\n";
        $headers .= "Return-Path: $remetente\n";
        $headers .= "Reply-To: $remetente\n";
        
        $envio = mail(
                $para,
                $assunto,
                $msg,
                $headers,
                $remetente
                );
        
        if($envio){
            echo "Mensagem enviada.";
        }else{
            echo "Erro";
        }
        
    }
?>