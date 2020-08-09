//auto complete lokaal vinder
var autocompleteclass = document.querySelector("#autocompleteClass");

//autocompleteclass.style.display = "none";

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
            autocompleteclass.style.display = "block";
            autocompleteclass.innerHTML = "";
            result.body.forEach(element => {
                let suggestion = document.createElement('a');
                suggestion.innerHTML = element.username;
                suggestion.setAttribute("href", "/transfer.php?searchField="+element.username+"&searchUser=Zoek");
                autocompleteclass.appendChild(suggestion);
            });
        }).catch( error => {
            console.log("Error:", error);
        
        });
});