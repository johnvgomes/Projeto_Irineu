var ajax = new XMLHttpRequest();

function isEmpty(data) {
    if (typeof data == 'undefined' || data === null || data === '')
        return true;
    if (typeof data == 'number' && isNaN(data))
        return true;
    if (data instanceof Date && isNaN(Number(data)))
        return true;
    return false;
}

function paginar(table, name, like, pg, order) {
    ajax.open("POST", "ajax/paginar.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var str = ajax.responseText;

            var infoTable = document.getElementsByClassName("infoTable")[0];
            while (infoTable.lastChild.hasChildNodes()) {
                infoTable.lastChild.removeChild(infoTable.lastChild.lastChild);
            }

            var div = document.createElement("div");
            div.className = 'imgLoading';

            var img = document.createElement("img");
            img.src = '../img/loading.gif';

            div.appendChild(img);
            infoTable.parentNode.insertBefore(div, infoTable.nextSibling);


            var num = str.split("/^pg=")[1].split("$/")[0];
            var max = str.split("/^max=")[1].split("$/")[0];

            var numero = document.getElementsByClassName("numero")[0];
            numero.value = num;
            numero.max = max;

            var maximo = document.getElementsByClassName("maximo")[0];

            var txt = document.createTextNode(max);

            while (maximo.hasChildNodes()) {
                maximo.removeChild(maximo.lastChild);
            }

            maximo.appendChild(txt);

            if (parseInt(num) != parseInt(max)) {
                $('.after').css('visibility', 'visible');
            } else {
                $('.after').css('visibility', 'hidden');
            }

            if (parseInt(num) != 1) {
                $('.before').css('visibility', 'visible');
            } else {
                $('.before').css('visibility', 'hidden');
            }

            consultar(table, name, like, pg, order);
        }
    };
    ajax.send(
            "table=" + table + "&" +
            "name=" + name + "&" +
            "like=" + like + "&" +
            "pg=" + pg
            );
}

function consultar(table, name, like, pg, order) {
    ajax.open("POST", "ajax/consultar.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var infoTable = document.getElementsByClassName("infoTable")[0];
            infoTable.removeChild(infoTable.lastChild);

            var tbody = document.createElement("tbody");
            tbody.innerHTML = ajax.responseText;

            infoTable.appendChild(tbody);

            $('.imgLoading').remove();
        }
    };
    ajax.send(
            "table=" + table + "&" +
            "name=" + name + "&" +
            "like=" + like + "&" +
            "pg=" + pg + "&" +
            "order=" + order
            );
}

function admParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Admin';
    var name = 'a.nome';
    var like = document.getElementById("admSearch").value;
    var pg = parseInt(document.getElementById("admNumber").value) + parseInt(nav);
    var order = document.getElementById("admOrder").value;

    paginar(table, name, like, pg, order);
}

function catParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Categorias';
    var name = 'c.nome';
    var like = document.getElementById("catSearch").value;
    var pg = parseInt(document.getElementById("catNumber").value) + parseInt(nav);
    var order = document.getElementById("catOrder").value;

    paginar(table, name, like, pg, order);
}

function clieParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Clientes';
    var name = 'cl.nome';
    var like = document.getElementById("clieSearch").value;
    var pg = parseInt(document.getElementById("clieNumber").value) + parseInt(nav);
    var order = document.getElementById("clieOrder").value;

    paginar(table, name, like, pg, order);
}

function marParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Marcas';
    var name = 'm.nome';
    var like = document.getElementById("marSearch").value;
    var pg = parseInt(document.getElementById("marNumber").value) + parseInt(nav);
    var order = document.getElementById("marOrder").value;

    paginar(table, name, like, pg, order);
}

function prodParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Produtos';
    var name = 'p.nome';
    var like = document.getElementById("prodSearch").value;
    var pg = parseInt(document.getElementById("prodNumber").value) + parseInt(nav);
    var order = document.getElementById("prodOrder").value;

    paginar(table, name, like, pg, order);
}

function scatParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Subcategorias';
    var name = 's.nome';
    var like = document.getElementById("scatSearch").value;
    var pg = parseInt(document.getElementById("scatNumber").value) + parseInt(nav);
    var order = document.getElementById("scatOrder").value;

    paginar(table, name, like, pg, order);
}

function txtParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Textos';
    var name = 't.titulo';
    var like = document.getElementById("txtSearch").value;
    var pg = parseInt(document.getElementById("txtNumber").value) + parseInt(nav);
    var order = document.getElementById("txtOrder").value;

    paginar(table, name, like, pg, order);
}

function tipParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Tipospagamento';
    var name = 'tp.nome';
    var like = document.getElementById("tipSearch").value;
    var pg = parseInt(document.getElementById("tipNumber").value) + parseInt(nav);
    var order = document.getElementById("tipOrder").value;

    paginar(table, name, like, pg, order);
}

function vendParam(nav) {
    if (isEmpty(nav)) {
        nav = 0;
    }

    var table = 'Vendas';
    var name = 'v.data';
    var like = document.getElementById("vendSearch").value;
    var pg = parseInt(document.getElementById("vendNumber").value) + parseInt(nav);
    var order = document.getElementById("vendOrder").value;

    paginar(table, name, like, pg, order);
}

