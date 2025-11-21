<?php 

require_once "auth.php"; 
require_once "config.php";
require_once "form_handler.php";

$db = new Edit_Form();
$conn = $db->conn;

// CALL THE FUNCTION
update_user($conn);

// FETCH USERS
$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - User Records</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- TOP BAR -->
<div class="d-flex justify-content-between align-items-center p-3 bg-dark text-white">
    <h4 class="m-0">Welcome, <?= $_SESSION['admin']; ?></h4>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</div>

<div class="container mt-5">
    <h2 class="text-center fw-bold mb-4">Admin Panel - User Records</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div id="successAlert" class="alert alert-success text-center">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="card shadow-lg">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>S.No</th>
                            <th>First</th>
                            <th>Last</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Education</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Address</th>
                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $sn = 1; ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $sn++; ?></td>
                            <td><?= $row['first_name'] ?></td>
                            <td><?= $row['last_name'] ?></td>
                            <td><?= $row['dob'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['education'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td><?= $row['course'] ?></td>
                            <td>
                                <?= $row['address1'] ?><br>
                                <?= $row['address2'] ?><br>
                                <?= $row['city'] ?>, <?= $row['state'] ?> - <?= $row['zip'] ?><br>
                                <?= $row['country'] ?>
                            </td>

                            <td>
                                <button class="btn btn-primary btn-sm editBtn"
                                    data-id="<?= $row['id'] ?>"
                                    data-first="<?= $row['first_name'] ?>"
                                    data-last="<?= $row['last_name'] ?>"
                                    data-dob="<?= $row['dob'] ?>"
                                    data-gender="<?= $row['gender'] ?>"
                                    data-education="<?= $row['education'] ?>"
                                    data-email="<?= $row['email'] ?>"
                                    data-phone="<?= $row['phone'] ?>"
                                    data-course="<?= $row['course'] ?>"
                                    data-address1="<?= $row['address1'] ?>"
                                    data-address2="<?= $row['address2'] ?>"
                                    data-city="<?= $row['city'] ?>"
                                    data-state="<?= $row['state'] ?>"
                                    data-zip="<?= $row['zip'] ?>"
                                    data-country="<?= $row['country'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                >
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form method="POST" id="editForm">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <input type="hidden" name="id" id="id">

            <div class="row g-2">

                <div class="col-md-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstName" id="firstName">
                    <small id="err-firstName" class="text-danger"></small>
                </div>

                <div class="col-md-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lastName" id="lastName">
                    <small id="err-lastName" class="text-danger"></small>
                </div>

                <div class="col-md-4">
                    <label>DOB</label>
                    <input type="date" class="form-control" name="dob" id="dob">
                    <small id="err-dob" class="text-danger"></small>
                </div>

                <div class="col-md-4">
                    <label>Gender</label><br>
                    <label><input type="radio" name="gender" value="Male"> Male</label>
                    <label><input type="radio" name="gender" value="Female"> Female</label>
                    <small id="err-gender" class="text-danger"></small>
                </div>

                <div class="col-md-4">
                    <label>Education</label>
                    <select name="education" id="education" class="form-control">
                        <option value="">Select</option>
                        <option value="10th">10th</option>
                        <option value="12th">12th</option>
                        <option value="Graduate">Graduate</option>
                        <option value="Post Graduate">Post Graduate</option>
                    </select>
                    <small id="err-education" class="text-danger"></small>
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <small id="err-email" class="text-danger"></small>
                </div>

                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone">
                    <small id="err-phone" class="text-danger"></small>
                </div>

                <div class="col-md-6">
                    <label>Course</label><br>
                    <label><input type="radio" name="course" value="A"> A</label>
                    <label><input type="radio" name="course" value="B"> B</label>
                    <label><input type="radio" name="course" value="C"> C</label>
                    <small id="err-course" class="text-danger"></small>
                </div>

                <div class="col-md-6">
                    <label>Address 1</label>
                    <input type="text" class="form-control" name="address1" id="address1">
                    <small id="err-address1" class="text-danger"></small>
                </div>

                <div class="col-md-6">
                    <label>Address 2</label>
                    <input type="text" class="form-control" name="address2" id="address2">
                </div>

                <div class="col-md-4">
                    <label>City</label>
                    <input type="text" class="form-control" name="city" id="city">
                    <small id="err-city" class="text-danger"></small>
                </div>

                <div class="col-md-4">
                    <label>State</label>
                    <input type="text" class="form-control" name="state" id="state">
                    <small id="err-state" class="text-danger"></small>
                </div>

                <div class="col-md-2">
                    <label>Zip</label>
                    <input type="text" class="form-control" name="zip" id="zip">
                    <small id="err-zip" class="text-danger"></small>
                </div>

                <div class="col-md-2">
                    <label>Country</label>
                    <input type="text" class="form-control" name="country" id="country">
                    <small id="err-country" class="text-danger"></small>
                </div>

            </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="update" class="btn btn-success">Update</button>
        </div>

      </form>

    </div>
  </div>
</div>

<!-- JS -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="index.js"></script>

</body>
</html>
