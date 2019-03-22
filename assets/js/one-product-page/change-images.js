window.changeImage = function(id) {
    var newSrc = document.getElementById(id).src;
    var m = document.getElementById("main-img").src = newSrc;//"http://localhost:8000/imgages/product02.png";
}