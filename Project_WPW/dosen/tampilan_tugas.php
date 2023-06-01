<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION["login_dosen"])) {
    header("Location: ../login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM unggah");
$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">
        <h2 class="text-center mt-5 mb-4">Tugas Kuliah</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="dashboard_dosen.php" class="btn btn-danger mb-3">Kembali</a>
            <a href="tugas.php" class="btn btn-primary me-md-2 mb-3">+ Tambahkan Tugas</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mata Kuliah</th>
                        <th scope="col">Deskripsi Tugas</th>
                        <th scope="col">Tanggal Tugas</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomer = 1;
                    $query = mysqli_query($conn, "SELECT * FROM unggah");
                    while ($data = mysqli_fetch_array($query)) { 
                    ?>
                    <tr>
                        <th scope="row"><?php echo $nomer; ?></th>
                        <td><?php echo $data['matkul']; ?></td>
                        <td><?php echo $data['tugas']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['tgl_pengumpulan']; ?></td>
                        <td>
                            <a href="edit_tugas.php?id_tugas=<?php echo $data['id_tugas']; ?>" class="btn btn-warning btn-sm me-2">Update</a>
                            <a href="hapus_tugas.php?id_tugas=<?php echo $data['id_tugas']; ?>" class="btn btn-danger btn-sm me-2">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                    $nomer++;
                    } 
                    ?>
                </tbody>
            </table>
        </div>

        <h2 class="text-center mt-5 mb-4">Pengumpulan Tugas Kuliah</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">File</th>
                        <th scope="col">Ukuran</th>
                        <th scope="col">Tanggal Pengumpulan</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomer = 1;
                    $query2 = mysqli_query($conn, "SELECT * FROM pengumpulan");
                    while ($data2 = mysqli_fetch_array($query2)) { 
                    ?>
                    <tr>
                        <th scope="row"><?php echo $nomer; ?></th>
                        <td><?php echo $data2['nama']; ?></td>
                        <td><?php echo $data2['file']; ?></td>
                        <td><?php echo round($data2['ukuran'] / 1024, 2); ?>KB</td>
                        <td><?php echo $data2['tanggal']; ?></td>
                        <td><?php 
                        if($data2['nilai']==0) {
                            echo '<span style="color: red;">Belum dinilai</span>';
                        } else {
                            echo '<span style="color: green;">' . $data2['nilai'] . '</span>';
                        }
                        ?></td>
                        <td>
                            <a href="nilai_tugas.php?id_pengumpulan=<?php echo $data2['id_pengumpulan']; ?>" class="btn btn-primary btn-sm me-2">Beri Nilai</a>
                            <a href="download_tugas.php?filename=<?php echo $data2['file']; ?>" class="btn btn-success btn-sm me-2">Download</a>
                        </td>
                    </tr>
                    <?php 
                    $nomer++;
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        })
    </script>
</body>
</html>