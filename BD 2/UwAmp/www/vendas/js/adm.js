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

function exibirEndereco(id) {
    if (isEmpty(document.getElementById("enderecoBox" + id))) {
        ajax.open("POST", "clientes/ajax/exibirEndereco.php", true);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                var str = ajax.responseText;
                var prevTr = document.getElementById(id);

                var table = document.createElement("table");

                //endereço

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Endere\u00e7o:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^endereco=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //complemento

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Complemento:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^complemento=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //bairro

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Bairro:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^bairro=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //cidade

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Cidade:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^cidade=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //estado

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Estado:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^estado=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //cep

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("CEP:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^cep=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                var enderecoBox = document.createElement("tr");
                enderecoBox.id = 'enderecoBox' + id;
                enderecoBox.className = 'trBox';

                var td = document.createElement("td");
                td.colSpan = '8';

                td.appendChild(table);
                enderecoBox.appendChild(td);

                if (prevTr.nextSibling) {
                    prevTr.parentNode.insertBefore(enderecoBox, prevTr.nextSibling);
                }
                else {
                    prevTr.parentNode.appendChild(enderecoBox);
                }
            }
        };

        ajax.send("id=" + id);
    } else {
        $('#enderecoBox' + id).remove();
    }
}

function exibirDetalhes(id) {
    if (isEmpty(document.getElementById("detalhesBox" + id))) {
        ajax.open("POST", "produtos/ajax/exibirDetalhes.php", true);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                var str = ajax.responseText;
                var prevTr = document.getElementById(id);

                var table = document.createElement("table");

                //ctrlestoque

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Controle de estoque:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^ctrlestoque=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //marca

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Marca:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^marca=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //descricao

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                var label = document.createElement("label");
                var txt = document.createTextNode("Subcategoria:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);

                var td = document.createElement("td");
                var txt = document.createTextNode(str.split("/^subcategoria=")[1].split("$/")[0]);

                td.appendChild(txt);
                tr.appendChild(td);

                table.appendChild(tr);

                //descricao

                var tr = document.createElement("tr");

                var td = document.createElement("td");
                td.colSpan = '2';
                var label = document.createElement("label");
                var txt = document.createTextNode("Descri\u00e7\u00e3o:");

                label.appendChild(txt);
                td.appendChild(label);
                tr.appendChild(td);
                
                table.appendChild(tr);
                
                var tr = document.createElement("tr");

                var td = document.createElement("td");
                td.colSpan = '2';
                td.innerHTML = str.split("/^descricao=")[1].split("$/")[0];

                tr.appendChild(td);
                table.appendChild(tr);

                var detalhesBox = document.createElement("tr");
                detalhesBox.id = 'detalhesBox' + id;
                detalhesBox.className = 'trBox';

                var td = document.createElement("td");
                td.colSpan = '11';

                td.appendChild(table);
                detalhesBox.appendChild(td);

                if (prevTr.nextSibling) {
                    prevTr.parentNode.insertBefore(detalhesBox, prevTr.nextSibling);
                }
                else {
                    prevTr.parentNode.appendChild(detalhesBox);
                }
            }
        };

        ajax.send("id=" + id);
    } else {
        $('#detalhesBox' + id).remove();
    }
}

function exibirFotos(id) {
    if (isEmpty(document.getElementById("fotosBox" + id))) {
        ajax.open("POST", "produtos/ajax/exibirFotos.php", true);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                if (!isEmpty(ajax.responseText)) {
                    var str = ajax.responseText;
                    var prevTr = document.getElementById(id);

                    var fotosBox = document.createElement("tr");
                    fotosBox.id = 'fotosBox' + id;
                    fotosBox.className = 'trBox';

                    var td = document.createElement("td");
                    td.colSpan = '11';

                    var end = str.split("/^^img==").length - 1;

                    for (var i = 0; i < end; i++) {
                        var substr = str.split("/^^img==")[(i + 1)].split("$$/")[0];

                        var local = substr.split("/^local=")[1].split("$/")[0];
                        var descricao = substr.split("/^descricao=")[1].split("$/")[0];
                        var padrao = substr.split("/^padrao=")[1].split("$/")[0];

                        var a = document.createElement("a");
                        a.className = 'imgProduto';
                        a.href = '../img/img_fotos/' + local;
                        $(a).attr('data-title', descricao);
                        $(a).attr('data-lightbox', id);

                        var img = document.createElement("img");
                        img.id = 'img' + padrao;
                        img.src = '../img/img_fotos/' + local;
                        img.alt = descricao;

                        a.appendChild(img);
                        td.appendChild(a);
                    }

                    fotosBox.appendChild(td);

                    if (prevTr.nextSibling) {
                        prevTr.parentNode.insertBefore(fotosBox, prevTr.nextSibling);
                    }
                    else {
                        prevTr.parentNode.appendChild(fotosBox);
                    }
                }
            }
        };

        ajax.send("id=" + id);
    } else {
        $('#fotosBox' + id).remove();
    }
}

