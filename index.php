<?php
require 'functions.php'; //memanggil functions.php
// ORDER BY id (ASC/DESC)
// ASC paling Kecil ke Besar
// DESC paling besar ke kecil
$mahasiswa = query("SELECT * FROM mahasiswa"); // query data mahasiswa ini bentuknya array

// tombol cari ditekan
if(isset($_POST["cari"])){
    $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>

    <!-- Search !-->
    <form action="" method="post">
        <!-- autofocus supaya tidak !-->
        <input type="text" name="keyword" size="40" autofocus
        placeholder="Masukkan keyword pencarian.." autocomplete="off">
        <button type="submit" name="cari">Cari!</button>

    </form>
    <br>
    <table border="1" cellpadding="10" cellspasingg="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th> 
            <th>Gambar</th>
            <th>NPM</th>
            <th>NAMA</th>
            <th>Email</th>
            <th>jurusan</th>
        </tr>

        <?php $i = 1; ?>
        <!-- while(  $row = mysqli_fetch_assoc($result) ) : = untuk menampilkan semua datanya dan ditampilkan satu" datanya !-->
        <?php foreach($mahasiswa as $row): ?> 
        <tr>
            <td><?= $i ?></td>
            <td>
            <a href="ubah.php?id=<?= $row["id"]?>">ubah</a> |
                <a href="hapus.php?id/<?= $row["id"]?>" onclick="return confirm('yakin?')">hapus</a>
            </td>
            <td><img src="img/<?php echo $row["gambar"]?>" alt="noi" width="100"></td>
            <td><?= $row["npm"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>
