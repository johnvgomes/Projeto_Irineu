var ajax = new XMLHttpRequest();
var BASEURL = 'http://localhost/BuyOn/';

function isEmpty(data) {
    if (typeof data == 'undefined' || data === null || data === '')
        return true;
    if (typeof data == 'number' && isNaN(data))
        return true;
    if (data instanceof Date && isNaN(Number(data)))
        return true;
    return false;
}

function mostrarTudo() {
    var produtos = document.getElementsByClassName('produtoPre');

    for (var i = 0; i < produtos.length; i++) {
        produtos[i].style.display = 'initial';
    }

    $('#moreResult').remove();
}

function maisRes() {
    var produtos = document.getElementsByClassName('produtoPre');
    var i = 0;
    var j = 0;

    while (i < produtos.length && j < 20) {
        if (produtos[i].style.display == 'none') {
            produtos[i].style.display = 'initial';
            j++;
        }
        i++;
    }

    if (i == produtos.length) {
        $('#moreResult').remove();
    }
}

function ordem() {
    var input = document.getElementById("ordem");
    return input.value;
}

function preco() {
    var chkbox = document.getElementsByClassName("preco");
    var i = 0;
    var str = '';
    var first = true;

    while (i < chkbox.length) {
        if (chkbox[i].checked == true) {
            if (first) {
                str += chkbox[i].value;
                first = false;
            } else {
                str += ';' + chkbox[i].value;
            }
        }
        i++;
    }

    return str;
}

function marca() {
    var chkbox = document.getElementsByClassName("marca");
    var i = 0;
    var str = '';
    var first = true;

    while (i < chkbox.length) {
        if (chkbox[i].checked == true) {
            if (first) {
                str += chkbox[i].value;
                first = false;
            } else {
                str += ';' + chkbox[i].value;
            }
        }
        i++;
    }

    return str;
}

function tabela() {
    if (!isEmpty(document.getElementById("categoFilt"))) {
        return 'Categorias';
    }

    if (!isEmpty(document.getElementById("subcategoFilt"))) {
        return 'Subcategorias';
    }

    if (!isEmpty(document.getElementById("buscaFilt"))) {
        return 'Buscar';
    }
}

function arg() {
    return document.getElementById("resultTitle").className;
}

function numReg() {
    preenchePreco();
    preencheMarca();

    if (typeof (FormData) == 'undefined') {
        var formData = new FormDataCompatibility();
    } else {
        var formData = new FormData();
    }

    formData.append('ordem', ordem());
    formData.append('preco', preco());
    formData.append('marca', marca());
    formData.append('tabela', tabela());
    formData.append('arg', arg());

    ajax.open("POST", BASEURL + "ajax/numReg.php", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var txt = ajax.responseText;
            var resNum = document.getElementById("resNum");

            while (resNum.hasChildNodes()) {
                resNum.removeChild(resNum.lastChild);
            }

            if (parseInt(txt) > 20) {
                var reg = document.createTextNode(txt + ' registro(s) - ')

                var a = document.createElement('a');
                a.id = 'showAll';
                a.onclick = function() {
                    mostrarTudo();
                };

                var showAll = document.createTextNode('Mostrar tudo');
                a.appendChild(showAll);

                resNum.appendChild(reg);
                resNum.appendChild(a);
            } else {
                var reg = document.createTextNode(txt + ' registro(s)');
                resNum.appendChild(reg);
            }

            $('#moreResult').remove();

            filtrar(formData);
        }
    };

    if (typeof (FormData) == 'undefined') {
        formData.setContentTypeHeader(ajax);
        ajax.sendAsBinary(formData.buildBody());
    } else {
        ajax.send(formData);
    }
}

function filtrar(formData) {
    ajax.open("POST", BASEURL + "ajax/filtrar.php", true);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var txt = ajax.responseText;
            var resultBox = document.getElementById("resultBox");

            while (resultBox.hasChildNodes()) {
                resultBox.removeChild(resultBox.lastChild);
            }

            resultBox.innerHTML = txt;
        }
    };

    if (typeof (FormData) == 'undefined') {
        formData.setContentTypeHeader(ajax);
        ajax.sendAsBinary(formData.buildBody());
    } else {
        ajax.send(formData);
    }
}

function switchPrecos() {
    var precos = document.getElementsByClassName("preco");
    var i = 0;

    if (isEmpty(precos[0].parentNode.style.display) || precos[0].parentNode.style.display == 'block') {
        while (i < precos.length) {
            precos[i].parentNode.style.display = 'none';
            i++;
        }
    } else {
        while (i < precos.length) {
            precos[i].parentNode.style.display = 'block';
            i++;
        }
    }
}

function switchMarcas() {
    var marcas = document.getElementsByClassName("marca");
    var i = 0;

    if (isEmpty(marcas[0].parentNode.style.display) || marcas[0].parentNode.style.display == 'block') {
        while (i < marcas.length) {
            marcas[i].parentNode.style.display = 'none';
            i++;
        }
    } else {
        while (i < marcas.length) {
            marcas[i].parentNode.style.display = 'block';
            i++;
        }
    }
}

