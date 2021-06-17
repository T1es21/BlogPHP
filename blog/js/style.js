var a = document.getElementsByClassName('lineAside');
var b = document.getElementsByClassName('aside1')[0];
if (a.length > 5){
    b.style.overflowY = "scroll";

}

var aside = document.getElementsByClassName('aside2')[0];
var aside2 = document.getElementsByClassName('aside1')[0];
var r = aside.offsetHeight;
r -= 10;
aside2.style.height = r;
console.log(aside.offsetHeight);
console.log(aside2.offsetHeight);

var mes = document.getElementsByClassName('message');
var nomes = document.getElementsByClassName('noMessage')[0];
var up = document.getElementsByClassName('up')[0];
if (mes.length > 0){
    nomes.style.display = "none";
}

if (mes.length < 1){
    up.style.display = "none";
};