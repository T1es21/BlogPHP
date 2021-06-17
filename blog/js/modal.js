var modal = document.getElementsByClassName('modal')[0];
var modalMain = document.getElementsByClassName('fullBack')[0];
var change = document.getElementById('mbtn');
var closeModal = document.getElementsByClassName('close')[0];

change.onclick = function () {
    modal.style.display = "block";
    modalMain.style.display = "block";
};

closeModal.onclick = function () {
    modal.style.display = "none";
    modalMain.style.display = "none";
};





