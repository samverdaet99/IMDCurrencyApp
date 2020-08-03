

var resultSearch = document.querySelector("#resultSearch");

document.querySelector("#searchUser").addEventListener("keyup", event => {
    let input = document.querySelector("#searchUser").nodeValue;
    let searchResults = new searchResults();
    searchResults.append("text", input);
})