function validateForm() {
    var nama = document.forms["registrationForm"]["nama_peserta"].value;
    var sekolah = document.forms["registrationForm"]["sekolah"].value;
    var tanggalLahir = document.forms["registrationForm"]["tanggal_lahir"].value;
    var jenisKelamin = document.forms["registrationForm"]["jenis_kelamin"].value;
    var noTelepon = document.forms["registrationForm"]["no_telepon"].value;
    var alamat = document.forms["registrationForm"]["alamat"].value;

    if (nama == "" || sekolah == "" || tanggalLahir == "" || jenisKelamin == "" || noTelepon == "" || alamat == "") {
        alert("Semua kolom harus diisi!");
        return false;
    }
    var teleponPattern = /^[0-9]+$/;
    if (!teleponPattern.test(noTelepon)) {
        alert("Nomor telepon hanya boleh berisi angka!");
        return false;
    }

 

    return true;
}
