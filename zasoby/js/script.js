document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    const cartItem = document.querySelector('.cart');
    const searchForm = document.querySelector('.search-form');
    const searchBtn = document.querySelector('#search-btn-icon'); // Ikona lupki
    const searchInput = document.querySelector('#search-box');   // Pole input

// Obsługa kliknięcia w lupkę
if (searchBtn && searchForm && searchInput) {
    searchBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        searchForm.classList.toggle('active'); // Rozwija lub zwija
        searchInput.focus();
    });
}

// Obsługa kliknięcia poza polem wyszukiwania
document.addEventListener('click', (e) => {
    if (!searchForm.contains(e.target) && searchForm.classList.contains('active')) {
        searchForm.classList.remove('active'); // Ukryj pole
        clearHighlights(); // Usuń podświetlenia
    }
});

// Obsługa zamknięcia na ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && searchForm.classList.contains('active')) {
        searchForm.classList.remove('active'); // Ukryj pole
        clearHighlights(); // Usuń podświetlenia
    }
});

// Obsługa ENTER w formularzu - podświetlenie na stronie
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault(); // Zatrzymanie domyślnego działania
        const query = searchInput.value.trim(); // Pobierz wartość inputa

        if (query) {
            clearHighlights(); // Wyczyść wcześniejsze podświetlenia
            highlightText(query); // Podkreśl tekst na stronie
        } else {
            alert('Wpisz coś, aby wyszukać!');
        }
    }
});

// Funkcja do podkreślania tekstu
function highlightText(query) {
    const elements = document.body.querySelectorAll('*:not(script):not(style):not(input):not(textarea)');
    const regex = new RegExp(`(${query})`, 'gi'); // Dopasuj fragmenty tekstu
    let found = false;

    elements.forEach(element => {
        if (element.children.length === 0) { // Tylko elementy bez dzieci (tekstowe)
            const text = element.textContent;

            if (regex.test(text)) {
                found = true;

                // Zapisz oryginalny tekst w atrybucie data-original-text
                if (!element.hasAttribute('data-original-text')) {
                    element.setAttribute('data-original-text', text);
                }

                // Podświetl znaleziony tekst
                element.innerHTML = text.replace(regex, '<mark class="highlight">$1</mark>');
            }
        }
    });

    // Przewinięcie do pierwszego wyniku
    const firstHighlight = document.querySelector('mark.highlight');
    if (firstHighlight) {
        firstHighlight.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else if (!found) {
        alert(`Brak wyników dla: "${query}"`);
    }
}

// Funkcja do czyszczenia podświetleń
function clearHighlights() {
    const elements = document.querySelectorAll('[data-original-text]'); // Znajdź elementy z atrybutem
    elements.forEach(element => {
        const originalText = element.getAttribute('data-original-text'); // Pobierz oryginalny tekst
        element.innerHTML = originalText; // Przywróć oryginalny tekst
        element.removeAttribute('data-original-text'); // Usuń atrybut
    });
}



    // Zamykanie formularza po kliknięciu poza nim
    window.addEventListener('click', (e) => {
        if (!searchForm.contains(e.target) && e.target !== searchBtn) {
            searchForm.classList.remove('active'); // Zamyka formularz
        }
    });

    // Zamknięcie wszystkich sekcji przy scrollu
    window.onscroll = () => {
        if (navbar) navbar.classList.remove('active');
        if (cartItem) cartItem.classList.remove('active');
        if (searchForm) searchForm.classList.remove('active');

    };

// Zamykanie menu po kliknięciu w link
const navLinks = document.querySelectorAll('.navbar a');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navbar.classList.remove('active'); // Zamyka menu po kliknięciu linku
    });
});

// Ukrywanie menu po przewinięciu strony
window.addEventListener('scroll', () => {
    navbar.classList.remove('active'); // Zamyka menu po scrollu
});




///////////////////////////////////////// Dark light motyw /////////////////////////

const themeToggleButton = document.getElementById('theme-toggle');
const themeIcon = themeToggleButton; // Ikona zmiany motywu

