<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <script src="script.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">
        <img src="logobalapkarung.png" alt="Logo" class="navbar-logo mr-2">    
        BALAP KARUNG PELAJAR NATIONAL CUP I</span>
    </nav>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama_peserta=input($_POST["nama_peserta"]);
        $sekolah=input($_POST["sekolah"]);
        $tanggal_lahir = date('Y-m-d', strtotime(input($_POST["tanggal_lahir"])));
        $jenis_kelamin=input($_POST["jenis_kelamin"]);
        $no_telepon=input($_POST["no_telepon"]);
        $alamat=input($_POST["alamat"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into peserta (nama_peserta,sekolah,tanggal_lahir,jenis_kelamin,no_telepon,alamat) values
		('$nama_peserta','$sekolah','$tanggal_lahir','$jenis_kelamin','$no_telepon','$alamat')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h4>Pendaftaran Peserta</h4>


    <form name="registrationForm" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama_peserta" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Sekolah:</label>
            <input type="text" name="sekolah" class="form-control" placeholder="Masukan Nama Sekolah" required/>
        </div>
        <div class="form-group">
    <label>Tanggal Lahir:</label>
    <input type="text" name="tanggal_lahir" class="form-control" placeholder="YYYY-MM-DD" required/>
</div>


<div class="form-group">
    <label>Jenis Kelamin:</label>
    <select name="jenis_kelamin" class="form-control" required>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>
</div>

                </p>
        <div class="form-group">
            <label>No telepon:</label>
            <input type="text" name="no_telepon" class="form-control" placeholder="Masukan No telepon" required/>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-secondary" role="button">Kembali</a>
    </form>
</div>
</body>
</html>