
var resultSearch = document.querySelector("#resultSearch");
resultSearch.style.display= "none";

document.querySelector("#searchUser").addEventListener("keyup", event => {
    let input = document.querySelector("#searchUser").Value;

    let searchData = new SearchData();
    searchData.append("text", input);

    fetch('/ajax/autocomplete.php', {
        method: "POST",
        body: searchData })

    .then(response => response.json())
        .then(result => {  
            resultSearch.innerHTML= " ";
            resultSearch.style.display = "block";

            result.body.forEach(element => {
                let suggestion = document.createElement('a');
                suggestion.innerHTML = element.username;
                resultSearch.appendChild(suggestion);
    });
}) .catch(error => {
    console.log("Error", error);
        });
});
