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



//Produtos

function Produtos(id, nome, preco, peso, estoque, descricao, destaque, id_marca, id_subcatego) {
    this.id = id;
    this.nome = nome;
    this.preco = preco;
    this.peso = peso;
    this.estoque = estoque;
    this.descricao = descricao;
    this.destaque = destaque;
    this.id_marca = id_marca;
    this.id_subcatego = id_subcatego;
}

function cadastrarProduto() {
    if (!isEmpty(document.getElementsByName("txtNome")[0].value) &&
            !isEmpty(document.getElementsByName("numPreco")[0].value) &&
            !isEmpty(document.getElementsByName("numPeso")[0].value) &&
            !isEmpty(document.getElementsByName("numEstoque")[0].value)) {

        if (verifEstoque()) {
            if (document.getElementById("resposta")) {
                var resposta = document.getElementById("resposta");
                while (resposta.hasChildNodes()) {
                    resposta.removeChild(resposta.lastChild);
                }
            }

            var p = new Produtos(
                    null,
                    document.getElementsByName("txtNome")[0].value,
                    priceUnformat(document.getElementsByName("numPreco")[0].value),
                    priceUnformat(document.getElementsByName("numPeso")[0].value),
                    document.getElementsByName("numEstoque")[0].value,
                    document.getElementsByName("txtDesc")[0].value,
                    document.getElementsByName("chkDest")[0].checked,
                    document.getElementsByName("cboMarca")[0].value,
                    document.getElementsByName("cboSubcat")[0].value
                    );

            if (typeof (FormData) == 'undefined') {
                var formData = new FormDataCompatibility();
            } else {
                var formData = new FormData();
            }

            formData.append('txtNome', p.nome);
            formData.append('numPreco', p.preco);
            formData.append('numPeso', p.peso);
            formData.append('numEstoque', p.estoque);
            formData.append('txtDesc', p.descricao);
            formData.append('chkDest', p.destaque);
            formData.append('cboMarca', p.id_marca);
            formData.append('cboSubcat', p.id_subcatego);

            ajax.open("POST", "produtos/ajax/inserir.php", false);

            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4) {
                    var txt = document.createTextNode(ajax.responseText);

                    if (!document.getElementById("resposta")) {
                        var p = document.createElement("p");
                        p.id = "resposta";

                        p.appendChild(txt);
                        document.getElementById("infoBox").appendChild(p);
                    } else {
                        resposta.appendChild(txt);
                    }

                    var btnBox = document.getElementById("btnProd");
                    while (btnBox.hasChildNodes()) {
                        btnBox.removeChild(btnBox.lastChild);
                    }

                    var btnEditar = document.createElement("input");
                    btnEditar.name = 'btnEditar';
                    btnEditar.type = 'button';
                    btnEditar.value = 'Editar';
                    btnEditar.id = 'editProduto';
                    btnEditar.onclick = function() {
                        editarProduto();
                    };

                    btnBox.appendChild(btnEditar);

                    preparaFotos();
                    preparaTags();

                    preparaSaida();
                }
            };

            if (typeof (FormData) == 'undefined') {
                formData.setContentTypeHeader(ajax);
                ajax.sendAsBinary(formData.buildBody());
            } else {
                ajax.send(formData);
            }
        }
    } else {
        if (!document.getElementById("resposta")) {
            var p = document.createElement("p");
            var txt = document.createTextNode("Preencha todos os campos corretamente.");

            p.id = "resposta";
            p.appendChild(txt);
            document.getElementById("infoBox").appendChild(p);
        }
    }
}

