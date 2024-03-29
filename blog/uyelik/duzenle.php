<?php
ob_start();
session_start();

if(!isset($_SESSION["user"]))
{
    include "../config.php";

    $id = $_GET["duzid"];

    $veri = mysqli_query($db,"select * from posts where post_id = '$id'");
    $veri = mysqli_fetch_array($veri);}
else{


}
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TARİF Blog </title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">İmran'ın Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../index.php">Siteyi Gör</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('../assets/img/home-bg.jpg')">
        </header>
        <!-- Main Content-->
        <div class="container px-10 px-lg-10">
            <div class="row gx-4 gx-xl-5 justify-content-center">
                <div class="col-md-15 col-lg-8 col-xl-7">
                <center>
                    <form method="POST">
                        <h4>İçerik Düzenle</h4>
                        <br/>
                        <!-- Title input -->
                        <div class="form-outline mb-6">
                            <input type="text" id="form4Example1" placeholder="Başlık" value="<?php 
                            
                            echo $veri["post_title"];
                            
                            ?>" name="title" class="form-control" />
                        </div>
                        <br/>
                        <!-- Content input -->
                        <div class="form-outline mb-6">
                            <textarea class="form-control" id="form4Example3" placeholder="İçerik" name="content" rows="4"><?php 
                            
                            echo $veri["post_content"];

                            ?></textarea>
                        </div>
                        <br/>
                        <?php
                        
                        if(isset($_POST["sendPost"]))
                        {
                            $title = $_POST["title"];
                            $content = $_POST["content"];

                            if($title != "" && $content != "")
                            {
                                $ekle = mysqli_query($db, "UPDATE posts SET post_title='$title', post_content='$content' where post_id = '$id'");
                                echo '<div class="alert alert-success">Başarıyla Güncellendi.</div>';

                                header("Refresh:1; url=duzenle.php?duzid=$id");
                            }

                            else
                            {
                                echo '<div class="alert alert-danger">Boş alan bırakmayınız!</div>';
                            }

                            
                        }
                        
                        ?>
                        <!-- Submit button -->
                        <button type="submit" name="sendPost" class="btn btn-primary btn-block mb-4">Düzenle</button>
                    </form>
                </center><br/>
                </div>
            </div>
        </div><br/><hr/>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fa-brands fa-instagram fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://github.com/imran4545drn">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; imran 2023</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
<?php
ob_end_flush();
?>
