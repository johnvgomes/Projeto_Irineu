<?php
include_once '../class/Url.php';
$url = new Url();
?>

<html>
    <head>
        <?php include_once 'head.php'; ?>
    </head>

<link href="../css/editar_perfil.css" type="text/css" rel="stylesheet">

<link href="../css/login.css" type="text/css" rel="stylesheet">

<link href="../css/novaconta.css" type="text/css" rel="stylesheet">
<script src="../js/MascaraValidacao.js" type="text/javascript"></script>
<body>
    <img class="logo" src="../imagem/ICON CHECKIT/Logo/Logo_CCCCCC_G.png"/>


<div id="comentario_text">
    <h2 class="apenas_uma_conta_text"> Com apenas uma conta,</h2>
</div>
<div id="comentario_text2">
    <h2 class = "organize_text"> organize melhor seu tempo, e 
        <br>viva intensamente cada momento
        <br>que a vida tem a oferecer</h2>
</div>


<div class="geral">
    <div id="site">
        <div class="contenido">
            <div id="conteudo_form_perfil">
                <form name="formnovaconta" method="post" action="">
 		
                    <input placeholder="Nome" name="nome" type="text" title="Insira seu Nome aqui" 
                           value="" size="40" maxlength="50">

                    <input placeholder="Sobrenome" name="sobrenome" type="text"  title="Insira seu Sobrenome aqui" 
                           value="" size="40" maxlength="50">
                           
                           
                    <input placeholder="N&uacute;mero do celular" name="num_celular" type="text" title="Insira seu celular com DDD e digito 9" 
                    		value="" size="40" maxlength="15">

                      <select name="uf">
                        <option selected value="UF">UF</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PR">PR</option>
                        <option value="PB">PB</option>
                        <option value="PA">PA</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SE">SE</option>
                        <option value="SP">SP</option>
                        <option value="TO">TO</option>
                       
                    </select>

                           
                    <input placeholder="Cidade" name="cidade" type="text" title="Insira sua cidade" 
                           value="" size="40" maxlength="15">

                    <input placeholder="E-mail" name="email" type="email" title="Insira seu E-mail aqui" 
                           value="" size="40" maxlength="100">
                    
                    <input placeholder="Nova Senha" name="senha" type="password" id="senha" title="Insira sua senha aqui"
                       value="" size="40" maxlength="20">
                    
                    <input placeholder="Repita Senha" name="repitasenha" type="password" id="repitasenha" title="Repita sua senha aqui"
                       value="" size="40" maxlength="20">

                    <!--
                                        <input placeholder="Repita seu E-mail" name="txtemail_conferencia" type="email" id="search-text" title="Insira seu E-mail aqui" 
                                               value="" size="40" maxlength="100">
                    -->
                    
                    <select name="dia_nasc">
                        <option selected value="Dia">Dia</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>

                    </select>


                    <select name="mes_nasc"   >
                        <option selected value="Mes">M&ecirc;s</option>
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>

                    </select>


                    <select name="ano_nasc" id="cboanonasc"  >
                        <option selected value="Ano">Ano</option>
                        <option value="1895">1895</option>
                        <option value="1896">1896</option>
                        <option value="1897">1897</option>
                        <option value="1898">1898</option>
                        <option value="1899">1899</option>
                        <option value="1900">1900</option>
                        <option value="1901">1901</option>
                        <option value="1902">1902</option>
                        <option value="1903">1903</option>
                        <option value="1904">1904</option>
                        <option value="1905">1905</option>
                        <option value="1906">1906</option>
                        <option value="1907">1907</option>
                        <option value="1908">1908</option>
                        <option value="1909">1909</option>
                        <option value="1910">1910</option>
                        <option value="1911">1911</option>
                        <option value="1912">1912</option>
                        <option value="1913">1913</option>
                        <option value="1914">1914</option>
                        <option value="1915">1915</option>
                        <option value="1916">1916</option>
                        <option value="1917">1917</option>
                        <option value="1918">1918</option>
                        <option value="1919">1919</option>
                        <option value="1920">1920</option>
                        <option value="1921">1921</option>
                        <option value="1922">1922</option>
                        <option value="1923">1923</option>
                        <option value="1924">1924</option>
                        <option value="1925">1925</option>
                        <option value="1926">1926</option>
                        <option value="1927">1927</option>
                        <option value="1928">1928</option>
                        <option value="1929">1929</option>
                        <option value="1930">1930</option>
                        <option value="1931">1931</option>
                        <option value="1932">1932</option>
                        <option value="1933">1933</option>
                        <option value="1934">1934</option>
                        <option value="1935">1935</option>
                        <option value="1936">1936</option>
                        <option value="1937">1937</option>
                        <option value="1938">1938</option>
                        <option value="1939">1939</option>
                        <option value="1940">1940</option>
                        <option value="1941">1941</option>
                        <option value="1942">1942</option>
                        <option value="1943">1943</option>
                        <option value="1944">1944</option>
                        <option value="1945">1945</option>
                        <option value="1946">1946</option>
                        <option value="1947">1947</option>
                        <option value="1948">1948</option>
                        <option value="1949">1949</option>
                        <option value="1950">1950</option>
                        <option value="1951">1951</option>
                        <option value="1952">1952</option>
                        <option value="1943">1953</option>
                        <option value="1954">1954</option>
                        <option value="1955">1955</option>
                        <option value="1956">1956</option>
                        <option value="1957">1957</option>
                        <option value="1958">1958</option>
                        <option value="1959">1959</option>
                        <option value="1960">1960</option>
                        <option value="1961">1961</option>
                        <option value="1962">1962</option>
                        <option value="1963">1963</option>
                        <option value="1964">1964</option>
                        <option value="1965">1965</option>
                        <option value="1966">1966</option>
                        <option value="1967">1967</option>
                        <option value="1968">1968</option>
                        <option value="1969">1969</option>
                        <option value="1970">1970</option>
                        <option value="1971">1971</option>
                        <option value="1972">1972</option>
                        <option value="1973">1973</option>
                        <option value="1974">1974</option>
                        <option value="1975">1975</option>
                        <option value="1976">1976</option>
                        <option value="1977">1977</option>
                        <option value="1978">1978</option>
                        <option value="1979">1979</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>



