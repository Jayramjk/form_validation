/* =============================================
    index.js - FIXED VALIDATION + MODAL SUPPORT
============================================== */

function showError(id, message) {
    const field = document.getElementById(id);
    const error = document.getElementById("err-" + id);
    if (error) {
        error.innerText = message;
        error.style.display = "block";
    }
    if (field) field.classList.add("error-field");
}

function clearError(id) {
    const field = document.getElementById(id);
    const error = document.getElementById("err-" + id);
    if (error) error.style.display = "none";
    if (field) field.classList.remove("error-field");
}

// ===============================
//  VALIDATE COURSE FORM ONLY
// ===============================
const courseForm = document.getElementById("courseForm");

if (courseForm) {
    courseForm.addEventListener("submit", function (e) {

        let isValid = true;
        let firstError = null;

        function setError(id, msg) {
            showError(id, msg);
            if (isValid) firstError = document.getElementById(id);
            isValid = false;
        }

        // FIRST NAME
        let fname = firstName.value.trim();
        if (fname === "") setError("firstName", "First name required");
        else if (fname.length < 3) setError("firstName", "Minimum 3 characters");
        else if (!/^[A-Za-z]+$/.test(fname)) setError("firstName", "Only letters allowed");
        else clearError("firstName");

        // LAST NAME
        let lname = lastName.value.trim();
        if (lname === "") setError("lastName", "Last name required");
        else if (!/^[A-Za-z]+$/.test(lname)) setError("lastName", "Only letters");
        else clearError("lastName");

        // COURSE
        let courseOk = [...document.getElementsByName("course")].some(r => r.checked);
        if (!courseOk) {
            showError("course", "Please select a course");
            isValid = false;
        } else clearError("course");

        // DOB
        if (dob.value === "") setError("dob", "Select DOB");
        else clearError("dob");

        // GENDER
        let genderOk = [...document.getElementsByName("gender")].some(r => r.checked);
        if (!genderOk) {
            showError("gender", "Please select gender");
            isValid = false;
        } else clearError("gender");

        // EDUCATION
        if (education.value === "") setError("education", "Select education");
        else clearError("education");

        // EMAIL
        let emailVal = email.value.trim();
        let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!pattern.test(emailVal)) setError("email", "Invalid email");
        else clearError("email");

        // PHONE
        if (!/^\d{10}$/.test(phone.value.trim()))
            setError("phone", "Phone must be 10 digits");
        else clearError("phone");

        // ADDRESS
        if (address1.value.trim() === "") setError("address1", "Enter address");
        else clearError("address1");

        if (city.value.trim() === "") setError("city", "Enter city");
        else clearError("city");

        if (state.value.trim() === "") setError("state", "Enter state");
        else clearError("state");

        if (zip.value.trim() === "") setError("zip", "Enter zip code");
        else clearError("zip");

        if (country.value.trim() === "") setError("country", "Select country");
        else clearError("country");

        // TERMS
        let terms = document.getElementById("terms");
        if (terms && !terms.checked) {
            showError("terms", "You must accept terms");
            isValid = false;
        } else clearError("terms");

        if (!isValid) {
            e.preventDefault();
            firstError?.focus();
        }
    });
}

// ===============================
// REAL TIME CLEARING (IMPORTANT)
// ===============================
document.querySelectorAll("input, select").forEach(field => {

    field.addEventListener("input", () => {
        if (field.id) clearError(field.id);
    });

    field.addEventListener("change", () => {
        if (field.id) clearError(field.id);

        // Hide radio group error properly
        if (field.name === "course") clearError("course");
        if (field.name === "gender") clearError("gender");
        if (field.name === "terms") clearError("terms");
    });

});

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
===================================== */

const form = document.getElementById("editForm");

if (form) {
    form.addEventListener("submit", function (e) {

        let valid = true;

        // CLEAR OLD ERRORS
        document.querySelectorAll("small[id^='err-']").forEach(el => {
            el.innerText = "";
        });

        function err(id, msg) {
            valid = false;
            let errorBox = document.getElementById("err-" + id);
            if (errorBox) {
                errorBox.innerText = msg;
                errorBox.style.display = "block";
            }
        }
       
      // FIRST NAME
        let ename = firstName.value.trim();
        if (ename === "") 
            {
            err("firstName", "First name required");
            }
        else if (ename.length < 5) {
            err("firstName", "Minimum 5 characters");
            }
        else if (!/^[A-Za-z]+$/.test(ename)) {
            err("firstName", "Only letters allowed");
            }   
        
        // LAST NAME
        let elastname = lastName.value.trim();
        if (elastname === "") err("lastName", "Last name required");
        else if (!/^[A-Za-z]+$/.test(elastname)) err("lastName", "Only letters");

        // DOB
        if (dob.value === "")
            err("dob", "Select DOB");

        // GENDER
        if (![...document.getElementsByName("gender")].some(r => r.checked))
            err("gender", "Select gender");

        // EDUCATION
        if (education.value === "")
            err("education", "Select education");

        // EMAIL
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value.trim()))
            err("email", "Invalid email");

        // PHONE
        if (!/^\d{10}$/.test(phone.value.trim()))
            err("phone", "Enter 10-digit phone number");

        // COURSE
        if (![...document.getElementsByName("course")].some(r => r.checked))
            err("course", "Select course");

        // ADDRESS 1
        if (address1.value.trim() === "")
            err("address1", "Enter Address");

        // CITY
        if (city.value.trim() === "")
            err("city", "Enter city");

        // STATE
        if (state.value.trim() === "")
            err("state", "Enter state");

        // ZIP
        if (zip.value.trim() === "")
            err("zip", "Enter ZIP");

        // COUNTRY
        if (country.value.trim() === "")
            err("country", "Enter country");

        if (!valid) {
            e.preventDefault();
        }

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