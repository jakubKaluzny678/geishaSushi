<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./src/style.css">
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
          <a class="nav-link navbarFontColour" aria-current="page" href="index.html">Home</a>
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
  <div class="socialsWrapper">
    <div class="floatingSocials">
    <i class="bi bi-people-fill"></i>
      <div class="socialsDisplay">
          <a href="https://facebook.com" target="_blank" aria-label="Facebook" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
          <a href="https://instagram.com" target="_blank" aria-label="Instagram" class="text-white fs-4"><i class="bi bi-instagram mt-5"></i></a>
          <a href="tel:" aria-label="Phone number" class="text-white fs-4"><i class="bi bi-telephone-fill"></i></a>
      </div>
  </div>
</div>
  <script>
document.addEventListener("DOMContentLoaded", function () {
  const socialsWrapper = document.querySelector('.socialsWrapper');
  const floatingSocials = document.querySelector('.floatingSocials');
  const socialsDisplay = document.querySelector('.socialsDisplay');
  if (window.innerWidth < 768) {
    socialsWrapper.addEventListener("click", function () {
      socialsDisplay.style.visibility = 'visible';
      floatingSocials.style.visibility = 'hidden';
    });
    document.addEventListener("click", function (e) {
      if (!socialsWrapper.contains(e.target)) {
        socialsDisplay.style.visibility = 'hidden';
        floatingSocials.style.visibility = 'visible';
      }
    });
  } else {
    socialsWrapper.addEventListener("mouseover", function () {
      socialsDisplay.style.visibility = 'visible';
      floatingSocials.style.visibility = 'hidden';
    });
    socialsWrapper.addEventListener("mouseleave", function () {
      socialsDisplay.style.visibility = 'hidden';
      floatingSocials.style.visibility = 'visible';
    });
  }
});
  </script>
    <section class="contactSection text-white" data-aos="fade-in">
        <div class="contactForm">
            <form method="post" action="contact.php" class='contactForm'>
                <span class="fs-3 mb-5">Skontaktuj się z nami</span>
                <input type="text" name="name" id="name" placeholder="Wpisz swoje imię" class="rounded-2" required>
                <input type="email" class="mt-3" name="email" id="emailInput" placeholder="Wprowadź adres e-mail" class="rounded-2" required>
                <textarea name="message" id="messageInput" class="mt-3" class="rounded-2" placeholder="Twoja wiadomość - Limit to 300 znaków" maxlength="300" required></textarea>
                <button type="submit" name="submitBtn" class="btn rounded-3 submitBtn mt-4">Prześlij wiadomość</button>
                <?php 
                $con = mysqli_connect("localhost", "root", "", "sushiMessages");
                if (isset($_POST['submitBtn'])) {
                  $name = trim($_POST['name']);
                  $email = trim($_POST['email']);
                  $message = trim($_POST['message']);
                  $errors = [];
                  if (empty($name)) {
                    $errors[] = "Proszę podać imię";
                  } elseif (mb_strlen($name) > 50) {
                    $errors[] = "Podane imię jest za długie";
                  };
                  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Podaj poprawny adres e-mail";
                  } elseif (mb_strlen($email) > 100) {
                    $errors[] = "Adres e-mail jest za długi";
                  };
                  if (empty($message)) {
                    $errors[] = "Wiadomość nie może być pusta";
                  } elseif (mb_strlen($message) > 300) {
                    $errors[] = "Wiadomość przekracza dopuszczalną długość";
                  } 
                  if (empty($errors)) {
                  $sql = "INSERT INTO messages (imie, email, tresc) VALUES ('$name', '$email', '$message')";
                  $result = mysqli_query($con, $sql);
                    header("Location: messageSent.html");
                  } else {
                    foreach ($errors as $err) {
                    echo "<span class='messageErr'>$err</span>";
                  }
                  }
                }
                mysqli_close($con);
                ?>
                </form>
        </div>
    </section>
</main>
<footer class="footer bg-dark text-white py-4 mt-5">
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
      <span class="mt-3">Godziny otwarcia</span>
      <ul class="list-unstyled mb-0">
        <li>Pon - Czw: 12:00 - 21:00</li>
        <li>Pt - Sob: 12:00 - 22:00</li>
        <li>Ndz: 12:00 - 21:00</li>
      </ul>
    </div>
  </div>
  <div class="text-center mt-4 small text-muted">
    &copy; 2025 Geisha Sushi. Wszelkie prawa zastrzeżone.
  </div>
</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <script>
window.addEventListener('load', updateNavCenter);
window.addEventListener('resize', updateNavCenter);
  </script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800, // czas animacji (ms)
    easing: 'ease-in-out', // easing
    once: true, // animuje tylko raz przy pierwszym wejściu
  });
</script>
</body>
</html>