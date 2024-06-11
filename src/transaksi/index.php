<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .main-content {
            padding: 20px;
        }

        .main-content h2 {
            color: #343a40;
            margin-bottom: 20px;
        }

        .table thead {
            background-color: #e9ecef;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.5rem;
        }

        .btn-close:hover {
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
            <!-- Main -->
            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4 mt-3">
                <div class="d-flex justify-content-between align-items-center mb-3" style=" margin-top: 20px;">
                    <a href="../home/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                    <h2 class="title"><i class="fas fa-user-tie"></i> Transaksi</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransaksiModal">
                        <i class="fas fa-plus"></i> Tambah Transaksi
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Perjalanan</th>
                                <th>Penumpang</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Bayar</th>
                                <th>Metode Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="transaksiTableBody">

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

    <!-- Modal Tambah Transaksi -->
    <div class="modal fade" id="addTransaksiModal" tabindex="-1" aria-labelledby="addTransaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="rute" class="form-label">Rute</label>
                            <select class="form-select" id="rute" name="rute"></select>
                        </div>
                        <div class="mb-3">
                            <label for="namaPenumpang" class="form-label">Penumpang</label>
                            <select class="form-select" id="namaPenumpang" name="namaPenumpang"></select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="tiket" class="form-label">Jumlah Tiket</label>
                            <input type="text" class="form-control" id="tiket" name="tiket">
                        </div>
                        <div class="mb-3">
                            <label for="totalBayar" class="form-label">Total Bayar</label>
                            <input type="text" class="form-control" id="totalBayar" name="totalBayar">
                        </div>
                        <div class="mb-3">
                            <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                            <input type="text" class="form-control" id="pembayaran" name="pembayaran">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Supir -->
    <div class="modal fade" id="deleteTransaksiModal" tabindex="-1" aria-labelledby="deleteTransaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTransaksiModalLabel">Hapus Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data transaksi ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger hapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        // menampilkan data
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://localhost/UAP_WEB/database/admin/getTransaksi.php')
                .then(response => response.json())
                .then(data => {
                    const transaksiTableBody = document.getElementById('transaksiTableBody');
                    data.forEach(transaksi => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                                <td>${transaksi.id_transaksi}</td>
                                <td>${transaksi.rute}</td>
                                <td>${transaksi.nama}</td>
                                <td>${transaksi.tanggal_transaksi}</td>
                                <td>${transaksi.jumlah_tiket}</td>
                                <td>${transaksi.total_bayar}</td>
                                <td>${transaksi.metode_pembayaran}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTransaksiModal" onclick="deleteSupir(${transaksi.id_transaksi})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            `;
                        transaksiTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });

        // hapus data
        function deleteSupir(id) {
            document.getElementById('deleteTransaksiModal').querySelector('.hapus').onclick = function() {
                fetch(`http://localhost/UAP_WEB/database/admin/deleteTransaksi.php?id_transaksi=${id}`, {
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


        // Tambah Transaksi
        document.getElementById('addTransaksiModal').querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('http://localhost/UAP_WEB/database/admin/addTransaksi.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menambah supir: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => console.error('Error adding data:', error));
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil data rute
            fetch('http://localhost/UAP_WEB/database/admin/getPerjalananId.php')
                .then(response => response.json())
                .then(data => {
                    const ruteDropdown = document.getElementById('rute');
                    data.forEach(perjalanan => {
                        const option = document.createElement('option');
                        option.value = perjalanan.id_perjalanan;
                        option.textContent = perjalanan.rute;
                        ruteDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching rute data:', error));

            // Mengambil data penumpang
            fetch('http://localhost/UAP_WEB/database/penumpang/getAll.php')
                .then(response => response.json())
                .then(data => {
                    const penumpangDropdown = document.getElementById('namaPenumpang');
                    data.forEach(penumpang => {
                        const option = document.createElement('option');
                        option.value = penumpang.id_penumpang;
                        option.textContent = penumpang.nama;
                        penumpangDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching penumpang data:', error));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemsPerPage = 15;
            let currentPage = 1;
            let data = [];

            // Fungsi untuk menampilkan data berdasarkan halaman yang dipilih
            function displayTransaksi(page) {
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const paginatedData = data.slice(startIndex, endIndex);

                const transaksiTableBody = document.getElementById('transaksiTableBody');
                transaksiTableBody.innerHTML = '';

                paginatedData.forEach(transaksi => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
            <td>${transaksi.id_transaksi}</td>
            <td>${transaksi.rute}</td>
            <td>${transaksi.nama}</td>
            <td>${transaksi.tanggal_transaksi}</td>
            <td>${transaksi.jumlah_tiket}</td>
            <td>${transaksi.total_bayar}</td>
            <td>${transaksi.metode_pembayaran}</td>
            <td>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTransaksiModal" onclick="editTransaksi(${transaksi.id_transaksi}, '${transaksi.rute}', '${transaksi.nama}', '${transaksi.tanggal_transaksi}', '${transaksi.jumlah_tiket}', '${transaksi.total_bayar}', '${transaksi.metode_pembayaran}')">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTransaksiModal" onclick="deleteTransaksi(${transaksi.id_transaksi})">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>`;
                    transaksiTableBody.appendChild(row);
                });
            }


            // Fetch data dari server
            fetch('http://localhost/UAP_WEB/database/supir/getAll.php')
                .then(response => response.json())
                .then(responseData => {
                    data = responseData;
                    displayData(currentPage);
                })
                .catch(error => console.error('Error fetching data:', error));

            // Fungsi untuk menampilkan halaman berikutnya
            document.getElementById('nextPageBtn').addEventListener('click', function() {
                if (currentPage < Math.ceil(data.length / itemsPerPage)) {
                    currentPage++;
                    displayData(currentPage);
                }
            });

            // Fungsi untuk menampilkan halaman sebelumnya
            document.getElementById('prevPageBtn').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    displayData(currentPage);
                }
            });
        });
    </script>
</body>

</html>