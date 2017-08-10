<?php
session_start();
if (!isset($_SESSION['session'])) {
    echo 'P&aacute;gina n&atilde;o encontrada!';
} else {
    require_once '../class/Marcas.php';
    require_once '../class/Controles.php';

    $m = new Marcas();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);

    $vetor = $m->carregar($id);
    ?>

    <form id="frmMar" action="" method="post" >
        <h1>Editar marca <?php echo $vetor[0]; ?></h1>
        <table>
            <tr>
                <td><label>Nome:</label></td>
                <td><input name="txtNome" type="text" maxlength="80" value="<?php echo $vetor[1]; ?>" autofocus /></td>
            </tr>
            <tr>
                <td><label>Pa&iacute;s de Origem:</label></td>
                <td><select name="cboOrigem" id="<?php echo $vetor[2]; ?>">
                        <option value="Brasil">Brasil</option>
                        <option value="Afeganistao">Afeganist&atilde;o</option>
                        <option value="Africa do Sul">&Aacute;frica do Sul</option>
                        <option value="Albania">Alb&acirc;nia</option>
                        <option value="Alemanha">Alemanha</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antilhas Holandesas">Antilhas Holandesas</option>
                        <option value="Antarctida">Ant&aacute;rctida</option>
                        <option value="Antigua e Barbuda">Ant&iacute;gua e Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Argelia">Arg&eacute;lia</option>
                        <option value="Armenia">Arm&ecirc;nia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Arabia Saudita">Ar&aacute;bia Saudita</option>
                        <option value="Australia">Austr&aacute;lia</option>
                        <option value="Austria">&Aacute;ustria</option>
                        <option value="Azerbaijao">Azerbaij&atilde;o</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrein">Bahrein</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belize">Belize</option>
                        <option value="Benim">Benim</option>
                        <option value="Bermudas">Bermudas</option>
                        <option value="Bielorrussia">Bielorr&uacute;ssia</option>
                        <option value="Bolivia">Bol&iacute;via</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgaria">Bulg&aacute;ria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Butao">But&atilde;o</option>
                        <option value="Belgica">B&eacute;lgica</option>
                        <option value="Bosnia e Herzegovina">B&oacute;snia e Herzegovina</option>
                        <option value="Cabo Verde">Cabo Verde</option>
                        <option value="Camaroes">Camar&otilde;es</option>
                        <option value="Camboja">Camboja</option>
                        <option value="Canada">Canad&aacute;</option>
                        <option value="Catar">Catar</option>
                        <option value="Cazaquistao">Cazaquist&atilde;o</option>
                        <option value="Chade">Chade</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Chipre">Chipre</option>
                        <option value="Colombia">Col&ocirc;mbia</option>
                        <option value="Comores">Comores</option>
                        <option value="Coreia do Norte">Coreia do Norte</option>
                        <option value="Coreia do Sul">Coreia do Sul</option>
                        <option value="Costa do Marfim">Costa do Marfim</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croacia">Cro&aacute;cia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Dinamarca">Dinamarca</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Egito">Egito</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Emirados Arabes Unidos">Emirados &Aacute;rabes Unidos</option>
                        <option value="Equador">Equador</option>
                        <option value="Eritreia">Eritreia</option>
                        <option value="Escocia">Esc&oacute;cia</option>
                        <option value="Eslovaquia">Eslov&aacute;quia</option>
                        <option value="Eslovenia">Eslov&ecirc;nia</option>
                        <option value="Espanha">Espanha</option>
                        <option value="Estados Federados da Micronesia">Estados Federados da Micron&eacute;sia</option>
                        <option value="Estados Unidos">Estados Unidos</option>
                        <option value="Estonia">Est&ocirc;nia</option>
                        <option value="Etiopia">Eti&oacute;pia</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Filipinas">Filipinas</option>
                        <option value="Finlandia">Finl&acirc;ndia</option>
                        <option value="Franca">Fran&ccedil;a</option>
                        <option value="Gabao">Gab&atilde;o</option>
                        <option value="Gana">Gana</option>
                        <option value="Georgia">Ge&oacute;rgia</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Granada">Granada</option>
                        <option value="Gronelandia">Gronel&acirc;ndia</option>
                        <option value="Grecia">Gr&eacute;cia</option>
                        <option value="Guadalupe">Guadalupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernesei">Guernesei</option>
                        <option value="Guiana">Guiana</option>
                        <option value="Guiana Francesa">Guiana Francesa</option>
                        <option value="Guine">Guin&eacute;</option>
                        <option value="Guine Equatorial">Guin&eacute; Equatorial</option>
                        <option value="Guine-Bissau">Guin&eacute;-Bissau</option>
                        <option value="Gambia">G&acirc;mbia</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungria">Hungria</option>
                        <option value="Ilha Bouvet">Ilha Bouvet</option>
                        <option value="Ilha de Man">Ilha de Man</option>
                        <option value="Ilha do Natal">Ilha do Natal</option>
                        <option value="Ilha Heard e Ilhas McDonald">Ilha Heard e Ilhas McDonald</option>
                        <option value="Ilha Norfolk">Ilha Norfolk</option>
                        <option value="Ilhas Cayman">Ilhas Cayman</option>
                        <option value="Ilhas Cocos (Keeling)">Ilhas Cocos (Keeling)</option>
                        <option value="Ilhas Cook">Ilhas Cook</option>
                        <option value="Ilhas Feroe">Ilhas Fero&eacute;</option>
                        <option value="Ilhas Georgia do Sul e Sandwich do Sul">Ilhas Ge&oacute;rgia do Sul e Sandwich do Sul</option>
                        <option value="Ilhas Malvinas">Ilhas Malvinas</option>
                        <option value="Ilhas Marshall">Ilhas Marshall</option>
                        <option value="Ilhas Menores Distantes dos Estados Unidos">Ilhas Menores Distantes dos Estados Unidos</option>
                        <option value="Ilhas Salomao">Ilhas Salom&atilde;o</option>
                        <option value="Ilhas Virgens Americanas">Ilhas Virgens Americanas</option>
                        <option value="Ilhas Virgens Britanicas">Ilhas Virgens Brit&acirc;nicas</option>
                        <option value="Ilhas Aland">Ilhas &Aring;land</option>
                        <option value="Indonesia">Indon&eacute;sia</option>
                        <option value="Inglaterra">Inglaterra</option>
                        <option value="India">&Iacute;ndia</option>
                        <option value="Iraque">Iraque</option>
                        <option value="Irlanda do Norte">Irlanda do Norte</option>
                        <option value="Irlanda">Irlanda</option>
                        <option value="Ira">Ir&atilde;</option>
                        <option value="Islandia">Isl&acirc;ndia</option>
                        <option value="Israel">Israel</option>
                        <option value="Italia">It&aacute;lia</option>
                        <option value="Iemen">I&ecirc;men</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japao">Jap&atilde;o</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordania">Jord&acirc;nia</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Laos">Laos</option>
                        <option value="Lesoto">Lesoto</option>
                        <option value="Letonia">Let&ocirc;nia</option>
                        <option value="Liberia">Lib&eacute;ria</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lituania">Litu&acirc;nia</option>
                        <option value="Luxemburgo">Luxemburgo</option>
                        <option value="Libano">L&iacute;bano</option>
                        <option value="Libia">L&iacute;bia</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedonia">Maced&ocirc;nia</option>
                        <option value="Madagascar">Madag&aacute;scar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Maldivas">Maldivas</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Malasia">Mal&aacute;sia</option>
                        <option value="Marianas Setentrionais">Marianas Setentrionais</option>
                        <option value="Marrocos">Marrocos</option>
                        <option value="Martinica">Martinica</option>
                        <option value="Mauritania">Maurit&acirc;nia</option>
                        <option value="Mauricia">Maur&iacute;cia</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Moldavia">Mold&aacute;via</option>
                        <option value="Mongolia">Mong&oacute;lia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Mocambique">Mo&ccedil;ambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Mexico">M&eacute;xico</option>
                        <option value="Monaco">M&ocirc;naco</option>
                        <option value="Namibia">Nam&iacute;bia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Nicaragua">Nicar&aacute;gua</option>
                        <option value="Nigeria">Nig&eacute;ria</option>
                        <option value="Niue">Niue</option>
                        <option value="Noruega">Noruega</option>
                        <option value="Nova Caledonia">Nova Caled&ocirc;nia</option>
                        <option value="Nova Zelandia">Nova Zel&acirc;ndia</option>
                        <option value="Niger">N&iacute;ger</option>
                        <option value="Oma">Om&atilde;</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestina">Palestina</option>
                        <option value="Panama">Panam&aacute;</option>
                        <option value="Papua-Nova Guine">Papua-Nova Guin&eacute;</option>
                        <option value="Paquistao">Paquist&atilde;o</option>
                        <option value="Paraguai">Paraguai</option>
                        <option value="Pais de Gales">Pa&iacute;s de Gales</option>
                        <option value="Paises Baixos">Pa&iacute;ses Baixos</option>
                        <option value="Peru">Peru</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Polinesia Francesa">Polin&eacute;sia Francesa</option>
                        <option value="Polonia">Pol&ocirc;nia</option>
                        <option value="Porto Rico">Porto Rico</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Quirguistao">Quirguist&atilde;o</option>
                        <option value="Quenia">Qu&ecirc;nia</option>
                        <option value="Reino Unido">Reino Unido</option>
                        <option value="Republica Centro-Africana">Rep&uacute;blica Centro-Africana</option>
                        <option value="Republica Checa">Rep&uacute;blica Checa</option>
                        <option value="Republica Democratica do Congo">Rep&uacute;blica Democr&aacute;tica do Congo</option>
                        <option value="Republica do Congo">Rep&uacute;blica do Congo</option>
                        <option value="Republica Dominicana">Rep&uacute;blica Dominicana</option>
                        <option value="Reuniao">Reuni&atilde;o</option>
                        <option value="Romenia">Rom&ecirc;nia</option>
                        <option value="Ruanda">Ruanda</option>
                        <option value="Russia">R&uacute;ssia</option>
                        <option value="Saara Ocidental">Saara Ocidental</option>
                        <option value="Saint Martin">Saint Martin</option>
                        <option value="Saint-Barthelemy">Saint-Barth&eacute;lemy</option>
                        <option value="Saint-Pierre e Miquelon">Saint-Pierre e Miquelon</option>
                        <option value="Samoa Americana">Samoa Americana</option>
                        <option value="Samoa">Samoa</option>
                        <option value="Santa Helena, Ascensao e Tristao da Cunha">Santa Helena, Ascens&atilde;o e Trist&atilde;o da Cunha</option>
                        <option value="Santa Lucia">Santa L&uacute;cia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serra Leoa">Serra Leoa</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Singapura">Singapura</option>
                        <option value="Somalia">Som&aacute;lia</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Suazilandia">Suazil&acirc;ndia</option>
                        <option value="Sudao">Sud&atilde;o</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Suecia">Su&eacute;cia</option>
                        <option value="Suica">Su&iacute;&ccedil;a</option>
                        <option value="Svalbard e Jan Mayen">Svalbard e Jan Mayen</option>
                        <option value="Sao Cristovao e Nevis">S&atilde;o Crist&oacute;v&atilde;o e Nevis</option>
                        <option value="Sao Marino">S&atilde;o Marino</option>
                        <option value="Sao Tome e Principe">S&atilde;o Tom&eacute; e Pr&iacute;ncipe</option>
                        <option value="Sao Vicente e Granadinas">S&atilde;o Vicente e Granadinas</option>
                        <option value="Servia">S&eacute;rvia</option>
                        <option value="Siria">S&iacute;ria</option>
                        <option value="Tadjiquistao">Tadjiquist&atilde;o</option>
                        <option value="Tailandia">Tail&acirc;ndia</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tanzania">Tanz&acirc;nia</option>
                        <option value="Terras Austrais e Antarticas Francesas">Terras Austrais e Ant&aacute;rticas Francesas</option>
                        <option value="Territorio Britanico do Oceano Indico">Territ&oacute;rio Brit&acirc;nico do Oceano &Iacute;ndico</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Toquelau">Toquelau</option>
                        <option value="Trinidad e Tobago">Trinidad e Tobago</option>
                        <option value="Tunisia">Tun&iacute;sia</option>
                        <option value="Turcas e Caicos">Turcas e Caicos</option>
                        <option value="Turquemenistao">Turquemenist&atilde;o</option>
                        <option value="Turquia">Turquia</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Ucrania">Ucr&acirc;nia</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Uruguai">Uruguai</option>
                        <option value="Uzbequistao">Uzbequist&atilde;o</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vaticano">Vaticano</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietname">Vietname</option>
                        <option value="Wallis e Futuna">Wallis e Futuna</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                        <option value="Zambia">Z&acirc;mbia</option>
                    </select></td>
            </tr>
            <tr>
                <td colspan="2" class="right"><input name="sbmEditar" type="submit" value="Editar" /></td>
            </tr>
        </table>
    </form>

    <script type="text/javascript">
        $('option[value="' + $('select').attr('id') + '"]').attr('selected', true);
    </script>

    <?php
    if (isset($_POST['sbmEditar'])) {
        if (!empty($_POST['txtNome'])) {

            extract($_POST, EXTR_OVERWRITE);


            $m->setId($id);
            $m->setNome($txtNome);
            $m->setOrigem($cboOrigem);
            $m->editar();

            header('Location:?p=marcas/consultar');
            echo '<meta http-equiv="refresh" content="1;URL=?p=marcas/consultar">';
        } else {
            echo 'Preencha todos os campos corretamente.';
        }
    }
}
?>