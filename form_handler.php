<?php
// ------------------------------------
// FORM HANDLING LOGIC INSIDE A FUNCTION
// ------------------------------------

function handle_form_submission($conn)
{
    $errors = [];
    $submitted = false;

    // SAFE FUNCTION
    function safe($key) {
        return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : "";
    }

    // RUN VALIDATION ONLY WHEN SUBMITTED
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // If NO ERRORS → INSERT INTO DATABASE
        if (empty($errors)) {

            $sql = "INSERT INTO users (
                first_name, last_name, dob, gender, education, email, phone, course, 
                address1, address2, city, state, zip, country
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "ssssssssssssss",
                $_POST["firstName"],
                $_POST["lastName"], 
                $_POST["dob"],
                $_POST["gender"],
                $_POST["education"],
                $_POST["email"],
                $_POST["phone"],
                $_POST["course"],
                $_POST["address1"],
                $_POST["address2"],
                $_POST["city"],
                $_POST["state"],
                $_POST["zip"],
                $_POST["country"]
            );

            if ($stmt->execute()) {
                $submitted = true;
            } else {
                $errors[] = "Database Insert Failed: " . $stmt->error;
            }
        }
    }

    // RETURN BACK VALUES
    return [
        "submitted" => $submitted,
        "errors" => $errors
    ];
}

function update_user($conn)
{
    if (!isset($_POST['update'])) {
        return; // No update action
    }

    $id = $_POST['id'];

    $stmt = $conn->prepare("
        UPDATE users SET
            first_name=?, last_name=?, dob=?, gender=?, education=?,
            email=?, phone=?, course=?, address1=?, address2=?,
            city=?, state=?, zip=?, country=?
        WHERE id=?
    ");

    $stmt->bind_param(
        "ssssssssssssssi",
        $_POST['firstName'], $_POST['lastName'], $_POST['dob'], $_POST['gender'], $_POST['education'],
        $_POST['email'], $_POST['phone'], $_POST['course'], $_POST['address1'], $_POST['address2'],
        $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['country'], $id
    );

    if ($stmt->execute()) {
        $_SESSION['success'] = ucfirst($_POST['firstName']) . " " . ucfirst($_POST['lastName']) . " updated successfully!";
        header("Location: admin.php");
        exit();
    }
}
?>
