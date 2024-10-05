function loadContent(section) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("contentArea").innerHTML = this.responseText;
    }
    xhttp.open("GET", section + ".php");
    xhttp.send();
}