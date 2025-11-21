<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
</head>

<body>

<div class="login-card">
    <h3>Admin Login</h3>

    <?php if (isset($_SESSION['error'])): ?>
        <div id="errorBox" class="error-box"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="login_process.php" method="POST" id="loginform">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" >
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" >
        </div>

        <button type="submit" class="btn-custom">Login</button>
    </form>
</div>
<script src="admin_index.js"></script>
</body>
</html>