function editarProduto() {
    if (!isEmpty(document.getElementsByName("txtNome")[0].value) &&
            !isEmpty(document.getElementsByName("numPreco")[0].value) &&
            !isEmpty(document.getElementsByName("numPeso")[0].value) &&
            !isEmpty(document.getElementsByName("numEstoque")[0].value)) {

        if (verifEstoque()) {
            if (document.getElementById("resposta")) {
                var resposta = document.getElementById("resposta");
                while (resposta.hasChildNodes()) {
                    resposta.removeChild(resposta.lastChild);
                }
            }

            var p = new Produtos(
                    null,
                    document.getElementsByName("txtNome")[0].value,
                    priceUnformat(document.getElementsByName("numPreco")[0].value),
                    priceUnformat(document.getElementsByName("numPeso")[0].value),
                    document.getElementsByName("numEstoque")[0].value,
                    document.getElementsByName("txtDesc")[0].value,
                    document.getElementsByName("chkDest")[0].checked,
                    document.getElementsByName("cboMarca")[0].value,
                    document.getElementsByName("cboSubcat")[0].value
                    );

            if (typeof (FormData) == 'undefined') {
                var formData = new FormDataCompatibility();
            } else {
                var formData = new FormData();
            }

            formData.append('txtNome', p.nome);
            formData.append('numPreco', p.preco);
            formData.append('numPeso', p.peso);
            formData.append('numEstoque', p.estoque);
            formData.append('txtDesc', p.descricao);
            formData.append('chkDest', p.destaque);
            formData.append('cboMarca', p.id_marca);
            formData.append('cboSubcat', p.id_subcatego);

            ajax.open("POST", "produtos/ajax/editar.php", false);

            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4) {
                    var txt = document.createTextNode(ajax.responseText);
                    resposta.appendChild(txt);
                }
            };

            if (typeof (FormData) == 'undefined') {
                formData.setContentTypeHeader(ajax);
                ajax.sendAsBinary(formData.buildBody());
            } else {
                ajax.send(formData);
            }
        }
    } else {
        var p = document.getElementById("resposta");
        var txt = document.createTextNode("Preencha todos os campos corretamente.");

        p.appendChild(txt);
    }
}


function verifEstoque() {
    var numEstoque = document.getElementsByName("numEstoque")[0].value;
    var regex = /^[0-9]+$/;

    if (regex.test(numEstoque) && numEstoque >= 0) {
        $("#aviso3").css("visibility", "hidden");
        return true;
    } else {
        $("#aviso3").css("visibility", "visible");
        return false;
    }
}

function priceUnformat(price) {
    price = price.replace("R$ ", "");
    price = price.replace(" kg", "");

    return price;
}

function preparaFotos() {
    var infoBox = document.getElementById("infoBox");

    var hr = document.createElement("hr");
    hr.className = 'separaForm';

    infoBox.appendChild(hr);

    var h2 = document.createElement("h2");
    h2.id = 'infoSTitle';
    var st = document.createTextNode("Adicionar fotos");

    h2.appendChild(st);
    infoBox.appendChild(h2);

    var preview = document.createElement("iframe");
    preview.src = 'produtos/fotos/preview.php';
    preview.height = '200';
    preview.id = 'previewBox';

    var txt = document.createTextNode("Por favor, atualize seu navegador para utilizar este recurso.");

    preview.appendChild(txt);
    infoBox.appendChild(preview);

    var divFotos = document.createElement("div");
    divFotos.id = 'divFotos';

    infoBox.appendChild(divFotos);
}

function preparaTags() {
    var infoBox = document.getElementById("infoBox");

    var hr = document.createElement("hr");
    hr.className = 'separaForm';
    infoBox.appendChild(hr);

    var h2 = document.createElement("h2");
    h2.id = 'infoSTitle';
    var st = document.createTextNode("Adicionar tags");

    h2.appendChild(st);
    infoBox.appendChild(h2);

    var div = document.createElement("div");
    div.id = 'showTags';
    div.onclick = function() {
        mostrarTags();
    };

    infoBox.appendChild(div);

    var div = document.createElement("div");
    div.id = 'tagCont';

    var input = document.createElement("div");
    input.id = 'inputTags';
    input.contentEditable = 'true';
    input.onblur = function() {
        insereTag();
    };
    input.onkeypress = function(evt) {
        impedeVazio(evt);
    };

    div.appendChild(input);
    infoBox.appendChild(div);
}

function impedeVazio(evt) {
    var cancelKeypress = false;
    evt = evt || window.event;

    cancelKeypress = /^(9|13|32)$/.test("" + evt.keyCode);
    if (cancelKeypress) {
        return false || evt.preventDefault();
    }
}

