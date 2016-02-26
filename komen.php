<?php    
    $dbh = new PDO ("mysql:dbname=simpelblok;host=localhost","simpelblok","simpelblok");
    if(isset($_GET["id"])) {
        $comm = $dbh->prepare("SELECT * FROM komen WHERE PostID=?");
        $comm->bindParam(1, $_GET["id"]);
        $comm->execute();
    } else if(isset($_POST["Nama"]) && isset($_POST["Email"]) && isset($_POST["Komentar"]) && isset($_POST["postid"])) {
        $commb = $dbh->prepare("INSERT INTO `simpelblok`.`komen` (`ID`, `PostID`, `Nama`, `Email`, `Tanggal`, `Isi`) VALUES (NULL, :id, :nama, :email, :tanggal, :komentar);");
        $commb->bindParam(":nama", $_POST["Nama"]);
        $commb->bindParam(":email", $_POST["Email"]);
        $date = date('Y-m-d');
        $commb->bindParam(":tanggal", $date);
        $commb->bindParam(":komentar", $_POST["Komentar"]);
        $commb->bindParam(":id", $_POST["postid"]);
        $commb->execute();
        
        $comm = $dbh->prepare("SELECT * FROM komen WHERE PostID=?");
        $comm->bindParam(1, $_POST["postid"]);
        $comm->execute();
    }
?>

<ul class="art-list-body">
    
    <?php while ($commrow = $comm->fetch(PDO::FETCH_ASSOC)) : ?>
    <li class="art-list-item">
        <div class="art-list-item-title-and-time">
            <h2 class="art-list-title"><?php echo $commrow['Nama']; ?></h2>
            <div class="art-list-time"><?php echo $commrow['Tanggal']; ?></div>
        </div>
        <p><?php echo nl2br($commrow['Isi']); ?></p>
    </li>
    <?php    endwhile; ?>

</ul>
