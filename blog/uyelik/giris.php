<?php
ob_start();
include("baglanti.php");

 
 
$username_err = "";
$sifre_err = "";
$username = $parola = "";
if (isset($_POST["giris"])) {
    if (empty($_POST["kullanici"])) {
        $username_err = "Kullanıcı adı boş bırakılamaz";
    } else {
        $username = $_POST["kullanici"];
    }

    if (empty($_POST["sifre"])) {
        $sifre_err = "Parola boş bırakılamaz";
    } else {
        $parola = $_POST["sifre"];
    }

    if (empty($username_err) && empty($sifre_err)) {
        $secim = "SELECT * FROM kullanicilar WHERE kullanici_adi ='$username'";
        $calistir = mysqli_query($baglanti, $secim);
        $kayitsayisi = mysqli_num_rows($calistir);
        
        if ($kayitsayisi > 0) {
            $ilgilikayit = mysqli_fetch_assoc($calistir);
            $sifreler = $ilgilikayit["sifre"];
            
            if ($parola == $sifreler) {
                $_SESSION["kullanici_adi"] = $ilgilikayit["kullanici_adi"];
                $_SESSION["mail"] = $ilgilikayit["mail"];
                
                header("Location:admin.php");
               exit();
                
                
            } else {
                echo '<div class="alert alert-danger" role="alert">Parola Yanlış!</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Kullanıcı bulunamadı!</div>';
        
        }
        
        mysqli_close($baglanti);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Formu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .card {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
              
                <form action="giris.php" method="post">
                    <div class="mb-3">
                        <label for="kullaniciAdi" class="form-label">Kullanıcı Adı</label>
                        <input type="text" class="form-control <?php if (!empty($username_err)) { echo "is-invalid"; } ?>" id="kullaniciAdi" aria-describedby="emailHelp" placeholder="Kullanıcı Adı" name="kullanici">
                        <div class="invalid-feedback">
                            <?php echo $username_err; ?>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sifre" class="form-label">Parola</label>
                        <input type="password" class="form-control <?php if (!empty($sifre_err)) { echo "is-invalid"; } ?>" id="sifre" placeholder="Parola" name="sifre">
                        <div class="invalid-feedback">
                            <?php echo $sifre_err; ?>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="giris">Giriş Yap</button><br><br>
                    <a href="kayitlarr.php">Kaydol</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
ob_end_flush();
?>

