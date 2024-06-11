<?php
require_once('../../database/koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $profile_picture = '';

    // Pengecekan apakah foto profil telah diunggah
    if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] != 0) {
        echo "<script>alert('Silakan upload foto profil.'); window.history.back();</script>";
        exit;
    }

    // Proses upload foto profil
    $target_dir = "../../image/upload/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = $target_file;
        } else {
            echo "<script>alert('Maaf, ada kesalahan saat mengupload foto.')";
            exit;
        }
    } else {
        echo "<script>alert('File bukan berupa image.'); window.history.back();</script>";
        exit;
    }

    // Pengecekan apakah email sudah terdaftar
    $sql_check_email = "SELECT email FROM admin WHERE email = ?";
    if ($stmt_check = mysqli_prepare($connection, $sql_check_email)) {
        mysqli_stmt_bind_param($stmt_check, "s", $email);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            echo "<script>alert('Email sudah terdaftar.'); window.history.back();</script>";
            exit;
        }

        mysqli_stmt_close($stmt_check);
    } else {
        echo "<script>alert('Error checking email: " . mysqli_error($connection) . "'); window.history.back();</script>";
        exit;
    }

    // Menyimpan data ke database
    $sql = "INSERT INTO admin (name, email, password, phone, address, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $password, $phone, $address, $profile_picture);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registrasi Berhasil. Alihkan ke halaman login...'); window.location.href = '../login/index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error: " . mysqli_error($connection) . "'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error preparing statement: " . mysqli_error($connection) . "'); window.history.back();</script>";
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
    <title>Admin Expedia Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        .register-container .form-control:focus {
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

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-col {
            flex: 0 0 48%;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2 class="text-center mb-4">Admin Register</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="7" placeholder="Enter your address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profile-picture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profile-picture" name="profile_picture">
                    </div>
                </div>
            </div>
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="../login/index.php">Login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>