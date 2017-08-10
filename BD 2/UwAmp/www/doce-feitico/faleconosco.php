<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doce Feitiço</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>



    <!-- ===== HEADER ===== -->
    <header>
        <div class="wrap">            
            <img src="img/logo.png" alt="" class="logo">

            <nav>
                <a href="index.php">Home</a>
                <a href="sobre.php" class="act">Sobre</a>
                 <a href="faleconosco.php">Fale Conosco</a>
            </nav>
            
        </div>
    </header>


<div class="all-content">

        <div class="wrap">

            <div class="content">
               
   <center>
    <form method="post" action="send-faleconosco.php">
    <fieldset>
    	<table>
  		 <p>&nbsp;</p>
  		 <p>&nbsp;</p>
  		 <tr>
    <td><label for="name"> Nome: </label></td>
    <td><input type="text" name="nome_completo" id="nome" required/></br></td>
      </tr>
         <tr>
    <td><label for="endereco"> Endereco: </label></td>
    <td><input type="text" name="endereco" id="endereco"/></br></td>
   		</tr>
    <tr>
    <td><label for="cidade"> Cidade: </label></td>
    <td><input type="text" name="cidade" id="cidade"/></br></td>
    
    
    <td><label for="estado"> Estado:</label>
	<select name="estado"> 
		<option value="estado">Selecione o Estado</option> 
		<option value="ac">Acre</option> 
		<option value="al">Alagoas</option> 
		<option value="am">Amazonas</option> 
		<option value="ap">Amapá</option> 
		<option value="ba">Bahia</option> 
		<option value="ce">Ceará</option> 
		<option value="df">Distrito Federal</option> 
		<option value="es">Espírito Santo</option> 
		<option value="go">Goiás</option> 
		<option value="ma">Maranhão</option> 
		<option value="mt">Mato Grosso</option> 
		<option value="ms">Mato Grosso do Sul</option> 
		<option value="mg">Minas Gerais</option> 
		<option value="pa">Pará</option> 
		<option value="pb">Paraíba</option> 
		<option value="pr">Paraná</option> 
		<option value="pe">Pernambuco</option> 
		<option value="pi">Piauí</option> 
		<option value="rj">Rio de Janeiro</option> 
		<option value="rn">Rio Grande do Norte</option> 
		<option value="ro">Rondônia</option> 
		<option value="rs">Rio Grande do Sul</option> 
		<option value="rr">Roraima</option> 
		<option value="sc">Santa Catarina</option> 
		<option value="se">Sergipe</option> 
		<option value="sp">São Paulo</option> 
		<option value="to">Tocantins</option> </br></td></tr>
	</select>
   <tr>
    <td><label for="cep"> CEP: </label></td>
    <td><input type="cep" name="cep" id="cep"/></br></td> 
   </tr>
   <tr>
    <td><label for="telefone">Telefone:</label></td>	
    <td><input type="tel" name="fone" id="telefone" required/></br></td>
   		
    <td><label for="fax"> Fax: </label>
  <input type="fax" name="fax" id="fax"/></td>
   	  </tr>
    <tr>
    <td><label for="email">Email:</label></td>
   <td><input type="email" name="email_usuario" id="email" required/></br></td>
   </tr>
   <tr>
	<td> <label for="assunto"> Assunto: </label></td>
	<td><select name="assunto" required> 
		<option value="estado">Selecione o assunto </option> 
		<option value="ac">Sugest&atilde;o</option> 
		<option value="am">Elogios</option> 
		<option value="ap">Reclamaç&atilde;o</option>
        <option value="ap">Outros;</option>
        </select></br></td></tr>
	<tr>
    <td><label for="fale">Fale conosco: </label> </br></td>
   	<td><textarea name="fale_conosco" rows="5" cols="20"> </textarea></br></td>
      </tr>
       <tr>  
          <td colspan="3"><input type="submit" value="ENVIAR"/>&nbsp;<input type="reset" value="APAGAR"/></td></tr>           
                    
    
    
    </fieldset>
</form>

        </div>

    </div>

</body>
  </html>