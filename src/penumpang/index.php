<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penumpang</title>
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
                        <a href="../bus/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link">
                            Bus <i class="fas fa-bus ml-auto"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../penumpang/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="nav-link active">
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
                    <h2 class="title"><i class="fas fa-users"></i> Penumpang</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPenumpangModal">
                        <i class="fas fa-plus"></i> Tambah Penumpang
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telpon</th>
                                <th>Email</th>
                                <th>Umur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="penumpangTableBody">

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

    <!-- Modal Tambah Penumpang -->
    <div class="modal fade" id="addPenumpangModal" tabindex="-1" aria-labelledby="addPenumpangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPenumpangModalLabel">Tambah Penumpang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="namaPenumpang" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="namaPenumpang" name="namaPenumpang">
                        </div>
                        <div class="mb-3">
                            <label for="alamatPenumpang" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamatPenumpang" name="alamatPenumpang">
                        </div>
                        <div class="mb-3">
                            <label for="noTelponPenumpang" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" id="noTelponPenumpang" name="noTelponPenumpang">
                        </div>
                        <div class="mb-3">
                            <label for="noSimEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="noSimEmail" name="noSimEmail">
                        </div>
                        <div class="mb-3">
                            <label for="umurPenumpang" class="form-label">Umur</label>
                            <input type="text" class="form-control" id="umurPenumpang" name="umurPenumpang">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Penumpang -->
    <div class="modal fade" id="editPenumpangModal" tabindex="-1" aria-labelledby="editPenumpangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenumpangModalLabel">Edit Penumpang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPenumpangForm">
                        <div class="mb-3">
                            <label for="editIdPenumpang" class="form-label">ID Penumpang</label>
                            <input type="text" class="form-control" id="editIdPenumpang" name="editIdPenumpang"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editNamaPenumpang" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNamaPenumpang" name="editNamaPenumpang">
                        </div>
                        <div class="mb-3">
                            <label for="editAlamatPenumpang" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="editAlamatPenumpang" name="editAlamatPenumpang">
                        </div>
                        <div class="mb-3">
                            <label for="editNoTeleponPenumpang" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" id="editNoTeleponPenumpang"
                                name="editNoTeleponPenumpang">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="editEmail" name="editEmail">
                        </div>
                        <div class="mb-3">
                            <label for="editUmurPenumpang" class="form-label">Umur</label>
                            <input type="text" class="form-control" id="editUmurPenumpang" name="editUmurPenumpang">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Penumpang -->
    <div class="modal fade" id="deletePenumpangModal" tabindex="-1" aria-labelledby="deletePenumpangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePenumpangModalLabel">Delete Penumpang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data penumpang ini?</p>
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
            fetch('http://localhost/UAP_WEB/database/penumpang/getAll.php')
                .then(response => response.json())
                .then(data => {
                    const penumpangTableBody = document.getElementById('penumpangTableBody');
                    data.forEach(penumpang => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                                <td>${penumpang.id_penumpang}</td>
                                <td>${penumpang.nama}</td>
                                <td>${penumpang.alamat}</td>
                                <td>${penumpang.nomor_telepon}</td>
                                <td>${penumpang.email}</td>
                                <td>${penumpang.umur}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPenumpangModal" onclick="editPenumpang(${penumpang.id_penumpang}, '${penumpang.nama}', '${penumpang.alamat}', '${penumpang.nomor_telepon}', '${penumpang.email}', ${penumpang.umur})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePenumpangModal" onclick="deletePenumpang(${penumpang.id_penumpang})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            `;
                        penumpangTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        // hapus data
        function deletePenumpang(id_penumpang) {
            document.getElementById('deletePenumpangModal').querySelector('.hapus').onclick = function () {
                fetch(`http://localhost/UAP_WEB/database/penumpang/deletePenumpang.php?id_penumpang=${id_penumpang}`, {
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
        document.getElementById('editPenumpangForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const url = 'http://localhost/UAP_WEB/database/penumpang/editPenumpang.php';

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
        function editPenumpang(id, nama, alamat, nomor_telepon, email, umur) {
            document.getElementById('editIdPenumpang').value = id;
            document.getElementById('editNamaPenumpang').value = nama;
            document.getElementById('editAlamatPenumpang').value = alamat;
            document.getElementById('editNoTeleponPenumpang').value = nomor_telepon;
            document.getElementById('editEmail').value = email;
            document.getElementById('editUmurPenumpang').value = umur;
        }


        // Tambah penumpang
        document.getElementById('addPenumpangModal').querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('http://localhost/UAP_WEB/database/penumpang/addPenumpang.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menambah penumpang: ' + (data.message || 'Unknown error'));
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

                const penumpangTableBody = document.getElementById('penumpangTableBody');
                penumpangTableBody.innerHTML = '';

                paginatedData.forEach(penumpang => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${penumpang.id_penumpang}</td>
                <td>${penumpang.nama}</td>
                <td>${penumpang.alamat}</td>
                <td>${penumpang.nomor_telepon}</td>
                <td>${penumpang.email}</td>
                <td>${penumpang.umur}</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPenumpangModal" onclick="editPenumpang(${penumpang.id_penumpang}, '${penumpang.nama}', '${penumpang.alamat}', '${penumpang.nomor_telepon}', '${penumpang.email}', ${penumpang.umur})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePenumpangModal" onclick="deletePenumpang(${penumpang.id_penumpang})">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            `;
                    penumpangTableBody.appendChild(row);
                });
            }

            // Fetch data dari server
            fetch('http://localhost/UAP_WEB/database/penumpang/getAll.php')
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