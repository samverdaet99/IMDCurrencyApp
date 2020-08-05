
var sugesstionBox = document.querySelector("#suggesstionBox");
sugesstionBox.style.display = "none";

document.querySelector("#searchName").addEventListener("keyup", event => {
    let input = document.querySelector("#searchName").value;
    let formData = new FormData();
    formData.append("text", input);

    fetch('./ajax/autocomplete.php', {
        method: "POST",
        body: formData
        
    }).then(response => response.json())
        .then(result => {
            sugesstionBox.style.display = "block";
            sugesstionBox.innerHTML = "";
            result.body.forEach(element => {

                let suggestion = document.createElement('a');
                suggestion.setAttribute(element.id)
                suggestion.innerHTML = element.username ;
                sugesstionBox.appendChild(suggestion);
            });
        }).catch(error => {
            console.log("Error", error);
        });
});