// Funkcja do przełączania motywu
const toggleTheme = () => {
    document.body.classList.toggle('dark-mode'); // Przełączanie klasy 'dark-mode' na body

    // Zmiana ikony motywu
    if (themeIcon.classList.contains('fa-sun')) {
        themeIcon.classList.remove('fa-sun');
        themeIcon.classList.add('fa-moon');
    } else {
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    }

    // Zapisanie preferencji motywu w localStorage
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark-mode'); // Zapisujemy ciemny motyw
    } else {
        localStorage.removeItem('theme'); // Usuwamy zapisany motyw, gdy jest jasny
    }
};

// Nasłuchiwanie kliknięcia przycisku zmiany motywu
themeToggleButton.addEventListener('click', toggleTheme);

// Sprawdzenie, czy użytkownik już wybrał motyw w localStorage
const currentTheme = localStorage.getItem('theme');
if (currentTheme === 'dark-mode') {
    document.body.classList.add('dark-mode'); // Ustawiamy ciemny motyw, jeśli zapisano w localStorage
    themeIcon.classList.remove('fa-sun');
    themeIcon.classList.add('fa-moon'); // Ustawiamy odpowiednią ikonę
}

///////////////////////////////////////// Dark light motyw /////////////////////////


////////// form


document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Zapobiegamy domyślnej akcji formularza (przeładowanie strony)

    const formData = new FormData(this); // Pobieramy dane z formularza

    // Tworzymy nowy obiekt XMLHttpRequest (AJAX)
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "users/submit_form.php", true); // Wysyłamy dane do PHP
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Jeśli odpowiedź jest poprawna (status 200), wyświetlamy komunikat
                document.getElementById("responseMessage").innerHTML = xhr.responseText;
                document.getElementById("responseMessage").style.display = "block"; // Wyświetlamy komunikat
            } else {
                // Jeśli wystąpił błąd, możemy wyświetlić komunikat o błędzie
                document.getElementById("responseMessage").innerHTML = "Wystąpił błąd, spróbuj ponownie.";
                document.getElementById("responseMessage").style.display = "block";
            }
        }
    };
    xhr.send(formData); // Wysyłamy dane formularza na serwer
});




//////////////////////////



window.addEventListener('scroll', function () {
    const header = document.querySelector('.header');
    header.classList.toggle('scroll', window.scrollY > 50);
});


const swiper = new Swiper('.swiper-container', {
    loop: true, // Infinity loop
    slidesPerView: 1, // Widoczny 1 slajd na raz
    spaceBetween: 20, // Odstęp między slajdami
    autoplay: {
        delay: 3000, // Przesuwanie co 3 sekundy
        disableOnInteraction: false, // Nie zatrzymuje po kliknięciu
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        768: { slidesPerView: 2 }, // Tablet
        1024: { slidesPerView: 3 }, // Komputer
    },
});




    // Obsługa koszyka
    const cartBtn = document.querySelector('#cart-btn');
    if (cartBtn && cartItem) {
        cartBtn.addEventListener('click', () => {
            cartItem.classList.toggle('active');
            navbar.classList.remove('active');
            searchForm.classList.remove('active');
        });
    }
});





//Cart Working JS
if (document.readyState == 'loading') {
    document.addEventListener("DOMContentLoaded", ready);
} else {
    ready();
}

// FUNCTIONS FOR CART
function ready() {
    //Remove Items from Cart
    var removeCartButtons = document.getElementsByClassName('cart-remove');
    console.log(removeCartButtons);
    for (var i = 0; i < removeCartButtons.length; i++){
        var button = removeCartButtons[i];
        button.addEventListener('click', removeCartItem);
    }

    // When quantity changes
    var quantityInputs = document.getElementsByClassName("cart-quantity");
    for (var i = 0; i < quantityInputs.length; i++){
        var input = quantityInputs[i];
        input.addEventListener("change", quantityChanged);
    }

    // Add to Cart
    var addCart = document.getElementsByClassName('add-cart');
    for (var i = 0; i < addCart.length; i++){
        var button = addCart[i];
        button.addEventListener("click", addCartClicked);
    }

    // Buy Button Works
    document.getElementsByClassName("btn-buy")[0].addEventListener("click", buyButtonClicked);
}

