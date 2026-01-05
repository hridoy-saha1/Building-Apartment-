function applyAgreement(apartmentId, btn) {

    if (btn.disabled) return;

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            if (this.responseText.trim() === "success") {
                btn.innerText = "Applied";
                btn.disabled = true;
            } else {
                alert(this.responseText);
            }
        }
    };

    xhttp.open("POST", "agreement.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("apartment_id=" + apartmentId);
}



function updateStatus(id, status) {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            if (this.responseText.trim() === "success") {
                document.getElementById("row-" + id).remove();
            } else {
                alert(this.responseText);
            }
        }
    };

    xhttp.open("POST", "agreementControl.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&status=" + status);
}