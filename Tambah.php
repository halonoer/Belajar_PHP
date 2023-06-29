<?php
require "functions.php";

// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"]) ) {

    // didalam function ada function akan menjalankan

    // cek data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0 ){
        // jadi data didalam elemen form diambil lalu masukin ke dalam tambah nanti ditangkap oleh data
        echo"
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }else {
        echo"
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah data mahasiswa</title>
</head>
<body>
    <h1>Tambah data mahasiswa</h1>
    
    <!-- !-->
    <!-- action = untuk menetukan akan dikirim kemana data yang ada diform !-->
    <!-- ketika ada datanya, saya tidak mau datanya ada di url di url!-->
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <!-- for pasangannya dengan id !-->
                <!-- required untuk mencegah pengiriman datanya kosong!-->
                <label for="npm">NPM : </label>
                <input type="text" name="npm" id="npm" 
                required> 
            </li>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" 
                required> 
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" 
                required> 
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" 
                required> 
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar"
                required> 
            </li>
            <li>
                <!--  !-->
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>