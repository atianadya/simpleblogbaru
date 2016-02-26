<!DOCTYPE html>
<html>
    <head>
    
<script type="text/javascript">
    function checkdate(){
            var input = document.getElementById('Tanggal');
            var validformat=/^\d{4}\-\d{2}\-\d{2}$/; //Basic check for format validity
            var returnval=false;
            if (!validformat.test(input.value)) {
                    alert("Invalid Date Format. Please correct and submit again.");
            } else { //Detailed check for valid date ranges
                    var yearfield=input.value.split("-")[0];
                    var monthfield=input.value.split("-")[1];
                    var dayfield=input.value.split("-")[2];
                    var enteredDate = new Date(yearfield, monthfield-1, dayfield);
                    var today = new Date();
                    if (enteredDate.setHours(0,0,0,0) < today.setHours(0,0,0,0)) {
                            alert("Invalid date. The day you entered is before today");
                      } else {
                            returnval=true;
                    }
            }
            return returnval;
    }
    </script>    
    <?php
    
    $judul = "";
    $konten = "";
    $initID = -1;
    
    if(isset($_GET['id'])) {
        $dbh = new PDO("mysql:dbname=simpelblok;host=localhost", "simpelblok", "simpelblok");
        $test = $dbh->prepare("SELECT * FROM post WHERE ID=?");
        $test->bindParam(1, $_GET["id"]);
        $test->execute();
        $row = $test->fetch(PDO::FETCH_ASSOC);
        $judul = $row['Judul'];
        $konten = $row['Konten'];
        $initID = $row['ID'];
    }
    
    if(isset($_POST["Judul"]) && isset($_POST["Tanggal"]) && isset($_POST["Konten"]) && isset($_POST["id"])) {
        $dbh = new PDO("mysql:dbname=simpelblok;host=localhost", "simpelblok", "simpelblok");
        if($_POST["id"] == -1) {
            $tes = $dbh->prepare("INSERT INTO `simpelblok`.`post` (`ID`, `Judul`, `Tanggal`, `Konten`) VALUES (NULL, ?, ?, ?);");
            $tes->bindParam(1, $_POST["Judul"]);
            $tes->bindParam(2, $_POST["Tanggal"]);
            $tes->bindParam(3, $_POST["Konten"]);
            $tes->execute();
            header("Location: index.php");
            exit;
        } else {
            $edit = $dbh->prepare("UPDATE `simpelblok`.`post` SET `Judul` = :judul, `Tanggal` = :tanggal, `Konten` = :konten WHERE `post`.`ID` = :id;");
            $edit->bindParam(':judul', $_POST["Judul"]);
            $edit->bindParam(':tanggal', $_POST["Tanggal"]);
            $edit->bindParam(':konten', $_POST["Konten"]);
            $edit->bindParam(':id', $_POST["id"]);
            $edit->execute();
            
        }
    }
    
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

<title>Simple Blog | Tambah Post</title>


</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="editor.php">+ Tambah Post</a></li>
    </ul>
</nav>

<article class="art simple post">
    

    
    <h2 class="art-title" style="margin-bottom:40px">-</h2>

    <div class="art-body">
        <div class="art-body-inner">
            <h2>Tambah Post</h2>

            <div id="contact-area">
                <form method="post" action="editor.php" onsubmit="return checkdate()" >
                    <label for="Judul">Judul:</label>
                    <input type="text" name="Judul" id="Judul" value="<?php echo $judul; ?>">

                    <label for="Tanggal">Tanggal:</label>
                    <input type="text" name="Tanggal" id="Tanggal">
                    
                    <label for="Konten">Konten:</label><br>
                    <textarea name="Konten" rows="20" cols="20" id="Konten"><?php echo $konten; ?></textarea>
                    
                    <input name="id" type="hidden" value="<?php echo $initID ?>">

                    <input type="submit" name="submit" value="Simpan" class="submit-button">
                </form>
            </div>
        </div>
    </div>
    
    <script>
    var date = new Date();
    document.getElementById("Tanggal").setAttribute("value", date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + date.getDate());
    </script>

</article>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        Asisten IF3110 /
        <a class="rss-link" href="#rss">RSS</a> /
        <br>
        <a class="twitter-link" href="http://twitter.com/YoGiiSinaga">Yogi</a> /
        <a class="twitter-link" href="http://twitter.com/sonnylazuardi">Sonny</a> /
        <a class="twitter-link" href="http://twitter.com/fathanpranaya">Fathan</a> /
        <br>
        <a class="twitter-link" href="#">Renusa</a> /
        <a class="twitter-link" href="#">Kelvin</a> /
        <a class="twitter-link" href="#">Yanuar</a> /
        
    </aside>
</footer>

</div>

<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>



</body>
</html>
