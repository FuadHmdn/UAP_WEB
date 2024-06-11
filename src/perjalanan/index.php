<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #F5F5F6;
            color: #343a40;
        }

        .container {
            margin-top: 50px;
        }

        .table-title {
            margin-bottom: 30px;
            color: #007bff;
            text-align: center;
        }

        .table-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 50px;
        }

        table {
            margin: 0 auto;
            width: 100%;
        }

        thead th {
            background-color: #007bff;
            color: #343a40;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .page-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
            color: #007bff;
        }

        .form-container {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <a href="javascript:history.back()" class="btn btn-primary back-button">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <div class="container">
        <h1 class="page-title">Perjalanan Expedia</h1>
        <div class="form-container">
            <form id="add-perjalanan-form">
                <div class="mb-3">
                    <label for="id_bus" class="form-label">Model Bus</label>
                    <select class="form-select" id="id_bus" name="id_bus" required></select>
                </div>
                <div class="mb-3">
                    <label for="id_supir" class="form-label">Nama Supir</label>
                    <select class="form-select" id="id_supir" name="id_supir" required></select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                    <input type="date" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_tiba" class="form-label">Tanggal Tiba</label>
                    <input type="date" class="form-control" id="tanggal_tiba" name="tanggal_tiba" required>
                </div>
                <div class="mb-3">
                    <label for="rute" class="form-label">Rute</label>
                    <input type="text" class="form-control" id="rute" name="rute" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Perjalanan</button>
            </form>
        </div>
        <div id="table-container">
            
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            fetch('http://localhost/UAP_WEB/database/admin/getBus.php')
                .then(response => response.json())
                .then(data => {
                    const busSelect = document.getElementById('id_bus');
                    data.forEach(bus => {
                        const option = document.createElement('option');
                        option.value = bus.id_bus;
                        option.textContent = bus.model;
                        busSelect.appendChild(option);
                    });
                });

            fetch('http://localhost/UAP_WEB/database/admin/getSupir.php')
                .then(response => response.json())
                .then(data => {
                    const supirSelect = document.getElementById('id_supir');
                    data.forEach(supir => {
                        const option = document.createElement('option');
                        option.value = supir.id_supir;
                        option.textContent = supir.nama;
                        supirSelect.appendChild(option);
                    });
                });

            
            fetch('http://localhost/UAP_WEB/database/admin/getPerjalanan.php')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('table-container');

                    if (data.message) {
                        const message = document.createElement('p');
                        message.textContent = data.message;
                        container.appendChild(message);
                    } else {
                        Object.keys(data).forEach(rute => {
                            const tableContainer = document.createElement('div');
                            tableContainer.classList.add('table-container');

                            const title = document.createElement('h3');
                            title.classList.add('table-title');
                            title.innerHTML = `<i class="fas fa-bus"></i> Perjalanan: ${rute}`;
                            tableContainer.appendChild(title);

                            const table = document.createElement('table');
                            table.classList.add('table', 'table-hover');

                            const thead = document.createElement('thead');
                            thead.innerHTML = `
                                <tr>
                                    <th scope="col">Model Bus</th>
                                    <th scope="col">Nama Supir</th>
                                    <th scope="col">Nama Penumpang</th>
                                    <th scope="col">Berangkat</th>
                                    <th scope="col">Tiba</th>
                                    <th scope="col">Jumlah Tiket</th>
                                    <th scope="col">Total Bayar</th>
                                    <th scope="col">Pembayaran</th>
                                </tr>
                            `;
                            table.appendChild(thead);

                            const tbody = document.createElement('tbody');
                            data[rute].forEach(item => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${item.model_bus}</td>
                                    <td>${item.nama_supir}</td>
                                    <td>${item.nama_penumpang}</td>
                                    <td>${item.tanggal_berangkat}</td>
                                    <td>${item.tanggal_tiba}</td>
                                    <td>${item.jumlah_tiket}</td>
                                    <td>${item.total_bayar}</td>
                                    <td>${item.metode_pembayaran}</td>
                                `;
                                tbody.appendChild(row);
                            });
                            table.appendChild(tbody);

                            tableContainer.appendChild(table);
                            container.appendChild(tableContainer);
                        });
                    }
                })
                .catch(error => console.error('Error fetching data:', error));

            
            document.getElementById('add-perjalanan-form').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(event.target);
                fetch('http://localhost/UAP_WEB/database/admin/addPerjalanan.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Perjalanan berhasil ditambahkan');
                        location.reload();
                    } else {
                        alert('Gagal menambahkan perjalanan');
                    }
                })
                .catch(error => console.error('Error adding perjalanan:', error));
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