function preparaSaida() {
    var infoBox = document.getElementById("infoBox");

    var div = document.createElement("div");
    div.className = 'right';

    var form = document.createElement("form");
    form.method = 'post';

    var sbmPronto = document.createElement("input");
    sbmPronto.name = 'sbmPronto';
    sbmPronto.type = 'submit';
    sbmPronto.value = 'Pronto!';


    form.appendChild(sbmPronto);
    div.appendChild(form);
    infoBox.appendChild(div);
}



//Fotos

function Fotos(id, local, descricao, padrao, id_produto) {
    this.id = id;
    this.local = local;
    this.descricao = descricao;
    this.padrao = padrao;
    this.id_produto = id_produto;
}

function formFoto() {
    var current = document.getElementsByClassName("imgBox selected")[0];

    if (!isEmpty(current)) {
        if (current.id == 'newBox') {
            formCadFoto();
        } else {
            formEditFoto(current.id);
        }
    }
}

function formCadFoto() {
    var divFotos = parent.document.getElementById("divFotos");

    while (divFotos.hasChildNodes()) {
        divFotos.removeChild(divFotos.lastChild);
    }

    var formFoto = document.createElement("form");
    formFoto.id = 'formFoto';
    formFoto.method = 'post';
    formFoto.enctype = 'multipart/form-data';

    divFotos.appendChild(formFoto);

    var table = document.createElement("table");
    formFoto.appendChild(table);

    var tr = document.createElement("tr");
    table.appendChild(tr);

    var td = document.createElement("td");
    var label = document.createElement("label");
    var txt = document.createTextNode("Imagem:");
    label.appendChild(txt);
    td.appendChild(label);
    tr.appendChild(td);

    var td = document.createElement("td");
    var input = document.createElement("input");
    input.name = 'arqImagem';
    input.type = 'file';
    input.accept = 'image/*';
    var span = document.createElement("span");
    span.id = 'invalid';
    var txt = document.createTextNode("Arquivo inv\u00e1lido");
    td.appendChild(input);
    span.appendChild(txt);
    td.appendChild(span);
    tr.appendChild(td);

    var tr = document.createElement("tr");
    table.appendChild(tr);

    var td = document.createElement("td");
    var label = document.createElement("label");
    var txt = document.createTextNode("Descri\u00e7\u00e3o:");
    label.appendChild(txt);
    td.appendChild(label);
    tr.appendChild(td);

    var td = document.createElement("td");
    var input = document.createElement("input");
    input.name = 'txtDescImg';
    input.type = 'text';
    input.maxLength = '10';
    td.appendChild(input);
    tr.appendChild(td);

    var tr = document.createElement("tr");
    table.appendChild(tr);

    var td = document.createElement("td");
    var label = document.createElement("label");
    var txt = document.createTextNode("Definir como padr\u00e3o?");
    label.appendChild(txt);
    td.appendChild(label);
    tr.appendChild(td);

    var td = document.createElement("td");
    var input = document.createElement("input");
    input.name = 'chkPadrao';
    input.type = 'checkbox';
    td.appendChild(input);
    tr.appendChild(td);

    var tr = document.createElement("tr");
    table.appendChild(tr);

    var td = document.createElement("td");
    td.colSpan = '2';
    td.className = 'right';
    td.id = 'btnFoto';
    var input = document.createElement("input");
    input.name = 'btnCadFoto';
    input.id = 'cadFoto';
    input.type = 'button';
    input.value = 'Cadastrar';
    input.onclick = function() {
        cadastrarFoto();
    };
    td.appendChild(input);
    tr.appendChild(td);
}

