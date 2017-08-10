/*Mascaras ER*/
function mascara(o,f){
	v_obj=o
	v_fun=f
	setTimeout("execmascara()",1)
}
function execmascara(){
	v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
	v=v.replace(/D/g,"");  //remove tudo que não é digito
	v=v.replace(/^(d{2})(d)/g,"($1) $2"); //coloca os doi primeiros numeros em parenteses
	v=v.replace(/(d)(d{4})$/,"$1-$2"); //coloca hífen entre os 8 dígitos
	return v;
}

function id( el ){
	return document.getElementById( el );
}
window.onload = function(){
	id('telefone').onkeypressed = function(){
		mascara (this, mtel);
	}
}