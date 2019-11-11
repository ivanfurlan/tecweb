function openCloseMenu(menu) {
    var x = document.getElementById(menu);
    if (x.classList.contains("menuClose") === true) {
        x.classList.replace("menuClose","menuOpen");
    } else {
        x.classList.replace("menuOpen","menuClose");
    }
}