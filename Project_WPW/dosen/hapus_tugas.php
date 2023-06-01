<?php
session_start();
if (!isset($_SESSION["login_dosen"])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';



if(isset($_GET['id_tugas'])) {
    $id = $_GET['id_tugas'];
    $queryshow = "SELECT * FROM unggah WHERE id_tugas='$id'";
    $sqlshow = mysqli_query($conn, $queryshow);
    $result = mysqli_fetch_assoc($sqlshow);
    
    unlink("../tugas/".$result['file']);
    

    $query = "DELETE FROM unggah WHERE id_tugas='$id'";
    $sql = mysqli_query($conn, $query);

    if($sql) {
        header("Location:tampilan_tugas.php");
    } else {
        echo $query;
    }
}

?>