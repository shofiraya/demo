<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION["login_dosen"])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id_tugas'];
$data = mysqli_query($conn, "SELECT * FROM unggah WHERE id_tugas='$id'");
$d = mysqli_fetch_array($data);

//menangkap data yang dikirim dari form
if(isset($_POST['submit'])) {
    $matkul = $_POST['matkul'];
    $tugas = $_POST['tugas'];
    $batas = $_POST['batas'];
    $tanggal = date('Y-m-d');  // mengubah format tanggal menjadi "yyyy-mm-dd" 

    $query = "UPDATE unggah SET 
            matkul='$matkul', 
            tugas='$tugas', 
            tanggal='$tanggal', 
            tgl_pengumpulan = '$batas' 
            WHERE id_tugas='$id'";
        if(mysqli_query($conn, $query)) {
            header("Location: tampilan_tugas.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="text-center mt-4">Form Input Tugas</h3>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <a href="tampilan_tugas.php" class="btn btn-info mb-3">Kembali</a>

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Mata Kuliah</label>
                        <input type="text" class="form-control" name="matkul" value="<?php echo $d['matkul']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Deskripsi Tugas</label>
                        <input type="text" class="form-control" name="tugas" value="<?php echo $d['tugas']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Batas Tanggal</label>
                        <input type="date" class="form-control" name="batas" value="<?php echo $d['tanggal']; ?>">
                    </div>
                    <button type="submit" value="Simpan" name="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <br>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
