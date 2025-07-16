<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../src/style.css">
  <link rel="icon" href="./src/images/maki.png">
  <title>Geisha Sushi</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg fixed-top" id="navScript">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse rounded-4" id="navbarNav">
      <ul class="navbar-nav mx-auto gap-4 ">
        <li class="nav-item" >
          <a class="nav-link navbarFontColour" aria-current="page" href="../index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbarFontColour" href="#">Menu</a>
        </li>
        <li class="nav-item">
          <a href="#aboutUs" class="nav-link navbarFontColour">O nas</a>
        </li>
        <li class="nav-item">
          <a href="contact.php" class="nav-link navbarFontColour">Kontakt</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main>
    <div class="thanks d-flex justify-content-center align-items-center flex-column mt-5 py-5" data-aos="fade-up">
        <h1 class="text-white">Wyświetlanie wiadomości:</h1>
        <?php 
        $con = mysqli_connect("localhost", "root", "", "sushiMessages");
        if (isset($_POST['usun_id'])) {
        $usunId = (int)$_POST['usun_id']; 
        $delMsg = "DELETE FROM messages WHERE id = $usunId";
        mysqli_query($con, $delMsg);
        };
        $sql = "SELECT * FROM messages";
        $display  = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($display)) {
            $messageId = $row[0];
            $buttonId = $row[0];
            echo "<span class='messageSent' id='msg-$messageId'>"."Imie: ".$row['imie']."<br>"."Email: ".$row['email']."<br>"."Wiadomość: ".$row['tresc']."</span>"."<form method='post' onsubmit='return confirmDeletingMsg();'>
        <input type='hidden' name='usun_id' value='$messageId'>
        <input type='submit' value='Usuń' class='btn rounded-3 submitBtn mt-4'>
    </form>";
        }
        mysqli_close($con);
        ?>
      <script>
        function confirmDeletingMsg() {
          confirm("Czy na pewno chcesz usunąć tą wiadomość?");
        }
      </script>
    </div>
  <div class="container py-5" data-aos="fade-up">
    <!-- placeholder -->
  </div>
    <div class="logout">
    <a href="logout.php">Wyloguj</a>
  </div>
<footer class="footer bg-dark text-white py-4">
  <div class="container d-flex flex-column flex-md-row justify-content-between gap-4">
    <nav class="footer-nav">
      <ul class="list-unstyled d-flex gap-3 mb-0 d-flex flex-column">
        <li><a href="#" class="footer-link">Home</a></li>
        <li><a href="#" class="footer-link">Menu</a></li>
        <li><a href="#aboutUsId" class="footer-link">O nas</a></li>
      </ul>
    </nav>
    <div class="footer-social" id="footerSocial">
      <script>
        const footerSocial = document.getElementById('footerSocial');
        if (window.innerWidth < 768) {
            footerSocial.style.flexDirection = 'row';
        } 
      </script>
      <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
      <a href="https://instagram.com" target="_blank" aria-label="Instagram" class="text-white fs-4"><i class="bi bi-instagram mt-5"></i></a>
    </div>
    <div class="footer-delivery">
      <span class="fs-2 fw-semibold">Dostawa</span>
      <p class="mb-1">Dowóz w Kaliszu: 8 zł</p>
      <p class="mb-0">Okolice miasta: 12-20 zł</p>
    </div>
    <div class="footer-contact ">
      <span class="fs-2 fw-semibold">Kontakt</span>
      <p><a href="tel:515078301" class="footer-link"><i class="bi bi-telephone-fill"></i> 515 078 301</a></p>
      <p><a href="https://maps.app.goo.gl/LzziFVwiTLCcFyjW9" target="_blank" class="footer-link"><i class="bi bi-geo-alt-fill"></i> Kalisz</a></p>
      <h6 class="mt-3">Godziny otwarcia</h6>
      <ul class="list-unstyled mb-0">
        <li>Pon - Czw: 12:00 - 21:00</li>
        <li>Pt - Sob: 12:00 - 22:00</li>
        <li>Ndz: 12:00 - 21:00</li>
      </ul>
    </div>
  </div>
</footer>
</main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script>
window.addEventListener('load', updateNavCenter);
window.addEventListener('resize', updateNavCenter);
  </script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800, 
    easing: 'ease-in-out', 
    once: true, 
  });
</script>
</body>
</html>