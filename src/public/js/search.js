const queryinput = document.getElementById("query-input");
const sortcomponent = document.getElementById("sort-select");
const genrecomponent = document.getElementById("genre-select");
const desccomponent = document.getElementById("desc-input");
const nographiccomponent = document.getElementById("graphic-input");

const queryString = window.location.search;
const params = new URLSearchParams(queryString);

function changeQuery(){
    if(queryinput.value != ''){
        params.set('q', queryinput.value)
        changePage(1)
        debounced_main_search();
    } else{
        params.delete('q');
        changePage(1)
        debounced_main_search();
    }
}
function changeGenre(){
    params.set('genre', genrecomponent.options[genrecomponent.selectedIndex].value);
    changePage(1);
    search();
}
function changeSort(){
    params.set('sort', sortcomponent.options[sortcomponent.selectedIndex].value);
    changePage(1)
    search();
}
function changeDesc(){
    params.set('desc', desccomponent.checked)
    changePage(1)
    search();
}
function changeHgcntn(){
    params.set('hgcntn', nographiccomponent.checked)
    changePage(1)
    search();
}

function changePage(page){
    params.set('page', page);
    search();
}

function search(){
    let xhr = new XMLHttpRequest();
    
    window.history.replaceState({}, "", "/search?" + params.toString());

    xhr.open("GET", "/api/search?" + params.toString(), true);    
    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("result-booklist").innerHTML = xhr.response;
        }
    }
    xhr.send();
}

const debounced_main_search = debounce(search, 500);

queryinput.addEventListener("keyup", function(event) { 
    changeQuery();
});
