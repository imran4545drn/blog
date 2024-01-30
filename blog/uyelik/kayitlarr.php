<?php
ob_start();
include("baglanti.php");
$username_err = "";
$mail_err = "";
$sifre_err = "";
$sifretkr_err = "";

if (isset($_POST["kaydet"])) {
    if (empty($_POST["kullanici"])) {
        $username_err = "Kullanıcı adı boş bırakılamaz";
    } else if (strlen($_POST["kullanici"]) < 6) {
        $username_err = "Kullanıcı adı en az 6 karakterden oluşmalıdır";
    } else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullanici"])) {
        $username_err = "Kullanıcı adı büyük küçük harf ve rakamdan oluşmalıdır";
    } else {
        $user_ctrl = mysqli_query($baglanti, "SELECT kullanici_adi FROM kullanicilar WHERE kullanici_adi = '$_POST[kullanici]'");
        $c_user= mysqli_num_rows($user_ctrl);
        if ($c_user > 0) {
            $username_err = "Kullanıcı mevcut";
        }else {
            $username = $_POST["kullanici"];
        }
    }



    if (empty($_POST["mail"])) {
        $mail_err = "Mail boş bırakılamaz";
    } elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
        $mail_err = "Geçersiz Email formatı";
    } else {
        $email = $_POST["mail"];
    }

    if (empty($_POST["sifre"])) {
        $sifre_err = "Parola boş bırakılamaz";
    } else {
        $parola = $_POST["sifre"];
    }

    if (empty($_POST["sifretkr"])) {
        $sifretkr_err = "Parola tekrar kısmı boş bırakılamaz";
    } elseif ($_POST["sifre"] !== $_POST["sifretkr"]) {
        $sifretkr_err = "Parolalar eşleşmiyor";
    } else {
        $sifretkr = $_POST["sifretkr"];
    }

    if (empty($username_err) && empty($mail_err) && empty($sifre_err) && empty($sifretkr_err)) {
        if (isset($username) && isset($email) && isset($parola)) {
            $sql = "INSERT INTO kullanicilar (kullanici_adi, mail, sifre) VALUES ('$username', '$email', '$parola')";
            $calistir = mysqli_query($baglanti, $sql);
           

            if ($calistir) {
                echo '<div class="alert alert-success" role="alert">
                        Kayıt başarıyla eklendi!
                      </div>';
                      
                       
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Hata: ' . mysqli_error($baglanti) . '
                      </div>';
            }
            header("Refresh:1; url=giris.php");
        
            mysqli_close($baglanti);
        }
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
                <h5 class="card-title">Kayıt Formu</h5>
                <form action="kayitlarr.php" method="post">
                    <div class="mb-3">
                        <label for="kullaniciAdi" class="form-label">Kullanıcı Adı</label>
                        <input type="text" class="form-control <?php if (!empty($username_err)) { echo "is-invalid"; } ?>" id="kullaniciAdi" aria-describedby="emailHelp" placeholder="Kullanıcı Adı" name="kullanici">
                        <div class="invalid-feedback">
                            <?php echo $username_err; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="emailAdresi" class="form-label">Email Adresi</label>
                        <input type="text" class="form-control <?php if (!empty($mail_err)) { echo "is-invalid"; } ?>" id="emailAdresi" aria-describedby="emailHelp" placeholder="Email Adresi" name="mail">
                        <div class="invalid-feedback">
                            <?php echo $mail_err; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sifre" class="form-label">Parola</label>
                        <input type="password" class="form-control <?php if (!empty($sifre_err)) { echo "is-invalid"; } ?>" id="sifre" placeholder="Parola" name="sifre">
                        <div class="invalid-feedback">
                            <?php echo $sifre_err; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sifreTekrar" class="form-label">Parola Tekrar</label>
                        <input type="password" class="form-control <?php if (!empty($sifretkr_err)) { echo "is-invalid"; } ?>" id="sifreTekrar" placeholder="Parola Tekrar" name="sifretkr">
                        <div class="invalid-feedback">
                            <?php echo $sifretkr_err; ?>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="kaydet">Kayıt Ol</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
ob_end_flush();




?>