// Function for "Buy Button Works"
function buyButtonClicked() {
    alert('Zamówienie zostało złożone!');
    var cartContent = document.getElementsByClassName("cart-content")[0];
    var cartBoxes = cartContent.getElementsByClassName("cart-box");
    var orderDetails = [];

    // Generate invoice number
    var invoiceNumber = generateInvoiceNumber();

    // Loop through all cart boxes to get details
    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var title = cartBox.getElementsByClassName("cart-product-title")[0].innerText;
        var price = cartBox.getElementsByClassName("cart-price")[0].innerText;
        var quantity = cartBox.getElementsByClassName("cart-quantity")[0].value;
        var priceValue = parseFloat(price.replace('Zł', '').replace(',', ''));
        var subtotalAmount = priceValue * quantity;
        orderDetails.push({ title: title, price: priceValue, quantity: quantity, subtotal_amount: subtotalAmount, invoice_number: invoiceNumber });    
    }

    //Send data to server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_database.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(JSON.stringify(orderDetails));
    cartItem.classList.remove('active');

    // Clear cart after sending data to server
    while (cartContent.hasChildNodes()) {
        cartContent.removeChild(cartContent.firstChild);
    }
    updateTotal();
}

  //zepsujmy cos
function reorder(orderId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_database.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                alert(response.message);
                location.reload(); // Odśwież stronę
            } else {
                alert("Błąd: " + response.message);
            }
        }
    };
    xhr.send("order_id=" + orderId);
}


// Function to generate invoice number
function generateInvoiceNumber() {
    // Implement your logic to generate an invoice number here
    return "INV-" + Math.floor(Math.random() * 1000000);
}

// Function for "Remove Items from Cart"
function removeCartItem(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updateTotal();
}

// Function for "When quantity changes"
function quantityChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateTotal();
}

//Add to Cart
function addCartClicked(event) {
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName("product-title")[0].innerText;
    var price = shopProducts.getElementsByClassName("price")[0].innerText;
    var productImg = shopProducts.getElementsByClassName("product-img")[0].src;
    addProductToCart(title, price, productImg);
    updateTotal();
}

function addProductToCart(title, price, productImg) {
    var cartShopBox = document.createElement("div");
    cartShopBox.classList.add("cart-box");
    var cartItems = document.getElementsByClassName("cart-content")[0];
    var cartItemsNames = cartItems.getElementsByClassName("cart-product-title");
    for (var i = 0; i < cartItemsNames.length; i++) {
        if (cartItemsNames[i].innerText == title) {
            alert("You have already added this item to cart!")
            return;
        }
    }
    var cartBoxContent = `
                    <img src="${productImg}" alt="" class="cart-img">
                    <div class="detail-box">
                        <div class="cart-product-title">${title}</div>
                        <div class="cart-price">${price}</div>
                        <input type="number" value="1" min="1" class="cart-quantity">
                    </div>
                    <!-- REMOVE BUTTON -->
                    <i class="fas fa-trash cart-remove"></i>`;
    cartShopBox.innerHTML = cartBoxContent;
    cartItems.append(cartShopBox);
    cartShopBox
        .getElementsByClassName("cart-remove")[0]
        .addEventListener('click', removeCartItem);
    cartShopBox
        .getElementsByClassName("cart-quantity")[0]
        .addEventListener('change', quantityChanged);

}

// Update Total
function updateTotal() {
    var cartContent = document.getElementsByClassName("cart-content")[0];
    var cartBoxes = cartContent.getElementsByClassName("cart-box");
    var total = 0;
    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName("cart-price")[0];
        var quantityElement = cartBox.getElementsByClassName("cart-quantity")[0];
        var price = parseFloat(priceElement.innerText.replace("Zł", ""));
        var quantity = quantityElement.value;
        total = total + (price * quantity);
    }
        total = Math.round(total * 100) / 100;
        
        document.getElementsByClassName("total-price")[0].innerText = "Zł" + total;
}