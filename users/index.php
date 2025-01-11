<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>


<!DOCTYPE HTML>
<html>

<head>
    <!-- Meta dane -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Tytuł i favicon -->
    <title>Kawiarnia Sombrerro</title>
    <link rel="icon" type="image/png" href="../zasoby/zdjecia/favicon.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../zasoby/css/style.css">
    <link rel="stylesheet" href="../zasoby/css/chat.css">
</head>


<body>
    <!-- HEADER SECTION -->
    <header class="header">
        <a href="#" class="logo">
            <img src="../zasoby/zdjecia/logo.png" class="img-logo" alt="Kawiarria Sombrerro">
        </a>

        <!-- MAIN MENU FOR SMALLER DEVICES -->
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#home" class="text-decoration-none">Strona główna</a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="text-decoration-none">O nas</a>
                </li>
                <li class="nav-item">
                    <a href="#menu" class="text-decoration-none">Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#blogs" class="text-decoration-none">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="text-decoration-none">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="text-decoration-none">Wyloguj się</a>
                </li>
            </ul>
            </div>
        </nav>

        <!-- Menu, początkowo ukryte -->
        <div id="mobile-menu"
            style="display:none; position: fixed; right: -100%; top: 0; height: 100%; width: 50%; background-color: #fff; z-index: 999;">
            <div class="menu-content" style="padding: 20px;">
                <ul>
                    <li><a href="#home">Strona Główna</a></li>
                    <li><a href="#about">O Nas</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#blogs">Blog</a></li>
                    <li><a href="#contact">Kontakt</a></li>
                    <li><a href="users/login.php">Login</a></li>
                </ul>
            </div>
        </div>

        <script>

            // Znajdź przycisk hamburgera i menu
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            // Funkcja do przełączania menu
            menuBtn.addEventListener('click', () => {
                // Sprawdź, czy menu jest już widoczne
                if (mobileMenu.style.display === "none" || mobileMenu.style.display === "") {
                    mobileMenu.style.display = "block"; // Pokaż menu
                    setTimeout(() => {
                        mobileMenu.style.right = "0"; // Wysuwamy menu z prawej strony
                    }, 10); // Opóźnienie dla animacji
                } else {
                    mobileMenu.style.right = "-100%"; // Schowaj menu
                    setTimeout(() => {
                        mobileMenu.style.display = "none"; // Ukryj po zakończeniu animacji
                    }, 300); // Opóźnienie dla animacji
                }
            });


        </script>


        <div class="icons">
            <div id="theme-toggle" class="fas fa-sun"></div> <!-- Domyślnie ikona słońca -->
            <div class="fas fa-search" id="search-btn-icon"></div> <!-- LUPKA -->
            <div class="fas fa-shopping-cart" id="cart-btn" onclick="redirectCart()">
                <span id="cart-counter" class="cart-counter">0</span>
            </div>
            <div class="fas fa-bars" id="menu-btn"> </div> <!-- HAMBURGER -->
        </div>

        <!-- SEARCH TEXT BOX -->
        <div class="search-container">
            <div class="search-form">
                <input type="search" id="search-box" class="form-control"
                    placeholder="Na jaką kawę masz dzisiaj ochotę...">
                <label for="search-box" class="fas fa-search"></label> <!-- Bez ID -->
            </div>
        </div>


        <script>
            // Znajdź przycisk hamburgera i menu
            const menuBtn = document.getElementById('menu-btn');
            const navbar = document.querySelector('.navbar');

            // Funkcja do przełączania menu
            menuBtn.addEventListener('click', () => {
                navbar.classList.toggle('active'); // Dodaje lub usuwa klasę active
                console.log("Kliknięto przycisk hamburgera"); // Logowanie, aby sprawdzić, czy działa
            });
        </script>

        <!-- CART SECTION -->
        <div class="cart active">
            <h2 class="cart-title">Twoje zamówienie:</h2>
            <div class="cart-content">

            </div>
            <div class="total">
                <div class="total-title">Łącznie: </div>
                <div class="total-price">zł </div>
            </div>

            <!-- BUY BUTTON -->
            <button type="button" class="btn-buy">Zamów teraz</button>
        </div>

    </header>


    <?php
    session_start(); // Rozpocznij sesję
    
    // Pobierz imię z sesji, jeśli istnieje
    $imie = isset($_SESSION['imie']) ? htmlspecialchars($_SESSION['imie']) : 'Gościu';
    ?>

    <!-- HERO SECTION -->
    <section class="home" id="home">
        <div class="content">
            <h3>Witaj <?php echo $imie; ?> w Kawiarni Sombrerro!</h3>
            <p>
                <strong>Jesteśmy otwarci codziennie od 7:00 do 19:30</strong>
            </p>
            <a href="#menu" class="btn btn-dark text-decoration-none">Zamów online</a>
        </div>
    </section>

    <!-- ABOUT US SECTION -->
    <section class="about theme-bg-light theme-text-dark" id="about">
        <h1 class="heading"> <span>O nas </span></h1>
        <div class="row g-0">
            <div class="image">
                <img src="../zasoby/zdjecia/hero.png" alt="" class="img-fluid">
            </div>
            <div class="content">
                <h3 style="color: white;">Witamy w naszej Kawiarni</h3>

                <p>
                    <b>Kawiarnia Sombrerro – Twoja przystań pełna smaku i wyjątkowej atmosfery</b><br>
                    W sercu miasta, gdzie codzienność miesza się z chwilami wytchnienia, znajduje się Kawiarnia
                    Sombrerro – miejsce, które powstało z miłości do kawy, czekolady i radości płynącej z małych
                    przyjemności życia.
                    <br><br><i>Co nas wyróżnia?</i> <br>
                    ☕ <b>Kawa o wyjątkowym smaku</b> – wyselekcjonowane ziarna z najlepszych plantacji.<br>
                    🍰 <b>Desery z sercem</b> – od klasycznego tiramisu, przez kremowe serniki, po nietuzinkowe
                    ciasta.<br>
                    🎨 <b>Unikalny klimat</b> – połączenie nowoczesności z nutą meksykańskiego luzu. <br>
                </p>
                <p>
                    Dla każdego coś pysznego. Czy jesteś miłośnikiem porannego espresso, czy relaksujesz się przy
                    popołudniowym cappuccino – Kawiarnia Sombrerro ma dla Ciebie idealną propozycję.
                    <br>
                    <b>Zapraszamy codziennie – tu każdy dzień zaczyna się i kończy lepiej!</b><br>
                </p>
                <a href="#" class="btn btn-dark text-decoration-none">Zasmakuj więcej</a>
            </div>
        </div>
    </section>

    <!-- ZEPSUJMY COS -->
    <?php include 'recent_orders.php'; ?>

    <!-- MENU SECTION -->
    <section class="menu" id="menu">
        <h1 class="heading">Nasze <span>Menu</span></h1>
        <div class="box-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa1.png" alt="" class="product-img">
                            <h3 class="product-title">Espresso</h3>
                            <div class="price">8.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>

                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa3.png" alt="" class="product-img">
                            <h3 class="product-title">Cappuccino</h3>
                            <div class="price">10.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa4.png" alt="" class="product-img">
                            <h3 class="product-title">Latte Macchiato</h3>
                            <div class="price">12.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div>
                </div><br />
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa2.png" alt="" class="product-img">
                            <h3 class="product-title">Mocha</h3>
                            <div class="price">13.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa5.png" alt="" class="product-img">
                            <h3 class="product-title">Caramel Latte</h3>
                            <div class="price">14.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa8.png" alt="" class="product-img">
                            <h3 class="product-title">Affogato</h3>
                            <div class="price">15.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div>
                </div><br />
                <div class="row row-to-hide">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa7.png" alt="" class="product-img">
                            <h3 class="product-title">Nitro Cold Brew</h3>
                            <div class="price">15.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa6.png" alt="" class="product-img">
                            <h3 class="product-title">Iced Vanilla Latte</h3>
                            <div class="price">13.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa12.png" alt="" class="product-img">
                            <h3 class="product-title">Turkish Coffee</h3>
                            <div class="price">12.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div>
                </div><br />
                <div class="row row-to-hide">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa9.png" alt="" class="product-img">
                            <h3 class="product-title">Flat White</h3>
                            <div class="price">11.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa11.png" alt="" class="product-img">
                            <h3 class="product-title">Pumpkin Spiced Latte</h3>
                            <div class="price">14.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/kawa12.png" alt="" class="product-img">
                            <h3 class="product-title">Matcha Latte</h3>
                            <div class="price">14.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div>
                </div><br />
                <center>
                    <button id="showHideBtn" class="btn btn-dark">Pokaż więcej</button>
                </center>
            </div>
        </div>
    </section>



    <!-- BLOGS SECTION -->
    <section class="blogs" id="blogs">
        <h1 class="heading"><span>Blog</span></h1>
        <div class="box-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../zasoby/zdjecia/metody.png" alt="">
                            </div>
                            <div class="content">
                                <a href="https://swiezopalona.pl/blog/porownanie-roznych-metod-parzenia-kawy-espresso-i-kawiarka"
                                    target="_blank" class="title text-decoration-none">Porównanie różnych metod parzenia
                                    kawy</a>
                                <span>Blog: swiezopalona</span>
                                <p>Czy kiedykolwiek zastanawiałeś się, jak różne metody parzenia kawy wpływają na jej
                                    smak, aromat i właściwości zdrowotne? Jeśli tak, to ten artykuł jest dla Ciebie.</p>
                                <center>
                                    <a href="https://swiezopalona.pl/blog/porownanie-roznych-metod-parzenia-kawy-espresso-i-kawiarka"
                                        target="_blank" class="btn">Czytaj więcej</a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../zasoby/zdjecia/przyszlosc.png" alt="">
                            </div>
                            <div class="content">
                                <a href="https://www.explosia.blog/ciekawostki-zwiazane-z-kawa/przyszlosc-kawy-wyzwania-i-innowacje-w-swiecie-kawy/"
                                    target="_blank" class="title text-decoration-none">Przyszłość kawy: Wyzwania i
                                    innowacje w świecie kawy</span>
                                    <span>Blog: explosia</span>
                                    <p>Kawa, napój o głębokim smaku, aromacie i pobudzających właściwościach, od wieków
                                        towarzyszy ludzkości, a jej spożycie nieustannie wzrasta na całym świecie. Dla
                                        wielu osób kawa to codzienny rytuał, a dla innych – ważny element kultury i
                                        tradycji.</p>
                                    <center>
                                        <a href="https://www.explosia.blog/ciekawostki-zwiazane-z-kawa/przyszlosc-kawy-wyzwania-i-innowacje-w-swiecie-kawy/"
                                            target="_blank" class="btn">Czytaj więcej</a>
                                    </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <div class="image">
                                <img src="../zasoby/zdjecia/ranking.png" alt="brak">
                            </div>
                            <div class="content">
                                <a href="https://www.konesso.pl/RANKING-NAJLEPSZYCH-AUTOMATYCZNYCH-EKSPRESOW-2024-blog-pol-1711007082.html"
                                    target="_blank" class="title text-decoration-none">RANKING NAJLEPSZYCH
                                    AUTOMATYCZNYCH EKSPRESÓW 2024</a>
                                <p>Zapraszamy do odkrycia z nami ekspresów, które w 2024 roku definiują standardy
                                    jakości, wygody i stylu, by każdy poranek mógł być początkiem czegoś wyjątkowego.
                                    Oto nasz wyjątkowy ranking ekspresów do kawy na rok 2024</p>
                                <center>
                                    <a href="https://www.konesso.pl/RANKING-NAJLEPSZYCH-AUTOMATYCZNYCH-EKSPRESOW-2024-blog-pol-1711007082.html"
                                        target="_blank" class="btn">Czytaj więcej</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OPINION SECTION -->
    <section class="review" id="review">
        <h1 class="heading">Opinie</h1>
        <div class="box-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/quote-img.png" alt="" class="quote">
                            <p>
                                Kawiarnia Sombrerro to moje ulubione miejsce na spotkania z przyjaciółmi. Kawa zawsze
                                idealnie zaparzona, a ciasta są po prostu niebiańskie. Polecam szczególnie ich Latte
                                Macchiato!
                            </p>
                            <img src="../zasoby/zdjecia/awatar.png" alt="" class="user">
                            <h3 class="review-name">Anna K.</h3> <!-- Dodana klasa -->
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/quote-img.png" alt="" class="quote">
                            <p>
                                Cudowna atmosfera i przemiła obsługa! Uwielbiam spędzać tutaj czas, zwłaszcza z
                                filiżanką świeżo mielonej kawy. Polecam Nitro Cold Brew – coś wyjątkowego!
                            </p>
                            <img src="../zasoby/zdjecia/awatar.png" alt="" class="user">
                            <h3 class="review-name">Marek Z.</h3> <!-- Dodana klasa -->
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box">
                            <img src="../zasoby/zdjecia/quote-img.png" alt="" class="quote">
                            <p>
                                Zawsze, gdy mam chwilę dla siebie, odwiedzam Sombrerro. Wystrój jest przytulny, a kawa
                                pachnie jak w najlepszych kawiarniach we Włoszech. Matcha Latte to mój faworyt!
                            </p>
                            <img src="../zasoby/zdjecia/awatar.png" alt="" class="user">
                            <h3 class="review-name">Kasia M.</h3> <!-- Dodana klasa -->
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CONTACT US SECTION -->
    <section class="contact" id="contact">
        <h1 class="heading">Kontakt</h1>
        <div class="row">
            <div id="map" class="map pull-left">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3040.918488163871!2d21.982499526809274!3d50.01914421832455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473cfbb46da3e3ef%3A0x2a90710dbe86a513!2sAleja%20Powsta%C5%84c%C3%B3w%20Warszawy%2012%2C%2035-959%20Rzesz%C3%B3w!5e1!3m2!1spl!2spl!4v1736378400954!5m2!1spl!2spl"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <form id="contactForm" name="contact" method="POST">
                <h3 style="color: white;">Masz pytanie? Napisz do nas!</h3>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="Adres email" required>
                </div>
                <div class="inputBox">
                    <textarea name="message" placeholder="Wpisz swoją wiadomość..." required></textarea>
                </div>
                <button type="submit" class="btn">Wyślij teraz</button>
                <p id="responseMessage" style="display:none; color: white;"></p>
            </form>



        </div>
    </section>



    <!-- FOOTER SECTION -->
    <section class="footer">
        <div class="footer-container">
            <div class="logo">
                <img src="../zasoby/zdjecia/logo.png" class="img"><br />
                <i class="fas fa-envelope"></i>
                <p>Sombrerro@gmail.com</p><br />
                <i class="fas fa-phone"></i>
                <p>+48 123-456-789</p><br />
                <i class="fab fa-facebook-messenger"></i>
                <p>@Sombrerro</p><br />
            </div>
            <div class="support">
                <h2>Pomoc techniczna</h2>
                <br />
                <a href="#">Kontakt</a>
                <a href="#">Obsługa klienta</a>
                <a href="#">Zapytanie do chatbota</a>
                <a href="#">Zgłoś zgłoszenie</a>
            </div>

            <div class="company">
                <h2>Firma</h2>
                <br />
                <a href="#">O nas</a>
                <a href="#">Partnerzy afiliacyjni</a>
                <a href="#">Zasoby</a>
                <a href="#">Partnerstwo</a>
                <a href="#">Dostawcy</a>

            </div>
            <div class="newsletters">
                <h2 class="footer-heading">Newsletter</h2>
                <br />
                <p>Zapisz się do newslettera już dziś!</p>
                <form action="newsletter.php" method="POST">
                    <div class="input-wrapper">
                        <input type="email" name="email" class="newsletter" placeholder="Adres email" required>
                        <button type="submit" id="paper-plane-icon" class="fas fa-paper-plane"></button>
                    </div>
                </form>
            </div>
            <div class="credit" style="color: white;">
                <hr /><br />
                <h2>Kawiarria Sombrerro © 2024 | Wszelkie prawa zastrzeżone.</h2>
                <h2>Stworzone przez <span>Dawid Stachiewicz</span> || <span>Jakub Soboń</span> || <span>Katarzyna
                        Strzępek</span></h2>
            </div>
        </div>
    </section>



    <!-- CHAT BAR BLOCK -->
    <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible">Napisz do nas! &nbsp;
            <i id="chat-icon" style="color: #fff;" class="fas fa-comments"></i>
        </button>
        <div class="content">
            <div class="full-chat-block">


                <!-- Message Container -->
                <div class="outer-container">
                    <div class="chat-container">


                        <!-- Messages -->
                        <div id="chatbox">
                            <h5 id="chat-timestamp"></h5>
                            <p id="botStarterMessage" class="botText"><span>Ładowanie...</span></p>
                        </div>

                        <!-- User input box -->
                        <div class="chat-bar-input-block">
                            <div id="userInput">
                                <input id="textInput" class="input-box" type="text" name="msg"
                                    placeholder="Wciśnij 'Strzałkę' aby wysłać wiadomość">
                                <p></p>
                            </div>
                            <div class="chat-bar-icons">
                                <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-paper-plane"
                                    onclick="sendButton()"></i>
                            </div>
                        </div>
                        <div id="chat-bar-bottom">
                            <p></p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- JS File Link -->
    <script src="../zasoby/js/script.js"></script>
    <script src="../zasoby/js/responses.js"></script>
    <script src="../zasoby/js/convo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>



        // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN MENU
        $(document).ready(function () {
            $(".row-to-hide").hide();
            $("#showHideBtn").text("Pokaż więcej");
            $("#showHideBtn").click(function () {
                $(".row-to-hide").toggle();
                if ($(".row-to-hide").is(":visible")) {
                    $(this).text("Pokaż mniej");
                } else {
                    $(this).text("Pokaż więcej");
                }
            });
        });

        // CODE FOR THE REDIRECT CART
        function redirectCart() {
            // Check if the user is logged in
            if (!"<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : '' ?>") {
                // Redirect the user to the login page
                alert("Nie jesteś zalogowany. Zaloguj się na swoje konto i spróbuj ponownie.");
                window.location.href = "users/login.php";
            }
        }

    </script>

    <!-- Bootstrap Bundle JS (zawiera Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2Hhh_14Uam62GXGaTMcXWhhVkYg0EbDY&callback=initMap"
        async defer></script>

    <!-- ScrollReveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Custom JS -->
    <script src="zasoby/js/main.js"></script>

</body>



</html>