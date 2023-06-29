<?php
require "functions.php";

// ambil data di URL
$id = $_GET["id"];

// querry data mahasiswa berdasarkan id
// 0 untuk mengambil index pertamanya
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"]) ) {
    // didalam function ada function akan menjalankan

    // cek data berhasil diubah atau tidak
    if (ubah($_POST) > 0 ){
        // jadi data didalam elemen form diambil lalu masukin ke dalam tambah nanti ditangkap oleh data
        echo"
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }else {
        echo"
            <script>
                alert('data gagal diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah data mahasiswa</title>
</head>
<body>
    <h1>Ubah data mahasiswa</h1>
    
    <!-- !-->
    <!-- action = untuk menetukan akan dikirim kemana data yang ada diform !-->
    <!-- ketika ada datanya, saya tidak mau datanya ada di url di url!-->
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
    <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
                <!-- for pasangannya dengan id !-->
                <!-- required untuk mencegah pengiriman datanya kosong!-->
                <label for="npm">NPM : </label>
                <input type="text" name="npm" id="npm" 
                required
                value="<?= $mhs["npm"]; ?>"> 
            </li>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" 
                required
                value="<?= $mhs["nama"]; ?>"> 
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" 
                required
                value="<?= $mhs["email"]; ?>"> 
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" 
                required
                value="<?= $mhs["jurusan"]; ?>"> 
            </li>
            <li>
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $mhs['gambar'];?>" width="100"><br>
                <input type="file" name="gambar" id="gambar"
                required> 
            </li>
            <li>
                <!--  !-->
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>