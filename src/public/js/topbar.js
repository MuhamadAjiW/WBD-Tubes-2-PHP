let smallMenuShown = false;
const mediaQuery = window.matchMedia("(min-width: 6in)")
const topbar_input = document.getElementById("topbar-search");
const topbar_searchresult = document.getElementById("topbar-search-result")

const topQueryString = window.location.search;
const currentPage = window.location.pathname;
const topParams = new URLSearchParams(topQueryString);

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
        smallMenuShown = false;
        hideMenu();
    }
}

function cleanSearchEntry(){
    topParams.delete('qtopbar')
    while(topbar_searchresult.firstChild){
        topbar_searchresult.removeChild(topbar_searchresult.firstChild);
    }
}

function searchTopbar(){
    let xhr = new XMLHttpRequest();
    
    window.history.replaceState({}, "", currentPage.toString() + '?' + topParams.toString());

    xhr.open("GET", "/api/searchsm?" + topParams.toString(), true);    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            topbar_searchresult.innerHTML = xhr.response;
        }
    }
    xhr.send();
}

const debounced_top_search = debounce(searchTopbar, 500);

topbar_input.addEventListener("keydown", function(event) {
    if(event.key === "Enter" && document.activeElement === topbar_input){
        location.href="/search?q=" + topbar_input.value;
    }
});

topbar_input.addEventListener("keyup", function(event) {
    cleanSearchEntry();
    if(topbar_input.value != ''){
        topParams.set('qtopbar', topbar_input.value);
    }
    debounced_top_search();
});

topbar_input.addEventListener("focusout", function(event) {
    if(document.activeElement !== topbar_input && !topbar_searchresult.contains(document.activeElement)){
        setTimeout(function() {
            cleanSearchEntry();
        }, 100);
        debounced_top_search.cancel();
    }
});

mediaQuery.addEventListener("change", checkScreenWidth)
