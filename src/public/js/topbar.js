let smallMenuShown = false;
const mediaQuery = window.matchMedia("(min-width: 6in)")
const topbar_input = document.getElementById("topbar-search");

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

const searchresult = document.getElementById("topbar-search-result");
function generateSearchEntry(image_path, title, author, id){
    const button = document.createElement('button');
    button.classList.add('search-entry-sm');
    button.onclick = function(){
        window.location.href = "/detail?bid=" + id;
    }

    const bookContainer = document.createElement('div');
    bookContainer.classList.add('book-container');

    const img = document.createElement('img');
    img.classList.add('book-image');
    img.src = image_path;
    img.alt = "image of " + title;
    bookContainer.appendChild(img);

    const clusterV = document.createElement('div');
    clusterV.classList.add('cluster-v');

    const pusher1 = document.createElement('div');
    pusher1.classList.add('pusher');
    clusterV.appendChild(pusher1);

    
    const titlehtml = document.createElement('p');
    titlehtml.classList.add('search-entry-sm-t');
    titlehtml.textContent = title;
    clusterV.appendChild(titlehtml);
    
    const authorhtml = document.createElement('p');
    authorhtml.classList.add('search-entry-sm-a');
    authorhtml.textContent = 'By ' + author;
    clusterV.appendChild(authorhtml);
    
    const pusher2 = document.createElement('div');
    pusher2.classList.add('pusher');
    clusterV.appendChild(pusher2);

    button.appendChild(bookContainer);
    button.appendChild(clusterV);

    searchresult.appendChild(button);
}

function cleanSearchEntry(){
    while(searchresult.firstChild){
        searchresult.removeChild(searchresult.firstChild);
    }
}

function serveSearchResult(results){
    if(results['error'] == null){
        //generate html part here
        cleanSearchEntry();
        results.forEach(entry => {           
            image_path = entry['image_path'];
            title = entry['title'];
            author = entry['name'];
            id = entry['book_id'];
            generateSearchEntry(image_path, title, author, id);
        });
    }{
        console.error(results['error']);
    }
}

function search(query){
    let xhr = new XMLHttpRequest();
    const url = '/search';
    xhr.open("POST", url, true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    
    const data = 'q=' + encodeURIComponent(query);

    xhr.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            const response = JSON.parse(this.responseText);
            serveSearchResult(response);
        }
    }
    xhr.send(data);
}

function debounce(func, delay){
    let timeout;

    const debounce_func = function(){
        const args = arguments;

        function cancel(){
            clearTimeout(timeout);
        }

        clearTimeout(timeout);
        timeout = setTimeout(function() {
            func.apply(this, args);
        }, delay);
    }
    debounce_func.cancel = function(){
        clearTimeout(timeout);
    };

    return debounce_func;
}
const debounced_search = debounce(search, 500);

topbar_input.addEventListener("keydown", function(event) {
    if(event.key === "Enter" && document.activeElement === topbar_input){
        location.href="/search?q=" + topbar_input.value;
    }
});

topbar_input.addEventListener("keyup", function(event) {
    cleanSearchEntry();
    debounced_search(topbar_input.value);
});

topbar_input.addEventListener("focusout", function(event) {
    if(document.activeElement !== topbar_input && !searchresult.contains(document.activeElement)){
        setTimeout(function() {
            cleanSearchEntry();
        }, 100);
        debounced_search.cancel();
    }
});

mediaQuery.addEventListener("change", checkScreenWidth)