function formEditFoto(id) {
    ajax.open("POST", "ajax/carregar.php", false);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var str = ajax.responseText;

            var f = new Fotos(
                    null,
                    null,
                    str.split("/^txtDescImg=")[1].split("$/")[0],
                    str.split("/^chkPadrao=")[1].split("$/")[0],
                    null
                    );

            var divFotos = parent.document.getElementById("divFotos");

            while (divFotos.hasChildNodes()) {
                divFotos.removeChild(divFotos.lastChild);
            }

            var formFoto = document.createElement("form");
            formFoto.id = 'formFoto';
            formFoto.method = 'post';
            formFoto.enctype = 'multipart/form-data';

            divFotos.appendChild(formFoto);

            var table = document.createElement("table");
            formFoto.appendChild(table);

            var tr = document.createElement("tr");
            table.appendChild(tr);

            var td = document.createElement("td");
            var label = document.createElement("label");
            var txt = document.createTextNode("Nova imagem:");
            label.appendChild(txt);
            td.appendChild(label);
            tr.appendChild(td);

            var td = document.createElement("td");
            var input = document.createElement("input");
            input.name = 'arqImagem';
            input.type = 'file';
            input.accept = 'image/*';
            var span = document.createElement("span");
            span.id = 'invalid';
            var txt = document.createTextNode("Arquivo inv\u00e1lido");
            td.appendChild(input);
            span.appendChild(txt);
            td.appendChild(span);
            tr.appendChild(td);

            var tr = document.createElement("tr");
            table.appendChild(tr);

            var td = document.createElement("td");
            var label = document.createElement("label");
            var txt = document.createTextNode("Descri\u00e7\u00e3o:");
            label.appendChild(txt);
            td.appendChild(label);
            tr.appendChild(td);

            var td = document.createElement("td");
            var input = document.createElement("input");
            input.name = 'txtDescImg';
            input.type = 'text';
            input.maxLength = '10';
            input.value = f.descricao;
            td.appendChild(input);
            tr.appendChild(td);

            var tr = document.createElement("tr");
            table.appendChild(tr);

            var td = document.createElement("td");
            var label = document.createElement("label");
            var txt = document.createTextNode("Definir como padr\u00e3o?");
            label.appendChild(txt);
            td.appendChild(label);
            tr.appendChild(td);

            var td = document.createElement("td");
            var input = document.createElement("input");
            input.name = 'chkPadrao';
            input.type = 'checkbox';
            input.checked = (f.padrao == 0) ? false : true;
            td.appendChild(input);
            tr.appendChild(td);

            var tr = document.createElement("tr");
            table.appendChild(tr);

            var td = document.createElement("td");
            td.colSpan = '2';
            td.className = 'right';
            td.id = 'btnFoto';
            var input = document.createElement("input");
            input.name = 'btnEditFoto';
            input.id = 'editFoto';
            input.type = 'button';
            input.value = 'Editar';
            input.onclick = function() {
                editarFoto(id);
            };
            td.appendChild(input);
            tr.appendChild(td);
        }
    };

    ajax.send("id=" + id);
}

function cadastrarFoto() {
    var parDoc = parent.document;

    if (verifArquivo()) {
        var f = new Fotos(
                null,
                parDoc.getElementsByName("arqImagem")[0].files[0],
                parDoc.getElementsByName("txtDescImg")[0].value,
                parDoc.getElementsByName("chkPadrao")[0].checked,
                null
                );

        if (typeof (FormData) == 'undefined') {
            var formData = new FormDataCompatibility();
        } else {
            var formData = new FormData();
        }


        formData.append('arqImagem', f.local);
        formData.append('txtDescImg', f.descricao);
        formData.append('chkPadrao', f.padrao);

        ajax.open("POST", "ajax/inserir.php", false);

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                var txt = ajax.responseText;

                var selected = document.getElementsByClassName("imgBox selected")[0];
                selected.id = txt;
                selected.style.backgroundImage = "url('../../../img/img_fotos/" + f.local.name + "')";

                var img = document.createElement("img");
                img.src = '../../../img/delBox.png';
                img.className = 'delBox';
                img.width = '30';
                img.height = '30';
                img.onclick = function() {
                    excluirFoto(txt);
                    event.stopPropagation();
                };

                selected.appendChild(img);

                formFoto();
                newBox();
            }
        };

        if (typeof (FormData) == 'undefined') {
            formData.setContentTypeHeader(ajax);
            ajax.sendAsBinary(formData.buildBody());
        } else {
            ajax.send(formData);
        }
    }
}

