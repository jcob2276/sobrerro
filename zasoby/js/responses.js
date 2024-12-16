function getBotResponse(input) {
    // Simple responses
    if (input == "czesc") {
        return "Witaj, w czym mogę pomóc?";
    } else if (input == "hej") {
        return "Witaj, w czym mogę pomóc?";
    } else if (input == "witaj") {
        return "Witaj, w czym mogę pomóc?";
    } else if (input == "dzien dobry") {
        return "Witaj, w czym mogę pomóc?";
    } else if (input == "polecenia") {
        return "Komendy: <br/><br/> <strong>Menu</strong> - wyświetla menu <br/> <strong>O nas</strong> - Dowiedz się więcej o nas. <br/> <strong>Kontakt</strong>- Kontakt d o nas. <br/> <strong>Polecenia</strong> - wyświetla dostępne komendy. <br/> <strong>jak zamówić</strong> - instrukcja do zamawiania. <br/> <strong>lokalizacja</strong> - Nasz adres.";
    } else if (input == "menu") {
        return "Nasze menu: <br /><br /> Espresso - 8.00 zł <br /> Cappucino - 10.00 zł <br /> Latte Macchiato - 12.00 zł <br /> Caramel Latte - 14.00 zł <br /> Affogato - 15.00 zł ";
    } else if (input == "o nas") {
        return "Cześć! <br /><br /> <strong>Kawiarria Sombrerro</strong> to kawiarnia dla każdego miłośnika kawy.";
    } else if (input == "kontakt") {
        return "Tutaj kontakt do nas: <br /><br /> <strong>Email:</strong> sombrerro@gmail.com <br /> <strong>Numer telefonu:</strong> 123 456 789 <br /> <strong>Messenger:</strong> @sombrerro <br /> <strong>Adres:</strong> Rzeszów, Poland ";
    } else if (input == "jak zamówić") {
        return "Witaj! <br /><br /> Aby zamówić przejdź do naszego <strong>Menu</strong> i kliknij <strong>'Zamów'</strong> gdy wybierzesz produkt. <br /><br /> Mam nadzieję, że zrozumiałeś instrukcję. Dziękuję i smacznego!";
    } else if (input == "lokalizacja") {
        return "Nasz adres: <strong>Rzeszów, Powstańców Warszawy 12, Poland</strong>";

    /*
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    } else if (input == "hi") {
        return "Hi there! What can I do for you?";
    */
   
    } else {
        return "Spróbuj innego polecenia!";
    }
}