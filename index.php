<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Kawiarnia Sombrerro</title>
    <link rel="icon" type="image/png" href="zasoby/zdjecia/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2Hhh_14Uam62GXGaTMcXWhhVkYg0EbDY&callback=initMap"
        async defer></script>
    <script src="https://unpkg.com/scrollreveal"></script>


    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="zasoby/css/style.css">
    <link rel="stylesheet" href="zasoby/css/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- font awesome cdn link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><!-- Google font cdn link -->
</head>


<div id="cookie-consent" class="cookie-banner" style="display:none;">
    <p>Ta strona używa ciasteczek (cookies) w celu zapewnienia lepszej funkcjonalności.
        <a href="users/privacy-policy.php" target="_blank">Dowiedz się więcej</a>
    </p>
    <button id="accept-cookies">Akceptuję</button>
</div>


<body>
    <!-- HEADER SECTION -->
    <header class="header">
        <a href="#" class="logo">
            <img src="zasoby/zdjecia/logo.png" class="img-logo" alt="Kawiarria Sombrero">
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
                    <a href="users/login.php" class="text-decoration-none">Login</a>
                </li>
            </ul>
            </div>
        </nav>
        <div class="icons">
            <div id="theme-toggle" class="fas fa-sun"></div> <!-- Domyślnie ikona słońca -->
            <div class="fas fa-search" id="search-btn-icon"></div> <!-- LUPKA -->
            <div class="fas fa-shopping-cart" id="cart-btn" onclick="redirectCart()"></div>
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
        <div class="cart">
            <h2 class="cart-title">Twoje zamówienie:</h2>
            <div class="cart-content">

            </div>
            <div class="total">
                <div class="total-title">Łącznie: </div>
                <div class="total-price">zł</div>
            </div>
            <!-- BUY BUTTON -->
            <button type="button" class="btn-buy">Zamów teraz</button>
        </div>
    </header>




    <!-- HERO SECTION -->
    <section class="home parallax" id="home">
        <div class="content">
            <h1>Witaj w Kawiarni Sobrerro!</h1>
            <p>Jesteśmy otwarci codziennie od 7:00 do 19:30</p>
            <a href="#menu" class="btn">Zamów Online</a>
        </div>
    </section>





    <!-- ABOUT US SECTION -->
    <section class="about" id="about">
        <h1 class="heading"> <span>O nas </span></h1>
        <div class="row g-0">
            <div class="image">
                <img src="zasoby/zdjecia/hero.png" alt="" class="img-fluid">
            </div>
            <div class="content">
                <h3>Witamy w naszej Kawiarri </h3>
                <p>
                    <b>Kawiarnia Sombrerro – Twoja przystań pełna smaku i wyjątkowej atmosfery</b><br>
                    W sercu miasta, gdzie codzienność miesza się z chwilami wytchnienia, znajduje się Kawiarnia
                    Sombrerro – miejsce, które powstało z miłości do kawy, czekolady i radości płynącej z małych
                    przyjemności życia.
                    W naszej kawiarni każdy znajdzie coś dla siebie – od aromatycznej kawy przygotowanej z najlepszych
                    ziaren, po ręcznie robione desery, które rozpieszczą Twoje podniebienie. To nie tylko miejsce, gdzie
                    możesz cieszyć się pysznym jedzeniem, ale również przestrzeń, która zaprasza do zatrzymania się na
                    chwilę, odpoczynku i spotkań z bliskimi.

                    <br><br><i>Co nas wyróżnia?</i> <br>
                    ☕ <b>Kawa o wyjątkowym smaku</b> – wyselekcjonowane ziarna z najlepszych plantacji, które wydobywają
                    głębię aromatów w każdej filiżance.<br>
                    🍰 <b>Desery z sercem</b> – od klasycznego tiramisu, przez kremowe serniki, po nietuzinkowe ciasta
                    inspirowane kuchniami świata. <br>
                    🎨 <b>Unikalny klimat</b> – połączenie nowoczesności z nutą meksykańskiego luzu – sombrero w nazwie
                    to nie przypadek! <br>

                </p>
                <p>

                    Dla każdego coś pysznego
                    Czy jesteś miłośnikiem porannego espresso, czy relaksujesz się przy popołudniowym cappuccino –
                    Kawiarnia Sombrerro ma dla Ciebie idealną propozycję. Zajrzyj też na naszą sezonową kartę –
                    znajdziesz tam gorące napoje, które ogrzeją zimą i orzeźwiające koktajle na lato.
                    <br>
                    <b>Zapraszamy codziennie – tu każdy dzień zaczyna się i kończy lepiej!</b><br>
                    📍 Znajdziesz nas w [tu wstaw lokalizację]. <br>
                    ⏰ Godziny otwarcia: [tu wstaw godziny]. <br>

                </p>
                <a href="#" class="btn btn-dark text-decoration-none">Zasmakuj więcej</a>
            </div>
        </div>
    </section>


    <!-- MENU SECTION -->
    <section class="menu" id="menu">
        <h1 class="heading">Nasze <span>Menu</span></h1>
        <div class="box-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa1.png" alt="" class="product-img">
                            <h3 class="product-title">Espresso</h3>
                            <div class="price">8.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa3.png" alt="" class="product-img">
                            <h3 class="product-title">Cappuccino</h3>
                            <div class="price">10.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa4.png" alt="" class="product-img">
                            <h3 class="product-title">Latte Macchiato</h3>
                            <div class="price">12.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div>
                </div><br />
                <div class="row">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa2.png" alt="" class="product-img">
                            <h3 class="product-title">Mocha</h3>
                            <div class="price">13.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa5.png" alt="" class="product-img">
                            <h3 class="product-title">Caramel Latte</h3>
                            <div class="price">14.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa8.png" alt="" class="product-img">
                            <h3 class="product-title">Affogato</h3>
                            <div class="price">15.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div>
                </div><br />
                <div class="row row-to-hide">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa7.png" alt="" class="product-img">
                            <h3 class="product-title">Nitro Cold Brew</h3>
                            <div class="price">15.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa6.png" alt="" class="product-img">
                            <h3 class="product-title">Iced Vanilla Latte</h3>
                            <div class="price">13.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa12.png" alt="" class="product-img">
                            <h3 class="product-title">Turkish Coffee</h3>
                            <div class="price">12.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div>
                </div><br />
                <div class="row row-to-hide">
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa9.png" alt="" class="product-img">
                            <h3 class="product-title">Flat White</h3>
                            <div class="price">11.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa11.png" alt="" class="product-img">
                            <h3 class="product-title">Pumpkin Spiced Latte</h3>
                            <div class="price">14.00 zł</div>
                            <a class="btn add-cart" onclick="redirectCart()">Zamów</a>
                        </div>
                    </div><br />
                    <div class="col-md-4">
                        <div class="box">
                            <img src="zasoby/zdjecia/kawa12.png" alt="" class="product-img">
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
                                <img src="zasoby/zdjecia/metody.png" alt="">
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
                                <img src="zasoby/zdjecia/przyszlosc.png" alt="">
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
                                <img src="zasoby/zdjecia/ranking.png" alt="brak">
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
                            <img src="zasoby/zdjecia/quote-img.png" alt="" class="quote">
                            <p>
                                Kawiarnia Sombrerro to moje ulubione miejsce na spotkania z przyjaciółmi. Kawa zawsze
                                idealnie zaparzona, a ciasta są po prostu niebiańskie. Polecam szczególnie ich Latte
                                Macchiato!
                            </p>
                            <img src="zasoby/zdjecia/awatar.png" alt="" class="user">
                            <h3>Anna K.</h3>
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
                            <img src="zasoby/zdjecia/quote-img.png" alt="" class="quote">
                            <p>
                                Cudowna atmosfera i przemiła obsługa! Uwielbiam spędzać tutaj czas, zwłaszcza z
                                filiżanką świeżo mielonej kawy. Polecam Nitro Cold Brew – coś wyjątkowego!
                            </p>
                            <img src="zasoby/zdjecia/awatar.png" alt="" class="user">
                            <h3>Marek Z.</h3>
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
                            <img src="zasoby/zdjecia/quote-img.png" alt="" class="quote">
                            <p>
                                Zawsze, gdy mam chwilę dla siebie, odwiedzam Sombrerro. Wystrój jest przytulny, a kawa
                                pachnie jak w najlepszych kawiarniach we Włoszech. Matcha Latte to mój faworyt!
                            </p>
                            <img src="zasoby/zdjecia/awatar.png" alt="" class="user">
                            <h3>Kasia M.</h3>
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
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2563.9114942322176!2d22.45310407701254!3d50.013014071512025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473c92277e781eb1%3A0x63e46b804bba156b!2sUrzejowice%20152A%2C%2037-221%20Urzejowice!5e0!3m2!1spl!2spl!4v1732310993264!5m2!1spl!2spl"
                    style="border:0; width:100%; height:100%;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <form id="contactForm" name="contact" method="POST" action="users/submit_form.php">
                <h3>Masz pytanie? Napisz do nas!</h3>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="Adres email" required>
                </div>
                <div class="inputBox">
                    <textarea name="message" placeholder="Wpisz swoją wiadomość..." required></textarea>
                </div>
                <button type="submit" class="btn">Wyślij teraz</button>
                <!-- Komunikat pojawi się tutaj -->
                <p id="responseMessage" style="display:none;"></p>
            </form>

        </div>
    </section>



    <!-- FOOTER SECTION -->
    <section class="footer">
        <div class="footer-container">
            <div class="logo">
                <img src="zasoby/zdjecia/logo.png" class="img"><br />
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
                <h2>Newsletter</h2>
                <br />
                <p>Zapisz się do newslettera już dziś!</p>
                <div class="input-wrapper">
                    <input type="email" class="newsletter" placeholder="Adres email">
                    <i id="paper-plane-icon" class="fas fa-paper-plane"></i>
                </div>
            </div>
            <div class="credit">
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
    <script src="zasoby/js/responses.js"></script>
    <script src="zasoby/js/convo.js"></script>
    <script src="zasoby/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>
        // CODE FOR THE FORMSPREE
        window.onbeforeunload = () => {
            for (const form of document.getElementsByTagName('form')) {
                form.reset();
            }
        }

        // CODE FOR THE GOOGLE MAPS API
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 14.99367271992383, lng: 120.17629231186626 },
                zoom: 9
            });

            var marker = new google.maps.Marker({
                position: { lat: 14.99367271992383, lng: 120.17629231186626 },
                map: map,
                title: 'Twoja lokalizacja'
            });
        }

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


    <!-- Plik CSS do komunikatu -->
    <link rel="stylesheet" href="zasoby/css/validation.css">
    <!-- Skrypt JS do obsługi komunikatu -->
    <script src="zasoby/js/cookie-consent.js"></script>

</body>

</html>