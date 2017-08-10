function newBox() {
    var imgBox = document.createElement("div");
    imgBox.id = 'newBox';
    imgBox.className = 'imgBox';
    imgBox.onclick = function() {
        $(imgBox).addClass('selected').siblings().removeClass('selected');
        formFoto();
    };

    if (document.getElementsByClassName("imgBox").length < 1) {
        imgBox.className = 'imgBox selected';
        formCadFoto();
    }

    document.body.appendChild(imgBox);
}

window.onload = function() {
    newBox();
};