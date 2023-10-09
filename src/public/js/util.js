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

function getURLParams(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    return urlParams;
}