//LOGIN VALIDATION

const loginform = document.getElementById("loginform");

if(loginform) {

    loginform.addEventListener("submit", function (e) {

    let username = document.querySelector("input[name='username']").value.trim();
    let password = document.querySelector("input[name='password']").value.trim();

    // remove old error box if any
    let oldErr = document.getElementById("jsError");
    if (oldErr) oldErr.remove();

    if (username === "" || password === "") {

        // prevent submit
        e.preventDefault();

        // create error alert
        let box = document.createElement("div");
        box.id = "jsError";
        box.className = "error-box";
        box.innerText = "All fields are required!";

        // insert above the form
        document.querySelector(".login-card").insertBefore(box, document.querySelector("form"));

        // fade out after 5 seconds
        setTimeout(() => {
            box.style.opacity = "0";
            setTimeout(() => box.remove(), 600);
        }, 5000);

        return false;
    }

});


}

document.addEventListener("DOMContentLoaded", function () {

    console.log("Admin JS Loaded");

    /* =====================================
        1. FILL EDIT MODAL WITH OLD DATA
    ====================================== */

    document.querySelectorAll(".editBtn").forEach(btn => {

        btn.addEventListener("click", function () {

            document.getElementById("id").value = this.dataset.id;
            document.getElementById("firstName").value = this.dataset.first;
            document.getElementById("lastName").value = this.dataset.last;
            document.getElementById("dob").value = this.dataset.dob;

            // Gender
            document.querySelectorAll("input[name='gender']").forEach(r => {
                r.checked = (r.value === this.dataset.gender);
            });

            // Education
            document.getElementById("education").value = this.dataset.education;

            // Email & Phone
            document.getElementById("email").value = this.dataset.email;
            document.getElementById("phone").value = this.dataset.phone;

            // Course
            document.querySelectorAll("input[name='course']").forEach(r => {
                r.checked = (r.value === this.dataset.course);
            });

            // Address fields
            document.getElementById("address1").value = this.dataset.address1;
            document.getElementById("address2").value = this.dataset.address2;
            document.getElementById("city").value = this.dataset.city;
            document.getElementById("state").value = this.dataset.state;
            document.getElementById("zip").value = this.dataset.zip;
            document.getElementById("country").value = this.dataset.country;

        });
    });


    /* =====================================
        2. EDIT FORM VALIDATION
    ====================================== */

    const form = document.getElementById("editForm");
    if (form) {

        form.addEventListener("submit", function (e) {

            let valid = true;

            function err(id, msg) {
                valid = false;
                document.getElementById("err-" + id).innerText = msg;
            }

            // First Name
            if (firstName.value.trim() === "")
                err("firstName", "First name required");

            // Last Name
            if (lastName.value.trim() === "")
                err("lastName", "Last name required");

            // DOB
            if (dob.value === "")
                err("dob", "Select DOB");

            // Gender
            if (![...document.getElementsByName("gender")].some(r => r.checked))
                err("gender", "Select gender");

            // Education
            if (education.value === "")
                err("education", "Select education");

            // Email
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email.value.trim()))
                err("email", "Invalid email");

            // Phone
            if (!/^\d{10}$/.test(phone.value.trim()))
                err("phone", "Enter 10-digit phone");

            // Course
            if (![...document.getElementsByName("course")].some(r => r.checked))
                err("course", "Select course");

            // Address1
            if (address1.value.trim() === "")
                err("address1", "Enter Address");

            // City
            if (city.value.trim() === "")
                err("city", "Enter City");

            if (!valid) e.preventDefault();
        });
    }


    /* =====================================
        3. AUTO-HIDE SUCCESS ALERT
    ====================================== */
    setTimeout(() => {
        let a = document.getElementById("successAlert");
        if (a) a.remove();
    }, 4000);

});