<br>

                    </select>
 					
                    
 					<input name="sexo" value="Feminino"  type="RADIO"> Feminino  &nbsp; &nbsp;
                    <input name="sexo" value="Masculino"   type="RADIO"> Masculino <br>
 					
                  
                    <input name="enviar" type="submit" id="Enviar" value="Cadastrar">
                    <div id="cancelar_conta">

                        <link href="../index.php"  />
                        <a href="../login.php"> <h2 class="cancelarconta_text">Cancelar Nova Conta</h2></a>


                    </div>
                </form>
            </div>

        </div>

    </div>


</div>

<?php
     
if (isset($_POST['enviar']) && !empty($_POST['nome']) && !empty($_POST['sobrenome'])) {



    extract($_POST, EXTR_OVERWRITE);
if($_POST['senha']!= $_POST['repitasenha']){
         
         
          echo  ' <div id="senha_incorreto">'
            . '<h3 class="senha_incorreto">Senhas não coincidem!</h3>'
            . '<h3 class="senha_incorreto_verifique">Por favor verifique o campo senha e repita senha e tente novamente</h3>'
            . '</div>';
         
     }
 if($_POST['dia_nasc']==29 && $_POST['mes_nasc']==2 ){
             
                echo  ' <div id="data_incorreto">'
            . '<h3 class="data_incorreto">Data Incorreta!</h3>'
            . '<h3 class="data_incorreto_verifique">Por favor verifique o campo dia e mês.<br><br> Fevereiro só têm 28 dias</h3>'
            . '</div>';
                
                
            }
        else{
            
            if($_POST['dia_nasc']==29 && $_POST['mes_nasc']==2 || $_POST['dia_nasc']==30 && $_POST['mes_nasc']==2 || $_POST['dia_nasc']==31 && $_POST['mes_nasc']==2){
             
                echo  ' <div id="data_incorreto">'
            . '<h3 class="data_incorreto">Data Incorreta!</h3>'
            . '<h3 class="data_incorreto_verifique">Por favor verifique o campo dia e mês.<br><br> Fevereiro só têm 28 dias</h3>'
            . '</div>';
                
                
            }
            
            else{
           
            
    require_once '../class/Usuario.php';
    
        
    $u = new Usuario("", $_POST['email'], $_POST['senha'], "");
    $u->setEmail($email);
    if ($u->consultarEmail() != 1) {
        $u->setAcesso((int) 0);
        $u->setNome(strtr(strtoupper($nome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $u->setSobrenome(strtr(strtoupper($sobrenome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $u->setNum_celular($num_celular);
        $u->setUf($uf);
        $u->setCidade(strtr(strtoupper($cidade), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $u->setEmail($email);
        $u->setSenha($senha);
        $u->setDia_nasc((int) $dia_nasc);
        $u->setMes_nasc((int) $mes_nasc);
        $u->setAno_nasc((int) $ano_nasc);
        $u->setSexo($sexo);
        $u->setEmpresa("Nao");
        
         
      //  echo "$u <br> $nome <br> $sobrenome <br> $num_celular <br> $uf <br> $cidade <br> $email <br> $senha <br> $dia_nasc <br> $mes_nasc <br>  $ano_nasc <br> $sexo <br>";
             
       $u->salvar();
    } else {
        echo  ' <div id="email_incorreto">'
            . '<h3 class="email_incorreto">Email já cadastrado!</h3>'
            . '<h3 class="email_incorreto_verifique">Por favor digite outro endereço de e-mail</h3>'
            . '</div>';
    }
}
}
}
    
?>
   </body>
</html>