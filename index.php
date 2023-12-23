<?php
include "koneksi.php";

// Menghapus data jika ada parameter id_peserta yang dikirimkan
if (isset($_GET['id_peserta'])) {
    $id_peserta = htmlspecialchars($_GET["id_peserta"]);
    $sql = "DELETE FROM peserta WHERE id_peserta = '$id_peserta'";
    $hasil = mysqli_query($kon, $sql);

    if (!$hasil) {
        echo "<div class='alert alert-danger'> Data Gagal dihapus: " . mysqli_error($kon) . "</div>";
    }
}

// Mencari data sesuai dengan parameter pencarian (jika ada)
if (isset($_GET['cari'])) {
    $pencarian = mysqli_real_escape_string($kon, $_GET['cari']);
    $query = "SELECT * FROM peserta WHERE 
               nama_peserta LIKE '%$pencarian%' OR 
               sekolah LIKE '%$pencarian%' OR 
               alamat LIKE '%$pencarian%'";
} else {
    $query = "SELECT * FROM peserta";
}

$hasil = mysqli_query($kon, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>BALAP KARUNG NATIONAL CUP</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">
            <img src="logobalapkarung.png" alt="Logo" class="navbar-logo mr-2">    
            BALAP KARUNG PELAJAR NATIONAL CUP I
        </span>
    </nav>
    <div class="container">
        <br>
        <img src="logobalapkarung.png" class="mx-auto d-block" style="width: 150px;">

        <h4 class=mt-3><center>DAFTAR PESERTA LOMBA BALAP KARUNG PELAJAR NASIONAL</center></h4>

        <form method="GET" action="index.php" class="form-inline">
    <label class="mr-2">Pencarian:</label>
    <input type="text" name="cari" class="form-control" value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama_peserta"]; ?></td>
                        <td><?php echo $data["sekolah"];   ?></td>
                        <td><?php echo $data["tanggal_lahir"];   ?></td>
                        <td><?php echo $data["jenis_kelamin"];   ?></td>
                        <td><?php echo $data["no_telepon"];   ?></td>
                        <td><?php echo $data["alamat"];   ?></td>
                        <td>
                            <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Daftar Sekarang</a>
    </div>
</body>
</html>