function editarFoto(id) {
    var parDoc = parent.document;
    var arquivo = parDoc.getElementsByName("arqImagem")[0].files[0];

    if (isEmpty(arquivo)) {
        var f = new Fotos(
                id,
                null,
                parDoc.getElementsByName("txtDescImg")[0].value,
                parDoc.getElementsByName("chkPadrao")[0].checked,
                null
                );

        ajax.open("POST", "ajax/editar.php", false);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                var divFotos = parent.document.getElementById("divFotos");
                var txt = document.createTextNode(ajax.responseText);

                if (divFotos.lastChild.textContent == 'Alterado com sucesso!') {
                    divFotos.removeChild(divFotos.lastChild);
                }

                divFotos.appendChild(txt);
            }
        };

        ajax.send("id=" + f.id + "&" +
                "txtDescImg=" + f.descricao + "&" +
                "chkPadrao=" + f.padrao);

    } else {
        if (verifArquivo()) {
            var f = new Fotos(
                    id,
                    parDoc.getElementsByName("arqImagem")[0].files[0],
                    parDoc.getElementsByName("txtDescImg")[0].value,
                    parDoc.getElementsByName("chkPadrao")[0].checked,
                    null
                    );

            if (typeof (FormData) == 'undefined') {
                var formData = new FormDataCompatibility();
            } else {
                var formData = new FormData();
            }

            formData.append('id', f.id);
            formData.append('arqImagem', f.local);
            formData.append('txtDescImg', f.descricao);
            formData.append('chkPadrao', f.padrao);

            ajax.open("POST", "ajax/editarImagem.php", false);

            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4) {
                    var divFotos = parent.document.getElementById("divFotos");
                    var txt = document.createTextNode(ajax.responseText);

                    if (divFotos.lastChild.textContent == 'Alterado com sucesso!') {
                        divFotos.removeChild(divFotos.lastChild);
                    }

                    divFotos.appendChild(txt);

                    var selected = document.getElementsByClassName("imgBox selected")[0];
                    selected.style.backgroundImage = "url('../../../img/img_fotos/" + f.local.name + "')";
                }
            };

            if (typeof (FormData) == 'undefined') {
                formData.setContentTypeHeader(ajax);
                ajax.sendAsBinary(formData.buildBody());
            } else {
                ajax.send(formData);
            }
        }
    }
}

function excluirFoto(id) {
    ajax.open("POST", "ajax/excluir.php", false);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            $('#' + id).remove();

            var divFotos = parent.document.getElementById("divFotos");

            while (divFotos.hasChildNodes()) {
                divFotos.removeChild(divFotos.lastChild);
            }
        }
    };
    ajax.send("id=" + id);
}

function verifArquivo() {
    var parDoc = parent.document;
    var arquivo = parDoc.getElementsByName("arqImagem")[0].files[0].type;
    var regex = /^image/;

    if (regex.test(arquivo) && arquivo != 'undefined') {
        var invalid = parDoc.getElementById("invalid");
        invalid.style.visibility = 'hidden';
        return true;
    } else {
        var invalid = parDoc.getElementById("invalid");
        invalid.style.visibility = 'visible';
        return false;
    }
}



//Tags

function Tags(id, nome, id_produto) {
    this.id = id;
    this.nome = nome;
    this.id_produto = id_produto;
}

function mostrarTags() {
    ajax.open("GET", "produtos/tags/ajax/mostrarTags.php", false);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            var str = ajax.responseText;

            var div = document.createElement("div");
            div.id = 'mostrarTags';

            var esc = document.createElement("div");
            esc.id = 'escShow';
            esc.onclick = function() {
                fecharTags();
            };

            div.appendChild(esc);

            var h1 = document.createElement("h1");
            h1.id = 'infoTitle';

            var txt = document.createTextNode("TAGS");

            h1.appendChild(txt);
            div.appendChild(h1);

            str = str.split("; ");

            for (var i = 0; i < str.length; i++) {
                var span = document.createElement("span");
                span.className = 'createdTag';

                var txt = document.createTextNode(str[i]);

                if (i != str.length - 1) {
                    var txt2 = document.createTextNode("; ");
                } else {
                    var txt2 = document.createTextNode(".");
                }

                span.appendChild(txt);
                div.appendChild(span);
                div.appendChild(txt2);
            }

            var cover = document.createElement("div");
            cover.id = 'coverBody';
            cover.onclick = function() {
                fecharTags();
            };

            document.body.appendChild(cover);
            document.body.appendChild(div);
        }
    };

    ajax.send(null);
}

