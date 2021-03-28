<!-- koneksi -->
<?php
$conn = mysqli_connect("localhost","root","","login");

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username'");
    
    if(mysqli_fetch_assoc($result)){
        echo "<script>alert(' username yang di pilih sudah terdaftar')</script>";
        return false;
    }

    // cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "<script>
                alert(' konfirmasi password tidak sesuai dengan');
                </script>";
                return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // var_dump($password); die;

    //tambahkan user baru ke data base
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);


}
?>