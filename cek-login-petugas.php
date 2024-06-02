<?php
session_start();
include 'koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$login = mysqli_query($koneksi,"select * from petugas where username='$username' and password='$password' ");

$cek = mysqli_num_rows($login);
if($cek > 0){
    $data = mysqli_fetch_assoc($login);
    if($data['level']=="admin"){
        $_SESSION['nama'] = $data['nama_petugas'];
        $_SESSION['level'] = "admin";
        header("location:home/dashboard.php");
    }else if($data['level']=="petugas"){
        $_SESSION['nama'] = $data['nama_petugas'];
        $_SESSION['level'] = "petugas";
        header("location:home/dashboard.php");
    }else{
        header("location:auth-login-petugas.php?pesan=gagal");
    }
}else{
    header("location:auth-login-siswa.php?pesan=gagal");
}
?>

<div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>