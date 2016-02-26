<!DOCTYPE html>
<html>
<head>
    
    <?php
    
    $dbh = new PDO('mysql:host=localhost;dbname=simpelblok','simpelblok','simpelblok');
    $view = $dbh->prepare("SELECT * FROM post WHERE ID=?");
    $view->bindParam(1, $_GET["id"]);
    $view->execute();
    $row = $view->fetch(PDO::FETCH_ASSOC);
    $judul = $row['Judul'];
    $tanggal = $row['Tanggal'];
    $konten = $row['Konten'];
    

    
    ?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<title>Simple Blog | Apa itu Simple Blog?</title>


</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="new_post.html">+ Tambah Post</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    <header class="art-header">
        <div class="art-header-inner" style="margin-top: 0px; opacity: 1;">
            <time class="art-time"><?php echo $tanggal ?></time>
            <h2 class="art-title"><?php echo $judul ?></h2>
            <p class="art-subtitle">Di sini ada subtitle</p>
        </div>
    </header>

    <div class="art-body">
        <div class="art-body-inner">
            <hr class="featured-article" />
            <p>
                <?php echo nl2br($konten) ?>
            </p>

            <hr />
            
            <h2>Komentar</h2>
            <script src="/assets/js/ajax.js" type="text/javascript"></script>
            <div id="contact-area">
                <form method="post" action="#" onsubmit="return postComment(this,'/komen.php','ajaxdiv')">
                    <label for="Nama">Nama:</label>
                    <input type="text" name="Nama" id="Nama">
        
                    <label for="Email">Email:</label>
                    <input type="text" name="Email" id="Email">
                    
                    <label for="Komentar">Komentar:</label><br>
                    <textarea name="Komentar" rows="20" cols="20" id="Komentar"></textarea>
                    
                    <input id="ID" type="hidden" name="postid" value="<?php echo $_GET['id'] ?>">

                    <input type="submit" name="submit" value="Kirim" class="submit-button">
                </form>
            </div>

            <div id="ajaxdiv"></div>
            
            
            <script>
                loadPage("/komen.php?id=<?php echo $_GET['id'] ?>","ajaxdiv");
            </script>
            
        </div>
    </div>

</article>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        Tina
        
    </aside>
</footer>

</div>

<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>

</body>
</html>