function fecharTags() {
    $('#mostrarTags').remove();
    $('#coverBody').remove();
}

function insereTag() {
    var cont = document.getElementById("tagCont");
    var input = document.getElementById("inputTags");

    if (verifTag()) {

        var t = new Tags(
                null,
                input.lastChild.textContent.toUpperCase(),
                null
                );

        ajax.open("POST", "produtos/tags/ajax/inserir.php", false);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                var id = ajax.responseText;

                while (input.hasChildNodes()) {
                    input.removeChild(input.lastChild);
                }

                var txt = document.createTextNode(t.nome);

                var div = document.createElement("div");
                div.id = id;
                div.className = 'tag';
                div.contentEditable = 'false';

                var img = document.createElement("img");
                img.src = '../img/delTag.png';
                img.className = 'delTag';
                img.width = '20';
                img.height = '20';
                img.onclick = function() {
                    excluirTag(id);
                };

                div.appendChild(txt);
                div.appendChild(img);
                cont.insertBefore(div, cont.lastChild);

                if (document.getElementsByClassName("tag").length > 2) {
                    $('#inputTags').remove();
                }

            }
        };

        ajax.send("txtNome=" + t.nome);

    } else {
        input.removeChild(input.lastChild);
    }
}

function excluirTag(id) {
    ajax.open("POST", "produtos/tags/ajax/excluir.php", false);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4) {
            $('#' + id).remove();

            if (isEmpty(document.getElementById("inputTags"))) {
                var cont = document.getElementById("tagCont");

                var input = document.createElement("div");
                input.id = 'inputTags';
                input.contentEditable = 'true';
                input.onblur = function() {
                    insereTag();
                };
                input.onkeypress = function(evt) {
                    var cancelKeypress = false;
                    evt = evt || window.event;

                    cancelKeypress = /^(9|13|32)$/.test("" + evt.keyCode);
                    if (cancelKeypress) {
                        return false || evt.preventDefault();
                    }
                };

                cont.appendChild(input);
            }
        }
    };

    ajax.send("id=" + id);
}

function verifTag() {
    var verif = true;

    var cont = document.getElementById("tagCont");

    var tags = "";
    for (var i = 0; i < cont.childNodes.length; i++) {
        tags += cont.childNodes[i].textContent + " ";
    }
    tags = tags.split(" ");

    var i = tags.length - 2;

    if (i > 2 || tags[i].length > 10) {
        verif = false;
    }

    if (!isEmpty(tags[i - 1])) {
        if (tags[i].toUpperCase() == tags[i - 1].toUpperCase()) {
            verif = false;
        }
    }

    if (!isEmpty(tags[i - 2])) {
        if (tags[i].toUpperCase() == tags[i - 2].toUpperCase()) {
            verif = false;
        }
    }

    return verif;
}

var winOnload = window.onload; //evitar que o window.onload do produtos sobreescreva o window.onload do paginar
window.onload = function() {
    winOnload();

    if (!isEmpty(document.getElementById("cadProduto"))) {
        document.getElementById("cadProduto").onclick = function() {
            cadastrarProduto();
        };
    }

    if (!isEmpty(document.getElementsByName("numEstoque")[0])) {
        document.getElementsByName("numEstoque")[0].onblur = function() {
            verifEstoque();
        };
    }

    if (document.getElementById("editProduto")) {
        document.getElementById("editProduto").onclick = function() {
            editarProduto();
        };
    }

    if (document.getElementById("inputTags")) {
        document.getElementById("inputTags").onkeypress = function(evt) {
            impedeVazio(evt);
        };
    }
};