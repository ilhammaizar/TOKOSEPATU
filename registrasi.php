<?php 
    include 'service/koneksi.php';

    if (isset($_POST['registrasi'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($db->query($sql)){
            echo "Berhasil registrasi!";
        } else {"data gagal";
    }
}
?>  
<html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>StoreSter</title>
        </head>
        <body>
            <?php include "layout/index.html" ?>
         <h3>Masuk Akun</h3>
         <form action="registrasi.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit">masuk sekarang<button/>
         </form>
        </body>
</html>