function exibirTags(id) {
    if (isEmpty(document.getElementById("tagsBox" + id))) {
        ajax.open("POST", "produtos/ajax/exibirTags.php", true);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                if (!isEmpty(ajax.responseText)) {
                    var str = ajax.responseText;
                    var prevTr = document.getElementById(id);

                    var td = document.createElement("td");
                    td.colSpan = '11';

                    var label = document.createElement("label");
                    var txt = document.createTextNode("Tags: ");

                    label.appendChild(txt);
                    td.appendChild(label);

                    var substr = '';
                    var first = true;
                    
                    var end = str.split("/^tag=").length - 1;

                    for (var i = 0; i < end; i++) {
                        if (!first) {
                            substr += '; ';
                        } else {
                            first = false;
                        }

                        substr += str.split("/^tag=")[(i + 1)].split("$/")[0];
                    }

                    substr += '.';

                    var txt = document.createTextNode(substr);

                    td.appendChild(txt);

                    var tagsBox = document.createElement("tr");
                    tagsBox.id = 'tagsBox' + id;
                    tagsBox.className = 'trBox';

                    tagsBox.appendChild(td);

                    if (prevTr.nextSibling) {
                        prevTr.parentNode.insertBefore(tagsBox, prevTr.nextSibling);
                    }
                    else {
                        prevTr.parentNode.appendChild(tagsBox);
                    }
                }
            }
        };

        ajax.send("id=" + id);
    } else {
        $('#tagsBox' + id).remove();
    }
}

function exibirTexto(id) {
    if (isEmpty(document.getElementById("textoBox" + id))) {
        ajax.open("POST", "textos/ajax/exibirTexto.php", true);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                if (!isEmpty(ajax.responseText)) {
                    var prevTr = document.getElementById(id);

                    var textoBox = document.createElement("tr");
                    textoBox.id = 'textoBox' + id;
                    textoBox.className = 'trBox';

                    var td = document.createElement("td");
                    td.colSpan = '5';

                    textoBox.appendChild(td);
                    td.innerHTML = ajax.responseText;

                    if (prevTr.nextSibling) {
                        prevTr.parentNode.insertBefore(textoBox, prevTr.nextSibling);
                    }
                    else {
                        prevTr.parentNode.appendChild(textoBox);
                    }
                }
            }
        };

        ajax.send("id=" + id);
    } else {
        $('#textoBox' + id).remove();
    }
}

function exibirCliente(id) {
    if (isEmpty(document.getElementById("clienteBox" + id))) {
        ajax.open("POST", "vendas/ajax/exibirCliente.php", true);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                if (!isEmpty(ajax.responseText)) {
                    var str = ajax.responseText;
                    var prevTr = document.getElementById(id);

                    var table = document.createElement("table");

                    //tipo de pagamento

                    var tr = document.createElement("tr");

                    var td = document.createElement("td");
                    var label = document.createElement("label");
                    var txt = document.createTextNode("Tipo de pagamento:");

                    label.appendChild(txt);
                    td.appendChild(label);
                    tr.appendChild(td);

                    var td = document.createElement("td");
                    var txt = document.createTextNode(str.split("/^nome_tipopagamento=")[1].split("$/")[0] +
                            ' (' + str.split("/^id_tipopagamento=")[1].split("$/")[0].replace(/\s+/g, '') + ')');

                    td.appendChild(txt);
                    tr.appendChild(td);

                    table.appendChild(tr);

                    //cliente

                    var tr = document.createElement("tr");

                    var td = document.createElement("td");
                    var label = document.createElement("label");
                    var txt = document.createTextNode("Cliente:");

                    label.appendChild(txt);
                    td.appendChild(label);
                    tr.appendChild(td);

                    var td = document.createElement("td");
                    var txt = document.createTextNode(str.split("/^nome_cliente=")[1].split("$/")[0] + 
                            ' (' + str.split("/^id_cliente=")[1].split("$/")[0].replace(/\s+/g, '') + ')');

                    td.appendChild(txt);
                    tr.appendChild(td);

                    table.appendChild(tr);

                    //cpf

                    var tr = document.createElement("tr");

                    var td = document.createElement("td");
                    var label = document.createElement("label");
                    var txt = document.createTextNode("CPF:");

                    label.appendChild(txt);
                    td.appendChild(label);
                    tr.appendChild(td);

                    var td = document.createElement("td");
                    var txt = document.createTextNode(str.split("/^cpf_cliente=")[1].split("$/")[0]);

                    td.appendChild(txt);
                    tr.appendChild(td);

                    table.appendChild(tr);

                    //cep

                    var tr = document.createElement("tr");

                    var td = document.createElement("td");
                    var label = document.createElement("label");
                    var txt = document.createTextNode("CEP:");

                    label.appendChild(txt);
                    td.appendChild(label);
                    tr.appendChild(td);

                    var td = document.createElement("td");
                    var txt = document.createTextNode(str.split("/^cep_cliente=")[1].split("$/")[0]);

                    td.appendChild(txt);
                    tr.appendChild(td);

                    table.appendChild(tr);

                    var clienteBox = document.createElement("tr");
                    clienteBox.id = 'clienteBox' + id;
                    clienteBox.className = 'trBox';

                    var td = document.createElement("td");
                    td.colSpan = '10';

                    td.appendChild(table);
                    clienteBox.appendChild(td);

                    if (prevTr.nextSibling) {
                        prevTr.parentNode.insertBefore(clienteBox, prevTr.nextSibling);
                    }
                    else {
                        prevTr.parentNode.appendChild(clienteBox);
                    }
                }
            }
        };

        ajax.send("id=" + id);
    } else {
        $('#clienteBox' + id).remove();
    }
}

