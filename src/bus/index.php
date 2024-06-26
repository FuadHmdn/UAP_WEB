<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
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

        .pagination {
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .pagination button {
            background-color: transparent;
            color: #007bff;
            border: none;
            padding: 5px 10px;
            margin-right: 5px;
            cursor: pointer;
        }

        .pagination button:hover {
            background-color: #007bff;
            color: #fff;
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
                        <a href="../home/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link">
                            Dashboard <i class="fas fa-tachometer-alt ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../supir/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link">
                            Supir <i class="fas fa-user-tie ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../bus/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link active">
                            Bus <i class="fas fa-bus ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../penumpang/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link">
                            Penumpang <i class="fas fa-users ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-3 ">
                <div class="d-flex justify-content-between align-items-center mb-3" style=" margin-top: 20px;">
                    <h2 class="title"><i class="fas fa-bus"></i> Bus</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBusModal">
                        <i class="fas fa-plus"></i> Tambah Bus
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>ID Bus</th>
                                <th>Nomor Polisi</th>
                                <th>Kapasitas</th>
                                <th>Model</th>
                                <th>Tahun Pembuatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="busTableBody">

                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <button id="prevPageBtn" class="btn btn-primary">&laquo; Sebelumnya</button>
                    <button id="nextPageBtn" class="btn btn-primary">Berikutnya &raquo;</button>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Tambah Bus -->
    <div class="modal fade" id="addBusModal" tabindex="-1" aria-labelledby="addBusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBusModalLabel">Tambah Bus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nomorPolisi" class="form-label">Nomor Polisi</label>
                            <input type="text" class="form-control" id="nomorPolisi" name="nomorPolisi">
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="text" class="form-control" id="kapasitas" name="kapasitas">
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" id="model" name="model">
                        </div>
                        <div class="mb-3">
                            <label for="tahunPembuatan" class="form-label">Tahun Pembuatan</label>
                            <input type="date" class="form-control" id="tahunPembuatan" name="tahunPembuatan">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit BUS -->
    <div class="modal fade" id="editBusModal" tabindex="-1" aria-labelledby="editBusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBusModalLabel">Edit Bus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBusForm">
                        <div class="mb-3">
                            <label for="editIdBus" class="form-label">ID Bus</label>
                            <input type="text" class="form-control" id="editIdBus" name="editIdBus" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editNomorPolisi" class="form-label">Nomor Polisi</label>
                            <input type="text" class="form-control" id="editNomorPolisi" name="editNomorPolisi">
                        </div>
                        <div class="mb-3">
                            <label for="editKapasitas" class="form-label">Kapasitas</label>
                            <input type="text" class="form-control" id="editKapasitas" name="editKapasitas">
                        </div>
                        <div class="mb-3">
                            <label for="editModel" class="form-label">Model</label>
                            <input type="text" class="form-control" id="editModel" name="editModel">
                        </div>
                        <div class="mb-3">
                            <label for="editTahunPembuatan" class="form-label">Tahun Pembuatan</label>
                            <input type="date" class="form-control" id="editTahunPembuatan" name="editTahunPembuatan">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus BUS -->
    <div class="modal fade" id="deleteBusModal" tabindex="-1" aria-labelledby="deleteBusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBusModalLabel">Delete Bus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data bus ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger hapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    <script>
        // menampilkan data
        document.addEventListener('DOMContentLoaded', function () {
            fetch('http://localhost/UAP_WEB/database/bus/getAll.php')
                .then(response => response.json())
                .then(data => {
                    const busTableBody = document.getElementById('busTableBody');
                    data.forEach(bus => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                                <td>${bus.id_bus}</td>
                                <td>${bus.nomor_polisi}</td>
                                <td>${bus.kapasitas}</td>
                                <td>${bus.model}</td>
                                <td>${bus.tahun_pembuatan}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBusModal" onclick="editBus(${bus.id_bus}, '${bus.nomor_polisi}', '${bus.kapasitas}', '${bus.model}', '${bus.tahun_pembuatan}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBusModal" onclick="deleteBus(${bus.id_bus})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            `;
                        busTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        // hapus data
        function deleteBus(id_bus) {
            document.getElementById('deleteBusModal').querySelector('.hapus').onclick = function () {
                fetch(`http://localhost/UAP_WEB/database/bus/deleteBus.php?id_bus=${id_bus}`, {
                    method: 'DELETE'
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Gagal menghapus item');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            };
        }

        // Edit data
        document.getElementById('editBusForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const url = 'http://localhost/UAP_WEB/database/bus/editBus.php';

            fetch(url, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menghapus item: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => console.error('Error:', error));
        });
        function editBus(id, nomor_polisi, kapasitas, model, tahun_pembuatan) {
            document.getElementById('editIdBus').value = id;
            document.getElementById('editNomorPolisi').value = nomor_polisi;
            document.getElementById('editKapasitas').value = kapasitas;
            document.getElementById('editModel').value = model;
            document.getElementById('editTahunPembuatan').value = tahun_pembuatan;
        }


        // Tambah Bus
        document.getElementById('addBusModal').querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('http://localhost/UAP_WEB/database/bus/addBus.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menambah bus: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => console.error('Error adding data:', error));
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const itemsPerPage = 15;
            let currentPage = 1;
            let data = [];

            // Fungsi untuk menampilkan data berdasarkan halaman yang dipilih
            function displayData(page) {
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const paginatedData = data.slice(startIndex, endIndex);

                const penumpangTableBody = document.getElementById('busTableBody');
                penumpangTableBody.innerHTML = '';

                paginatedData.forEach(bus => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                                <td>${bus.id_bus}</td>
                                <td>${bus.nomor_polisi}</td>
                                <td>${bus.kapasitas}</td>
                                <td>${bus.model}</td>
                                <td>${bus.tahun_pembuatan}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBusModal" onclick="editBus(${bus.id_bus}, '${bus.nomor_polisi}', '${bus.kapasitas}', '${bus.model}', '${bus.tahun_pembuatan}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteBusModal" onclick="deleteBus(${bus.id_bus})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>`;
                    penumpangTableBody.appendChild(row);
                });
            }

            // Fetch data dari server
            fetch('http://localhost/UAP_WEB/database/bus/getAll.php')
                .then(response => response.json())
                .then(responseData => {
                    data = responseData;
                    displayData(currentPage);
                })
                .catch(error => console.error('Error fetching data:', error));

            // Fungsi untuk menampilkan halaman berikutnya
            document.getElementById('nextPageBtn').addEventListener('click', function () {
                if (currentPage < Math.ceil(data.length / itemsPerPage)) {
                    currentPage++;
                    displayData(currentPage);
                }
            });

            // Fungsi untuk menampilkan halaman sebelumnya
            document.getElementById('prevPageBtn').addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    displayData(currentPage);
                }
            });
        });

    </script>
</body>

</html>