
<?php
    include "koneksi.php";

    $nomor_polisi = $_POST['nomor_polisi'];
    $kapasitas = $_POST['kapasitas'];
    $model = $_POST['model'];
    $tahun_pembuatan = $_POST['tahun_pembuatan'];

    $sql = "INSERT INTO bus (id, nomor_polisi, kapasitas, model, tahun_pembuatan) VALUES(NULL, '$nomor_polisi', '$kapasitas', '$model', '$tahun_pembuatan')";

    if (mysqli_query($mysqli, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }

    header('Location: index.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-image: url('bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 30px;
            margin-bottom: 30px;
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                    echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    header("refresh:1;url=index.php");
                }
                if ($sukses) {
                    echo "<div class='alert alert-success' role='alert'>$sukses</div>";
                    header("refresh:1;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nomor_polisi" class="col-sm-2 col-form-label">Nomor_Polisi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_polisi" name="Nomor_Polisi" value="<?php echo $nomor_polisi ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kapasitas" class="col-sm-2 col-form-label">kapasitas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="<?php echo $kapasitas ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-body">model</label>
                        <input type="text" class="form-control" id="model" name="model" value="<?php echo $model ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-body">tahun_pembuatan</label>
                        <div class="form-control" name="tahun_pembuatan" required>
                        <input type="date" class="form-control" id="model" name="tahun_pembuatan" value="<?php echo $tahun_pembuatan ?>">
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
