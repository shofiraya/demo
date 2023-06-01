<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION["login_mahasiswa"])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id_tugas'];

// untuk mengambil data mahasiswa.
$data = mysqli_query($conn, "SELECT * FROM unggah WHERE id_tugas='$id'");

// menyimpan data mahasiswa melalui mysql 
$d = mysqli_fetch_array($data);

// periksa apakah $d bernilai null sebelum mengakses elemennya
if ($d) {
    if (isset($_POST['submit'])) {
        $nama = $_SESSION['username'];
        $namefile = $_FILES['file']['name'];
        $x = explode('.', $namefile);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $tanggal = date('Y-m-d');

        move_uploaded_file($file_tmp, '../tugas/' . $namefile);
        // menginput data ke database
        $query = "INSERT INTO pengumpulan VALUES ('', '$nama', '$namefile', '$ukuran', '$tanggal', '0')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<p class="text-success">File berhasil diupload</p>';
            header("Location: tugasku.php");
            exit;
        } else {
            echo '<p class="text-danger">Gagal upload file</p>';
        }
    }
} else {
    echo '<p class="text-danger">Data tidak ditemukan</p>';
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="text-center mt-4">Upload Tugas</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <a href="tugasku.php" class="btn btn-info mb-3">Kembali</a>

                <form method="post" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="matkul" class="form-label">Mata Kuliah</label>
                        <input type="text" name="matkul" value="<?php echo $d["matkul"]; ?>" readonly class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tugas" class="form-label">Deskripsi Tugas</label>
                        <input type="text" name="tugas" value="<?php echo $d["tugas"]; ?>" readonly class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" name="tanggal" value="<?php echo $d["tanggal"]; ?>" readonly class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pengumpulan" class="form-label">Deadline</label>
                        <input type="text" name="tgl_pengumpulan" value="<?php echo $d["tgl_pengumpulan"]; ?>" readonly class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Tugas</label> <br />
                        <input type="file" class="form-control" name="file" id="file">
                    </div>
                    <button type="submit" value="Simpan" name="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
