
//abre a div com o conteudo e a div de fora

function abreconfig(){
document.getElementById('div1').style.display = "block";
document.getElementById('config').style.display = "block";
}

function abremenu(){
document.getElementById('div1').style.display = "block";
document.getElementById('menu').style.display = "block";
}
//fecha a div com o conteudo e a div de fora
function fecha(){
document.getElementById('div1').style.display = "none";
document.getElementById('menu').style.display = "none";
document.getElementById('config').style.display = "none";
document.getElementById('boasvindas').style.display = "none";
}

var mais = '../imagem/favoritocinza.png';  
var menos = '../imagem/favorito.png';  
      
      
    function troca( el, obj )  
    {  
        if( el.alt==mais )  
        {  
            el.src = menos;  
            el.alt = menos;  
            id( obj ).src = mais;  
            id( obj ).alt = mais;  
        }  
        else  
        {  
            el.src = mais;  
            el.alt = mais;  
            id( obj ).src = menos;  
            id( obj ).alt = menos;  
        }  
    }  
    function id( el ){  
        return document.getElementById( el );  
    }  
			
