//auto complete lokaal vinder
var autocompletetest = document.querySelector("#autocompleteTest");

//autocompletetest.style.display = "none";

document.querySelector('#searchUser').addEventListener("keyup", event => {
        let input = document.querySelector('#searchUser').value;
        console.log("gelukt");
        let formData = new FormData();
        formData.append("text",input);

        fetch('ajax/autocomplete.php', {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(result => {
            console.log(result.body);
            autocompletetest.style.display = "block";
            autocompletetest.innerHTML = "";
            result.body.forEach(element => {
                let suggestion = document.createElement('a');
                suggestion.innerHTML = element.username;
                suggestion.setAttribute("href", "/transfer.php?searchField="+element.username+"&searchUser=Zoek");
                autocompletetest.appendChild(suggestion);
            });
        }).catch( error => {
            console.log("Error:", error);
        
        });
});