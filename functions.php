<?php
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// fungsi querry
function query($query){
    global $conn; // supaya mengacu kepada variabel yang sama untuk menyamakan variabel atas
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// fungsi tambah
function tambah ($data) {
    global $conn; // buat koneksi $conn 
    //tidak perlu koneksi lagi karena sudah didalam functions
    // ambil data dari tiap elemen dalam form
    // kirim data dengan $data
    // htmlspecialchars adalah mengubah karakter khusus menjadi entitas html. 
    // htmlspecialchars tujuannnya untuk mengamankan data
    $npm = htmlspecialchars($data["npm"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    
    // upload gambar
    $gambar = upload();
    if( $gambar ) {
        return false;
    }

    $query = "INSERT INTO mahasiswa
                VALUES
                ('', '$npm', '$nama', '$email', '$jurusan', '$gambar')
            ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}

function upload(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['seze'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if($error === 4 ){
        echo "<script> 
                alert('pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // explode sebuah fungsi untuk memecah sebuah string menjadi array
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // fungsinya ini untuk menghasilkan true jika ada dan menghasilkan false jika tidak ada
    if( in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "<script> 
                alert('yang di upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ){
        echo "<script> 
                alert('ukuran gambar terlalu besar');
              </script>";
        return false;
    } 

    // generate nama gambar baru 
    // membuat nama string baru(random)
    $namaFileBaru  = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, gambar siap diupload
    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

    return $namaFileBaru;

}

// fungsi hapus
function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// fungsi ubah
function ubah($data){
    global $conn;
    // id diinput dengan user
    // id digunakan seperti ini untuk menghindari terjadi error
    $id = $data["id"];
    $npm = htmlspecialchars($data["npm"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama =  htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

    $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE mahasiswa SET
                npm = '$npm', 
                nama = '$nama',
                email = '$email',
                jurusan ='$jurusan',
                gambar = '$gambar'
              WHERE id = $id
                ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);
}

// fungsi cari
// =  Harus sama kata orangnya
// LIKE semua akan tampil ketika data diketik dikolom pencarian
// % untuk mencari apapun datanya (misal saya tulis A maka akan tampil semua data yang ada huruf A)
function cari($keyword){
    $query = "SELECT * FROM  mahasiswa
        WHERE
        nama LIKE '%$keyword%' OR
        npm LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
    ";
    // mengambil querry yang telah dibuat, kedalam fungsi yang baru

    return query($query);
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripcslashes( $data["username"]));
}

?>
