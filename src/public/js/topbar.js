let smallMenuShown = false;

function showSmallMenu(){
    if(!smallMenuShown){
        showMenu();
    }
    else{
        hideMenu();
    }
}

function hideMenu(){
    let popupmenu = document.getElementById("popup-menu");
    let buttons = document.getElementsByClassName("popup-btn-sm");    
    popupmenu.style.height = '0px';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = 'none';
        buttons[i].style.height = '0';
    }
    smallMenuShown = false;
}

function showMenu(){
    let popupmenu = document.getElementById("popup-menu");
    let buttons = document.getElementsByClassName("popup-btn-sm");
    popupmenu.style.height = '192px';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].style.display = 'flex';
        buttons[i].style.height = '64px';
    }
    smallMenuShown = true;
}

function checkScreenWidth(event){
    if(event.matches){
        console.log("Yes")
        smallMenuShown = false;
        hideMenu();
    }
}

var topbar_input = document.getElementById("topbar-search");
topbar_input.addEventListener("keydown", function(event) {
    if(event.key === "Enter" && document.activeElement === topbar_input){
        location.href="/search?q=".concat(topbar_input.value);
    }
});

var topbar_input = document.getElementById("topbar-search");
topbar_input.addEventListener("keydown", function(event) {
    if(event.key === "Enter" && document.activeElement === topbar_input){
        location.href="/search?q=".concat(topbar_input.value);
    }
});

const mediaQuery = window.matchMedia("(min-width: 6in)")
mediaQuery.addEventListener("change", checkScreenWidth)