window.onload = function() {
    //admin

    if (document.getElementById("admOrder")) {
        document.getElementById("admOrder").onchange = function() {
            admParam();
        };
    }

    if (document.getElementById("admSearch")) {
        document.getElementById("admSearch").onkeyup = function() {
            admParam();
        };

        document.getElementById("admSearch").onblur = function() {
            admParam();
        };
    }

    if (document.getElementById("admNumber")) {
        document.getElementById("admNumber").onblur = function() {
            admParam();
        };
    }

    if (document.getElementById("admBefore")) {
        document.getElementById("admBefore").onclick = function() {
            admParam(-1);
        };
    }

    if (document.getElementById("admAfter")) {
        document.getElementById("admAfter").onclick = function() {
            admParam(1);
        };
    }

    //categorias

    if (document.getElementById("catOrder")) {
        document.getElementById("catOrder").onchange = function() {
            catParam();
        };
    }

    if (document.getElementById("catSearch")) {
        document.getElementById("catSearch").onkeyup = function() {
            catParam();
        };

        document.getElementById("catSearch").onblur = function() {
            catParam();
        };
    }

    if (document.getElementById("catNumber")) {
        document.getElementById("catNumber").onblur = function() {
            catParam();
        };
    }

    if (document.getElementById("catBefore")) {
        document.getElementById("catBefore").onclick = function() {
            catParam(-1);
        };
    }

    if (document.getElementById("catAfter")) {
        document.getElementById("catAfter").onclick = function() {
            catParam(1);
        };
    }

    //clientes

    if (document.getElementById("clieOrder")) {
        document.getElementById("clieOrder").onchange = function() {
            clieParam();
        };
    }

    if (document.getElementById("clieSearch")) {
        document.getElementById("clieSearch").onkeyup = function() {
            clieParam();
        };

        document.getElementById("clieSearch").onblur = function() {
            clieParam();
        };
    }

    if (document.getElementById("clieNumber")) {
        document.getElementById("clieNumber").onblur = function() {
            clieParam();
        };
    }

    if (document.getElementById("clieBefore")) {
        document.getElementById("clieBefore").onclick = function() {
            clieParam(-1);
        };
    }

    if (document.getElementById("clieAfter")) {
        document.getElementById("clieAfter").onclick = function() {
            clieParam(1);
        };
    }

    //marcas

    if (document.getElementById("marOrder")) {
        document.getElementById("marOrder").onchange = function() {
            marParam();
        };
    }

    if (document.getElementById("marSearch")) {
        document.getElementById("marSearch").onkeyup = function() {
            marParam();
        };

        document.getElementById("marSearch").onblur = function() {
            marParam();
        };
    }

    if (document.getElementById("marNumber")) {
        document.getElementById("marNumber").onblur = function() {
            marParam();
        };
    }

    if (document.getElementById("marBefore")) {
        document.getElementById("marBefore").onclick = function() {
            marParam(-1);
        };
    }

    if (document.getElementById("marAfter")) {
        document.getElementById("marAfter").onclick = function() {
            marParam(1);
        };
    }

    //produtos

    if (document.getElementById("prodOrder")) {
        document.getElementById("prodOrder").onchange = function() {
            prodParam();
        };
    }

    if (document.getElementById("prodSearch")) {
        document.getElementById("prodSearch").onkeyup = function() {
            prodParam();
        };

        document.getElementById("prodSearch").onblur = function() {
            prodParam();
        };
    }

    if (document.getElementById("prodNumber")) {
        document.getElementById("prodNumber").onblur = function() {
            prodParam();
        };
    }

    if (document.getElementById("prodBefore")) {
        document.getElementById("prodBefore").onclick = function() {
            prodParam(-1);
        };
    }

    if (document.getElementById("prodAfter")) {
        document.getElementById("prodAfter").onclick = function() {
            prodParam(1);
        };
    }

    //subcategorias

    if (document.getElementById("scatOrder")) {
        document.getElementById("scatOrder").onchange = function() {
            scatParam();
        };
    }

    if (document.getElementById("scatSearch")) {
        document.getElementById("scatSearch").onkeyup = function() {
            scatParam();
        };

        document.getElementById("scatSearch").onblur = function() {
            scatParam();
        };
    }

    if (document.getElementById("scatNumber")) {
        document.getElementById("scatNumber").onblur = function() {
            scatParam();
        };
    }

    if (document.getElementById("scatBefore")) {
        document.getElementById("scatBefore").onclick = function() {
            scatParam(-1);
        };
    }

    if (document.getElementById("scatAfter")) {
        document.getElementById("scatAfter").onclick = function() {
            scatParam(1);
        };
    }

    //textos

    if (document.getElementById("txtOrder")) {
        document.getElementById("txtOrder").onchange = function() {
            txtParam();
        };
    }

    if (document.getElementById("txtSearch")) {
        document.getElementById("txtSearch").onkeyup = function() {
            txtParam();
        };

        document.getElementById("txtSearch").onblur = function() {
            txtParam();
        };
    }

    if (document.getElementById("txtNumber")) {
        document.getElementById("txtNumber").onblur = function() {
            txtParam();
        };
    }

    if (document.getElementById("txtBefore")) {
        document.getElementById("txtBefore").onclick = function() {
            txtParam(-1);
        };
    }

    if (document.getElementById("txtAfter")) {
        document.getElementById("txtAfter").onclick = function() {
            txtParam(1);
        };
    }

    //tipospagamento

    if (document.getElementById("tipOrder")) {
        document.getElementById("tipOrder").onchange = function() {
            tipParam();
        };
    }

    if (document.getElementById("tipSearch")) {
        document.getElementById("tipSearch").onkeyup = function() {
            tipParam();
        };

        document.getElementById("tipSearch").onblur = function() {
            tipParam();
        };
    }

    if (document.getElementById("tipNumber")) {
        document.getElementById("tipNumber").onblur = function() {
            tipParam();
        };
    }

    if (document.getElementById("tipBefore")) {
        document.getElementById("tipBefore").onclick = function() {
            tipParam(-1);
        };
    }

    if (document.getElementById("tipAfter")) {
        document.getElementById("tipAfter").onclick = function() {
            tipParam(1);
        };
    }

    //vendas

    if (document.getElementById("vendOrder")) {
        document.getElementById("vendOrder").onchange = function() {
            vendParam();
        };
    }

    if (document.getElementById("vendSearch")) {
        document.getElementById("vendSearch").onkeyup = function() {
            vendParam();
        };

        document.getElementById("vendSearch").onblur = function() {
            vendParam();
        };
    }

    if (document.getElementById("vendNumber")) {
        document.getElementById("vendNumber").onblur = function() {
            vendParam();
        };
    }

    if (document.getElementById("vendBefore")) {
        document.getElementById("vendBefore").onclick = function() {
            vendParam(-1);
        };
    }

    if (document.getElementById("vendAfter")) {
        document.getElementById("vendAfter").onclick = function() {
            vendParam(1);
        };
    }
};