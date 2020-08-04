


var resultSearch = document.querySelector("#resultSearch");
resultSearch.style.display= "none";
let searchData = new SearchData();

document.querySelector("#searchUser").addEventListener("keyup", event => {
    let input = document.querySelector("#searchUser").Value;

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
