<?php
session_start();
include "config/db.php";


$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    if ($email == "" || $password == "") {
        $error = "Email and password are required!";
    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role= 2 LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if ($admin && password_verify($password, $admin['password'])) {

            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['admin_name'] = $admin['name'];

            header('Location: index.php');
            exit;

        } else {
            $error = "Invalid email or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">



<div class="login-wrapper">
    <div class="login-card">

        <h2>Admin Login</h2>

        <?php if($error != "") { ?>
            <div class="error"><?= $error ?></div>
        <?php } ?>

        <form method="POST" id="loginForm">

            <label>Email:</label>
            <input type="email" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

            <label>Password:</label>
            <div class="pass-wrap">
                <input type="password" name="password" id="password" required>
                <button type="button" id="togglePass">Show Password</button>
            </div>


            <button type="submit" name="login" class="btn btn-edit">Login</button>
        </form>

        <div class="login-footer">
            Basic Form Project • Admin Panel
        </div>

    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {

        // Validation
        $("#loginForm").validate({
            rules: {
                email: { required: true, email: true },
                password: { required: true, minlength: 5 }
            }
        });

        // Show/Hide Password
        $("#togglePass").click(function () {

            let passField = $("#password");

            if (passField.attr("type") === "password") {
                passField.attr("type", "text");
                $(this).text("Hide Password");
            } else {
                passField.attr("type", "password");
                $(this).text("Show Password");
            }

        });

    });
</script>




</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {

        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Enter a valid email"
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 5 characters"
                }
            }
        });

    });
</script>


</body>
</html>