function preenchePreco() {
    var precos = document.getElementsByClassName("preco");
    var i;
    var vazio = true;

    i = 0;
    while (i < precos.length) {
        if (precos[i].checked == true) {
            vazio = false;
        }
        i++;
    }

    if (vazio) {
        i = 0;
        while (i < precos.length) {
            precos[i].checked = true;
            i++;
        }
    }
}

function preencheMarca() {
    var marcas = document.getElementsByClassName("marca");
    var i;
    var vazio = true;

    i = 0;

    while (i < marcas.length) {
        if (marcas[i].checked == true) {
            vazio = false;
        }
        i++;
    }

    if (vazio) {
        i = 0;
        while (i < marcas.length) {
            marcas[i].checked = true;
            i++;
        }
    }
}

function activeImg() {
    var active = document.getElementsByClassName("imgActive")[0];
    var zoom = document.getElementById("imgZoom");

    zoom.src = active.src;
    zoom.alt = active.alt;
    zoom.title = active.title;

    $("#imgZoom").elevateZoom(
            {constrainType: "height", constrainSize: 274, zoomType: "lens", containLensZoom: true, gallery: 'gal1', cursor: 'pointer', galleryActiveClass: "active"}
    );
}

function excRemove(id) {
    var exc = document.getElementById(id);

    if (!isEmpty(exc)) {
        $(exc).remove();
    }
}

function localizar() {
    var cep = document.getElementById("txtCep").value;

    ajax.open("POST", BASEURL + "ajax/localizar.php", false);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var str = ajax.responseText;

            document.getElementsByName("cmbEstado")[0].id = str.split("/^uf=")[1].split("$/")[0];
            $('option[value="' + $('select').attr('id') + '"]').attr('selected', true);

            document.getElementsByName("txtCidade")[0].value = str.split("/^cidade=")[1].split("$/")[0];

            document.getElementsByName("txtBairro")[0].value = str.split("/^bairro=")[1].split("$/")[0];

            document.getElementsByName("txtEndereco")[0].value = str.split("/^endereco=")[1].split("$/")[0];
            document.getElementsByName("txtEndereco")[0].focus();
        }
    };
    ajax.send("cep=" + cep);
}

function login() {
    ajax.open("POST", BASEURL + "ajax/login.php", true);

    if (typeof (FormData) == 'undefined') {
        var formData = new FormDataCompatibility();
    } else {
        var formData = new FormData();
    }

    formData.append('emailCli', document.getElementById("loginEmail").value);
    formData.append('senhaCli', document.getElementById("loginSenha").value);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var txt = ajax.responseText;
            if (isEmpty(txt)) {
                location.reload();
            } else {
                if (isEmpty(document.getElementById("avisoLogin"))) {
                    var aviso = document.createElement("div");
                    aviso.id = 'avisoLogin';

                    var conteudo = document.createTextNode(txt);

                    aviso.appendChild(conteudo);
                    document.getElementById("formLogin").appendChild(aviso);
                }
            }
        }
    };

    if (typeof (FormData) == 'undefined') {
        formData.setContentTypeHeader(ajax);
        ajax.sendAsBinary(formData.buildBody());
    } else {
        ajax.send(formData);
    }
}

function favoritar(produto) {
    ajax.open("POST", BASEURL + "ajax/favoritar.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var str = ajax.responseText;
            if (str == 1) {
                $('.favoritar').addClass('favoritado');
            } else {
                $('.favoritar').removeClass('favoritado');
            }
        }
    };

    ajax.send("produto=" + produto);
}

function comprar(id) {
    ajax.open("POST", BASEURL + "ajax/comprar.php", false);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            location.href = BASEURL + "carrinho";
        }
    };

    ajax.send("id=" + id);
}

function carrinho(id) {
    ajax.open("POST", BASEURL + "ajax/comprar.php", false);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var str = ajax.responseText;
            var count = document.getElementById("countCarrinho");

            while (count.hasChildNodes()) {
                count.removeChild(count.lastChild);
            }

            var txt = document.createTextNode(str);
            count.appendChild(txt);
        }
    };

    ajax.send("id=" + id);
}

window.onload = function() {
    if (!isEmpty(document.getElementById("ordem"))) {
        document.getElementById("ordem").onchange = function() {
            numReg();
        };
    }

    if (!isEmpty(document.getElementsByClassName("preco"))) {
        var i = 0;
        while (i < document.getElementsByClassName("preco").length) {
            document.getElementsByClassName("preco")[i].onchange = function() {
                numReg();
            };
            i++;
        }
    }

    if (!isEmpty(document.getElementsByClassName("marca"))) {
        var i = 0;
        while (i < document.getElementsByClassName("marca").length) {
            document.getElementsByClassName("marca")[i].onchange = function() {
                numReg();
            };
            i++;
        }
    }

    if (!isEmpty(document.getElementById("labelPreco"))) {
        document.getElementById("labelPreco").onclick = function() {
            switchPrecos();
        };
    }

    if (!isEmpty(document.getElementById("labelMarca"))) {
        document.getElementById("labelMarca").onclick = function() {
            switchMarcas();
        };
    }
};