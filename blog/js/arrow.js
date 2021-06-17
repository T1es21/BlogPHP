var block = document.getElementsByClassName('up')[0];
var obj = document.getElementById('arrowup');
block.onmouseover = function () {
    obj.src = "img/arrowupwhite.png";
}
block.onmouseout = function () {
    obj.src = "img/arrowup.png";
}