

var resultSearch = document.querySelector("#resultSearch");
resultSearch.style.display= "none";

document.querySelector("#searchUser").addEventListener("keyup", event => {
    let input = document.querySelector("#searchUser").nodeValue;
    let searchResults = new searchResults();
    searchResults.append("text", input);

    fetch('/ajax/autocomplete.php', {
        method: "POST",
        body: searchResults })

    .then(response => response.json())
        .then(result => {  
            resultSearch.innerHTML=" ";
            resultSearch.style.display = "block";

            result.body.forEach(element => {
                let result = document.createElement('a');
                result.innerHTML = element.username;
                resultSearch.appendChild(result);
    });
}) .catch(error => {
    console.log("Error", error);
        });
});
