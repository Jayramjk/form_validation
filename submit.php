<?php
require_once "config.php";
require_once "form_handler.php";

$db = new Edit_Form();
$conn = $db->conn;

$response = handle_form_submission($conn);

$submitted = $response["submitted"];
$errors = $response["errors"];
?>


<!DOCTYPE html>
<html>
<head>
    <title>Course Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">

<?php if (!$submitted): ?>

    <div class="center">
        <img src="images/logo.png" width="80">
        <h2>Course Application</h2>
    </div>

    <?php if (!empty($errors)): ?>
        <div style="color:red;margin-bottom:15px;">
        </div>
    <?php endif; ?>

    <form id="courseForm" method="POST">

        <!-- NAME -->
        <label>Full Name *</label>
        <div class="row">
            <div>
                <input type="text" id="firstName" name="firstName"
                       value="<?= safe('firstName') ?>" placeholder="First">
                <div class="error-message" id="err-firstName"></div>
            </div>

            <div>
                <input type="text" id="lastName" name="lastName"
                       value="<?= safe('lastName') ?>" placeholder="Last">
                <div class="error-message" id="err-lastName"></div>
            </div>
        </div>

        <!-- Course -->
        <label>Which course? *</label>
        <div class="radio-group">
            <input type="radio" name="course" value="A" <?= safe("course")=="A"?"checked":"" ?>> A
            <input type="radio" name="course" value="B" <?= safe("course")=="B"?"checked":"" ?>> B
            <input type="radio" name="course" value="C" <?= safe("course")=="C"?"checked":"" ?>> C
        </div>
        <div class="error-message" id="err-course"></div>

        <!-- DOB -->
        <label>DOB *</label>
        <input type="date" id="dob" name="dob" value="<?= safe('dob') ?>">
        <div class="error-message" id="err-dob"></div>

        <!-- Gender -->
        <label>Gender *</label>
        <div class="radio-group">
            <input type="radio" name="gender" value="Male" <?= safe("gender")=="Male"?"checked":"" ?>> Male
            <input type="radio" name="gender" value="Female" <?= safe("gender")=="Female"?"checked":"" ?>> Female
        </div>
        <div class="error-message" id="err-gender">kkk</div>

        <!-- Education -->
        <label>Education *</label>
        <select id="education" name="education">
            <option value="">Select</option>
            <option <?= safe('education')=="10th"?'selected':'' ?>>10th</option>
            <option <?= safe('education')=="12th"?'selected':'' ?>>12th</option>
            <option <?= safe('education')=="Graduate"?'selected':'' ?>>Graduate</option>
            <option <?= safe('education')=="Post Graduate"?'selected':'' ?>>Post Graduate</option>
        </select>
        <div class="error-message" id="err-education"></div>

        <!-- Email -->
        <label>Email *</label>
        <input type="email" id="email" name="email" value="<?= safe('email') ?>">
        <div class="error-message" id="err-email"></div>

        <!-- Phone -->
        <label>Phone *</label>
        <input type="number" id="phone" name="phone" value="<?= safe('phone') ?>">
        <div class="error-message" id="err-phone"></div>

        <!-- Address -->
        <label>Address</label>

        <input type="text" id="address1" name="address1"
               value="<?= safe('address1') ?>" placeholder="Street Address">
        <div class="error-message" id="err-address1"></div>

        <input type="text" id="address2" name="address2"
               value="<?= safe('address2') ?>" placeholder="Address Line 2">

        <div class="row">
            <div>
                <input type="text" id="city" name="city" value="<?= safe('city') ?>" placeholder="City">
                <div class="error-message" id="err-city"></div>
            </div>
            <div>
                <input type="text" id="state" name="state" value="<?= safe('state') ?>" placeholder="State">
                <div class="error-message" id="err-state"></div>
            </div>
        </div>

        <div class="row">
            <div>
                <input type="text" id="zip" name="zip" value="<?= safe('zip') ?>" placeholder="Zip">
                <div class="error-message" id="err-zip"></div>
            </div>
            <div>
                <select id="country" name="country">
                    <option value="">Country</option>
                    <option <?= safe('country')=="India"?'selected':'' ?>>India</option>
                    <option <?= safe('country')=="USA"?'selected':'' ?>>USA</option>
                    <option <?= safe('country')=="UK"?'selected':'' ?>>UK</option>
                </select>
                <div class="error-message" id="err-country"></div>
            </div>
        </div>

        <div style="margin-top:20px;">
            <input type="checkbox" id="terms" name="terms" required>
            I accept the Terms & Conditions.
        </div>

        <button class="submit-btn">Submit</button>
    </form>

<?php else: ?>

    <div class="success-box">
        <h2>🎉 Successfully Applied! Data Saved in MySQL</h2>

        <p><strong>Name:</strong> <?= safe("firstName") . " " . safe("lastName") ?></p>
        <p><strong>DOB:</strong> <?= safe("dob") ?></p>
        <p><strong>Gender:</strong> <?= safe("gender") ?></p> 
        <p><strong>Course:</strong> <?= safe("course") ?></p>
        <p><strong>Education:</strong> <?= safe("education") ?></p>
        <p><strong>Email:</strong> <?= safe("email") ?></p>
        <p><strong>Phone:</strong> <?= safe("phone") ?></p>

        <h3>Address</h3>
        <p>
            <?= safe("address1") ?><br>
            <?= safe("address2") ?><br>
            <?= safe("city") ?>, <?= safe("state") ?> - <?= safe("zip") ?><br>
            <?= safe("country") ?>
        </p>

        <br><br>
        <a href="submit.php"><button class="submit-btn">Apply Again</button></a><a href="admin-login/login.php"><button class="submit-btn">Admin Table </button></a>
    </div>

<?php endif; ?>

</div>

<script src="index.js"></script>

</body>
</html>
