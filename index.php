<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Ini bloks nya tina">
<meta name="author" content="Otter">

<!-- Twitter Card -->
<meta name="twitter:card" content="f">
<meta name="twitter:site" content="a!">
<meta name="twitter:title" content="Ini ek">
<meta name="twitter:description" content="ssss">
<meta name="twitter:creator" content="Otter">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Iw">
<meta property="og:description" content="wa">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="SALMOOON!">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<title>Simple Blog</title>

<?php


$dbh = new PDO('mysql:host=localhost;dbname=simpelblok','simpelblok','simpelblok');

if (isset($_POST["del"])) {
    $stm = $dbh->prepare("DELETE FROM `simpelblok`.`post` WHERE `post`.`ID` = ?");
    $stm->bindParam(1, $_POST["del"]);
    $stm->execute();
}
    

$stm = $dbh->prepare("SELECT * FROM post");
$stm->execute();

?>

</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="editor.php">+ Tambah Post</a></li>
    </ul>
</nav>

<div id="home">
    <div class="posts">
        <nav class="art-list">
          <ul class="art-list-body">
              
              <?php while($row = $stm->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="art-list-item-title-and-time">
                    <h2 class="art-list-title"><a href=<?php echo "'post.php?id=" . $row['ID'] . "'"; ?>><?php echo $row['Judul']; ?></a></h2>
                    <div class="art-list-time"><?php echo $row['Tanggal']; ?></div>
                </div>
                <p><?php echo nl2br($row['Konten']); ?></p>
                <p>
                    <a href=<?php echo "'editor.php?id=" . $row['ID'] . "'"; ?>>Edit</a> | <a href='#' onclick=<?php echo "'delAsk(" . $row['ID'] . ")'"; ?>>Hapus</a> | 
                    <form class='hidden' action='index.php' method='post' id=<?php echo "'delete" . $row['ID'] . "'"; ?>>
                        <input class='hidden' name='del' value=<?php echo $row['ID']; ?>>
                    </form>
                </p>
              <?php endwhile; ?>
              <script>
                  function delAsk(id) {
                      var yes = confirm("Apakah Anda yakin menghapus post ini?");
                      if (yes) {
                          document.getElementById("delete" + id).submit();
                      }
                  }
              </script>
              
            </li>
          </ul>
        </nav>
    </div>
</div>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <div class="psi">&psi;</div>
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
