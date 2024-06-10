<?php
session_start();
require_once('../../database/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email ada di database
    $sql = "SELECT id, name, email, password FROM admin WHERE email = ?";
    if ($stmt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Jika email ditemukan, verifikasi password
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $id, $name, $email, $hashed_password);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $hashed_password)) {
                // Password benar, set session
                $_SESSION['admin_id'] = $id;
                $_SESSION['admin_name'] = $name;

                echo "<script>alert('Login Berhasil. Alihkan ke dashboard...'); window.location.href = '../home/index.php?id=$id';</script>";
                exit;
            } else {
                // Password salah
                echo "<script>alert('Password salah.'); window.location.href = 'index.php';</script>";
                exit;
            }
        } else {
            // Email tidak ditemukan
            echo "<script>alert('Email tidak ditemukan.'); window.location.href = 'index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($connection) . "'); window.location.href = 'index.html';</script>";
        exit;
    }
}
mysqli_close($connection);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Expedia Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-container .form-control:focus {
            box-shadow: none;
            border-color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .logo {
            display: block;
            margin: 0 auto 1rem auto;
            width: 100px;
        }

        .signup-link {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="../../image/logo.png" alt="Expedia Logo" class="logo">
        <h3 class="text-center mb-4">Admin Login</h3>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>

            <div class="signup-link">
                <p>Don't have an account? <a href="register/index.php">Sign Up</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>