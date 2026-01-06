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

/* ===============================
   GLOBAL VARIABLES
   =============================== */
let originalRent = null;
let couponApplied = false;

/* ===============================
   LOAD COUPON LIST (ON PAGE LOAD)
   =============================== */
function loadCoupons() {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("couponList").innerHTML = this.responseText;
        }
    };

    xhttp.open(
        "GET",
        "../Php/ApplyCoupon.php?action=list",
        true
    );
    xhttp.send();
}

/* ===============================
   APPLY COUPON
   =============================== */
function applyCoupon() {

    var code = document.getElementById("couponCode").value.trim();
    var msg  = document.getElementById("couponMsg");
    var btn  = document.getElementById("couponBtn");
    var rentInput = document.getElementById("rent");

    if (!rentInput) {
        alert("Rent input not found");
        return;
    }

    if (code === "") {
        msg.innerText = "❌ Enter coupon code";
        msg.className = "msg-box msg-error";
        msg.style.display = "block";
        return;
    }

    // Save original rent only once
    if (originalRent === null) {
        originalRent = parseInt(rentInput.value);
    }

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200) {

            try {
                var res = JSON.parse(this.responseText);
            } catch (e) {
                msg.innerText = "❌ Server error";
                msg.className = "msg-box msg-error";
                msg.style.display = "block";
                return;
            }

            msg.style.display = "block";

            if (res.status === "success") {

                var discounted =
                    originalRent - (originalRent * res.discount / 100);

                rentInput.value = Math.round(discounted);

                msg.innerText =
                    "✅ Coupon applied! " + res.discount + "% off";
                msg.className = "msg-box msg-success";

                // Switch button to Remove
                btn.innerText = "Remove";
                btn.onclick = removeCoupon;

                couponApplied = true;

            } else {

                msg.innerText = "❌ " + res.message;
                msg.className = "msg-box msg-error";
            }
        }
    };

    xhttp.open(
        "POST",
        "../Php/ApplyCoupon.php",
        true
    );
    xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    xhttp.send(
        "action=apply&code=" + encodeURIComponent(code)
    );
}

/* ===============================
   REMOVE COUPON
   =============================== */
function removeCoupon() {

    var rentInput = document.getElementById("rent");
    var msg  = document.getElementById("couponMsg");
    var btn  = document.getElementById("couponBtn");

    if (originalRent !== null) {
        rentInput.value = originalRent;
    }

    document.getElementById("couponCode").value = "";

    msg.innerText = "❎ Coupon removed";
    msg.className = "msg-box msg-error";
    msg.style.display = "block";

    btn.innerText = "Apply";
    btn.onclick = applyCoupon;

    couponApplied = false;
}

/* ===============================
   OPTIONAL: CLICK COUPON TO FILL
   =============================== */
function fillCoupon(code) {
    document.getElementById("couponCode").value = code;
}

