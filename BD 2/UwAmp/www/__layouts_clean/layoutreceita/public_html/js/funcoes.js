var foco = "";
var msgstatus = "";

/*************************************************
	Função que permitir digitar numeros 
**************************************************/
function EntradaNumerico(evt) {

    var key_code = evt.keyCode  ? evt.keyCode  :
                   evt.charCode ? evt.charCode :
                   evt.which    ? evt.which    : void 0;

                   
        // Habilita teclas <DEL>, <TAB>, <ENTER>, <ESC> e <BACKSPACE>
        if (key_code == 8  ||  key_code == 9  ||  key_code == 13  ||  key_code == 27  ||  key_code == 46) {
            return true;
        }
        // Habilita teclas <HOME>, <END>, mais as quatros setas de navegação (cima, baixo, direta, esquerda)
        else if ((key_code >= 35)  &&  (key_code <= 40)) {
            return true
        }
        // Habilita números de 0 a 9
        // 48 a 57 são os códigos para números
        else if ((key_code >= 48)  &&  (key_code <= 57)) {
            return true
        }
        return false;
}


function Alertar(strMsg) {
    window.alert(strMsg)
}

function aviso (campo, msg)
{   
    alert(msg);
    campo.focus();
    campo.select();
    return false;
}

function SaltaCampo (campo, prox, tammax, teclapres) {
   var tecla = teclapres.keyCode;
   vr = campo.value;
   tam = vr.length;

   if (tecla != 0 && tecla != 10 && tecla != 24)
      if (tam == tammax){
          prox.focus(); }
}

//-------------------------------
function isDigit (c)
{     
   return ((c >= "0") && (c <= "9"))
}  

//-------------------------------
function isEmpty(s)
{
   return ((s == null) || (s.length == 0))
}

//Verifica se CPF é válido
function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;   
    //strCPF  = RetiraCaracteresInvalidos(strCPF,11);
    if (strCPF == "00000000000")
	return false;
    for (i=1; i<=9; i++)
	Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i); 
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11)) 
	Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) )
	return false;
	Soma = 0;
    for (i = 1; i <= 10; i++)
       Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11)) 
	Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) )
        return false;
    return true;
}

// Recupera uma referência ao objeto com o id especificado
// Funciona primariamente com o DOM, mas também aceita document.all
function pegaObj( id ) {
	if ( typeof(document.getElementById) != 'undefined' )
		return document.getElementById( id );
	else if ( document.all ) {
		return document.all( id );
	}
}


// Função chamada no evento onKeyDown para evitar que caracteres não numéricos
// sejam inseridos no campo indicado.
// Parâmetros:
// input: referência para o objeto <input> que recebeu o evento
// e: o objeto event
function ajustar_numero(input, e) {

	var k;

	// e.which: explorer, e.keyCode: mozilla
	if (e && e.which)
		k = e.which;
	else
		k = e.keyCode;
				
	// No IE não essa função não consegue cancelar tabs, BS, DEL, etc, mas no mozilla sim,
	// por isso precisamos deixar passar as teclas de edição.
	// Somente aceita os caracteres 0-9, tab, enter, del e BS
	if ( ((k<48)||(k>57)) && k != 8 && k != 9 && k != 127 && k != 13 && !((k>34)&&(k<41)) && k != 46) {
        if(e.ctrlKey && (k == 118 ||k == 99)) {
            return true;
        }	
        else
        {
            e.returnValue = false;
		    return false;
        }	
	}

	return true;
}


// Função específica do IE, que busca as informações do evento
// e repassa para as rotina em si "ajustar_numero" e "pular_campo"
function ajustar_numeroie() {

	e = window.event;
	input = pegaObj( e.srcElement.id );

	return ajustar_numero( input, e );
	
}

function pular_campoie() {

	e = window.event;
	input = pegaObj( e.srcElement.id );

	return pular_campo( input, e );
	
}

// Função que registra os inputs que precisam ser numéricos e que têm
// um tamanho fixo que, quando alcançado, muda para o próximo campo.
// Parâmetros:
// id: id do <input> que deve capturar os eventos de tecla
// tamanhoMaximo: o número de dígitos máximo para este campo
// proximoId: id do próximo campo no formulário para o qual pularemos quando
//            o número máximo de dígitos for alcançado.
var inputList = new Array();
function registraInput( id, tamanhoMaximo, proximoId ) {

	inputList[id] = new Array();
	inputList[id]['tamanho'] = tamanhoMaximo;
	inputList[id]['proximo'] = proximoId;

	// No IE não funciona setar o atributo via DOM, e o evento não vem como parâmetro
	// portanto precisamos setar uma função diferente para ele
	pegaObj(id).onkeyup = pular_campoie;
	pegaObj(id).onkeypress = ajustar_numeroie;
	
	// O mozilla também aceita a linha anterior, mas aqui nós passamos por cima e
	// chamamos a função diretamente
	pegaObj(id).setAttribute( 'onKeyUp', 'pular_campo(this, event)');
	pegaObj(id).setAttribute( 'onKeyPress', 'return ajustar_numero(this,event)');

}


function validarCPF(cpf) {
	var form = pegaObj("theForm");
	if (pegaObj("id_cpf").value == "") {
	    alert("Por favor, preencha o cpf a ser consultado");	
		pegaObj("id_cpf").focus();
	    return;
	}
}