function exibirItens(id) {
    if (isEmpty(document.getElementById("itensBox" + id))) {
        ajax.open("POST", "vendas/itens/ajax/exibirItens.php", true);

        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");

        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                if (!isEmpty(ajax.responseText)) {
                    var str = ajax.responseText;
                    var prevTr = document.getElementById(id);

                    var table = document.createElement("table");
                    
                    var end = str.split("/^^item==").length - 1;

                    for (var i = 0; i < end; i++) {
                        var substr = str.split("/^^item==")[(i + 1)].split("$$/")[0];

                        //id

                        var tr = document.createElement("tr");

                        var td = document.createElement("td");
                        td.colSpan = '2';
                        td.className = 'itemHead';
                        var label = document.createElement("label");
                        var txt = document.createTextNode("ITEM " + substr.split("/^id=")[1].split("$/")[0]);

                        label.appendChild(txt);
                        td.appendChild(label);
                        tr.appendChild(td);

                        table.appendChild(tr);

                        //produto

                        var tr = document.createElement("tr");

                        var td = document.createElement("td");
                        var label = document.createElement("label");
                        var txt = document.createTextNode("Produto:");

                        label.appendChild(txt);
                        td.appendChild(label);
                        tr.appendChild(td);

                        var td = document.createElement("td");
                        var txt = document.createTextNode(substr.split("/^nome_produto=")[1].split("$/")[0] +
                                ' (' + substr.split("/^id_produto=")[1].split("$/")[0].replace(/\s+/g, '') + ')');

                        td.appendChild(txt);
                        tr.appendChild(td);

                        table.appendChild(tr);

                        //preço

                        var tr = document.createElement("tr");

                        var td = document.createElement("td");
                        var label = document.createElement("label");
                        var txt = document.createTextNode("Pre\u00e7o:");

                        label.appendChild(txt);
                        td.appendChild(label);
                        tr.appendChild(td);

                        var td = document.createElement("td");
                        var txt = document.createTextNode(substr.split("/^preco=")[1].split("$/")[0]);

                        td.appendChild(txt);
                        tr.appendChild(td);

                        table.appendChild(tr);

                        //peso

                        var tr = document.createElement("tr");

                        var td = document.createElement("td");
                        var label = document.createElement("label");
                        var txt = document.createTextNode("Peso:");

                        label.appendChild(txt);
                        td.appendChild(label);
                        tr.appendChild(td);

                        var td = document.createElement("td");
                        var txt = document.createTextNode(substr.split("/^peso=")[1].split("$/")[0]);

                        td.appendChild(txt);
                        tr.appendChild(td);

                        table.appendChild(tr);

                        //quantidade

                        var tr = document.createElement("tr");

                        var td = document.createElement("td");
                        var label = document.createElement("label");
                        var txt = document.createTextNode("Quantidade:");

                        label.appendChild(txt);
                        td.appendChild(label);
                        tr.appendChild(td);

                        var td = document.createElement("td");
                        var txt = document.createTextNode(substr.split("/^quantidade=")[1].split("$/")[0]);

                        td.appendChild(txt);
                        tr.appendChild(td);

                        table.appendChild(tr);
                    }

                    var td = document.createElement("td");
                    td.colSpan = '10';

                    var itensBox = document.createElement("tr");
                    itensBox.id = 'itensBox' + id;
                    itensBox.className = 'trBox';

                    td.appendChild(table);
                    itensBox.appendChild(td);

                    if (prevTr.nextSibling) {
                        prevTr.parentNode.insertBefore(itensBox, prevTr.nextSibling);
                    }
                    else {
                        prevTr.parentNode.appendChild(itensBox);
                    }
                }
            }
        };

        ajax.send("id=" + id);
    } else {
        $('#itensBox' + id).remove();
    }
}