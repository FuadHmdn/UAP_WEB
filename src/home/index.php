<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F5F5F6;
        }

        .sidebar {
            height: auto;
            background-color: #fff;
            padding-top: 20px;
            border-right: 1px solid #dee2e6;
        }

        .sidebar h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 7px;
        }

        .sidebar a.nav-link {
            padding-left: 10px;
            padding-right: 10px;
        }

        .sidebar ul li a {
            color: #495057;
            text-decoration: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a.active,
        .sidebar ul li a:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .dashboard-title {
            margin-top: 30px;
            display: flex;
            align-items: center;
        }

        .dashboard-title h1 {
            margin: 0;
            font-size: 2rem;
            color: #343a40;
        }

        .dashboard-title i {
            margin-right: 10px;
            color: #007bff;
        }

        .info-box {
            padding: 20px;
            color: #424040;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 20px;
        }

        .info-box i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .info-box h4 {
            margin: 0;
            font-size: 20px;
        }

        .info-box p {
            font-size: 3.5rem;
            font-weight: 600;
            margin: 0;
        }

        .info-box.blue {
            background-color: #add7f8;
        }

        .info-box.yellow {
            background-color: #fcedb1;
        }

        .info-box.purple {
            background-color: #e3cbfc;
        }

        .menu-box {
            padding: 20px;
            border-radius: 15px;
            background-color: #cde0f3;
            color: #424040;
            margin-bottom: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .menu-box:hover {
            background-color: #99bfe7;
        }

        .recent-activity-title {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .recent-activity-title h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #343a40;
        }

        .recent-activity-title i {
            margin-right: 10px;
            color: #007bff;
        }


        .table {
            margin-top: 20px;
        }

        .title-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .title-container img {
            width: 40px;
            margin-right: 10px;
        }

        .title-container h2 {
            margin-top: 20px
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Navigasi -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="title-container">
                    <img src="../../image/logo.png" alt="Expedia Logo">
                    <h2 class="title">Expedia</h2>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../home/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link active">
                            Dashboard <i class="fas fa-tachometer-alt ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../supir/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link">
                            Supir <i class="fas fa-user-tie ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../bus/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link">
                            Bus <i class="fas fa-bus ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../penumpang/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link">
                            Penumpang <i class="fas fa-users ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Akun
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="akunDropdown">
                            <li><a class="dropdown-item" href="../profile/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="../login/index.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Main -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="dashboard-title">
                    <i class="fas fa-tachometer-alt"></i>
                    <h1>Dashboard</h1>
                </div>

                <div class="row mt-4 box1">
                    <div class="col-md-4">
                        <div class="info-box blue">
                            <i class="fas fa-user-tie"></i>
                            <h4>Jumlah Supir</h4>
                            <p id="jumlah_supir">0</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box yellow">
                            <i class="fas fa-users"></i>
                            <h4>Jumlah Penumpang</h4>
                            <p id="jumlah_penumpang">0</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box purple">
                            <i class="fas fa-bus"></i>
                            <h4>Jumlah Bus</h4>
                            <p id="jumlah_bus">0</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 box1">
                    <div class="col-md-6">
                        <div class="menu-box" id="perjalanan">
                            <h4><i class="fas fa-bus"></i> Perjalanan</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-box" id="transaksi">
                            <h4><i class="fas fa-receipt"></i> Transaksi</h4>
                        </div>
                    </div>

                    <div class="recent-activity-title box2">
                        <i class="fas fa-history"></i>
                        <h2>Recent Activity</h2>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Email/Phone/No Polisi</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody id="activityTableBody">

                        </tbody>
                    </table>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://localhost/UAP_WEB/database/dashboard/getData.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('jumlah_supir').innerText = data.jumlah_supir;
                    document.getElementById('jumlah_penumpang').innerText = data.jumlah_penumpang;
                    document.getElementById('jumlah_bus').innerText = data.jumlah_bus;
                })
                .catch(error => console.error('Error fetching data:', error));

            fetch('http://localhost/UAP_WEB/database/dashboard/getRecentActivity.php')
                .then(response => response.json())
                .then(data => {
                    const activityTableBody = document.getElementById('activityTableBody');
                    activityTableBody.innerHTML = '';
                    data.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${item.name}</td>
                            <td>${item.contact ? item.contact : 'N/A'}</td>
                            <td>${item.joined}</td>
                            <td>${item.type}</td>
                        `;
                        activityTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching recent activities:', error));
        });
    </script>

    <script>
        document.getElementById('perjalanan').onclick = function() {
            window.location.href = '../perjalanan/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>';
        };

        document.getElementById('transaksi').onclick = function() {
            window.location.href = '../transaksi/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>';
        };
    </script>

</body>

</html>