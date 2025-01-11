// DOMContentLoaded Event Listener - Initialize Script
document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    const cartItem = document.querySelector('.cart');
    const searchForm = document.querySelector('.search-form');
    const searchBtn = document.querySelector('#search-btn-icon');
    const searchInput = document.querySelector('#search-box');
    const themeToggleButton = document.getElementById('theme-toggle');
    const themeIcon = themeToggleButton;

    // ================== Search Functionality ==================
    if (searchBtn && searchForm && searchInput) {
        searchBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            searchForm.classList.toggle('active');
            searchInput.focus();
        });

        document.addEventListener('click', (e) => {
            if (!searchForm.contains(e.target) && searchForm.classList.contains('active')) {
                searchForm.classList.remove('active');
                clearHighlights();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchForm.classList.contains('active')) {
                searchForm.classList.remove('active');
                clearHighlights();
            }
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query) {
                    clearHighlights();
                    highlightText(query);
                } else {
                    alert('Wpisz coś, aby wyszukać!');
                }
            }
        });
    }

    // ================== Navbar Functionality ==================
    document.querySelector('#menu-btn')?.addEventListener('click', () => {
        navbar.classList.toggle('active');
        cartItem.classList.remove('active');
        searchForm.classList.remove('active');
    });

    const navLinks = document.querySelectorAll('.navbar a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navbar.classList.remove('active');
        });
    });

    window.addEventListener('scroll', () => {
        navbar.classList.remove('active');
        cartItem.classList.remove('active');
        searchForm.classList.remove('active');
    });

    // ================== Cart Functionality ==================
    document.querySelector('#cart-btn')?.addEventListener('click', () => {
        cartItem.classList.toggle('active');
        navbar.classList.remove('active');
        searchForm.classList.remove('active');
    });

    if (document.readyState === 'loading') {
        document.addEventListener("DOMContentLoaded", cartReady);
    } else {
        cartReady();
    }

    // ================== Theme Toggle Functionality ==================
    themeToggleButton?.addEventListener('click', () => toggleTheme(themeIcon));
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'dark-mode') {
        document.body.classList.add('dark-mode');
        themeIcon.classList.remove('fa-sun');
        themeIcon.classList.add('fa-moon');
    }
});

// ================== Search Highlight Functions ==================
function highlightText(query) {
    const elements = document.body.querySelectorAll('*:not(script):not(style):not(input):not(textarea)');
    const regex = new RegExp(`(${query})`, 'gi');
    let found = false;

    elements.forEach(element => {
        if (element.children.length === 0) {
            const text = element.textContent;
            if (regex.test(text)) {
                found = true;
                if (!element.hasAttribute('data-original-text')) {
                    element.setAttribute('data-original-text', text);
                }
                element.innerHTML = text.replace(regex, '<mark class="highlight">$1</mark>');
            }
        }
    });

    const firstHighlight = document.querySelector('mark.highlight');
    if (firstHighlight) {
        firstHighlight.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else if (!found) {
        alert(`Brak wyników dla: "${query}"`);
    }
}

function clearHighlights() {
    const elements = document.querySelectorAll('[data-original-text]');
    elements.forEach(element => {
        const originalText = element.getAttribute('data-original-text');
        element.innerHTML = originalText;
        element.removeAttribute('data-original-text');
    });
}


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

// ================== Cart Functions ==================

function updateCartCounter() {
    const cartItems = document.querySelectorAll(".cart-box");
    const cartCounter = document.getElementById("cart-counter");

    // Zlicz wszystkie produkty w koszyku (sumując ich ilości)
    const totalItems = Array.from(cartItems).reduce((total, cartBox) => {
        const quantity = parseInt(cartBox.querySelector(".cart-quantity").value);
        return total + quantity;
    }, 0);

    cartCounter.textContent = totalItems;

    // Ukryj licznik, jeśli jest pusty, lub pokaż, jeśli są produkty
    cartCounter.style.visibility = totalItems > 0 ? "visible" : "hidden";
}



function cartReady() {
    const removeCartButtons = document.getElementsByClassName('cart-remove');
    Array.from(removeCartButtons).forEach(button => button.addEventListener('click', removeCartItem));

    const quantityInputs = document.getElementsByClassName("cart-quantity");
    Array.from(quantityInputs).forEach(input => input.addEventListener("change", quantityChanged));

    const addCartButtons = document.getElementsByClassName('add-cart');
    Array.from(addCartButtons).forEach(button => button.addEventListener("click", addCartClicked));

    document.getElementsByClassName("btn-buy")[0]?.addEventListener("click", buyButtonClicked);
}

function removeCartItem(event) {
    event.target.parentElement.remove();
    updateTotal();
    updateCartCounter();
}


function quantityChanged(event) {
    const input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateTotal();
    updateCartCounter();
}


function addCartClicked(event) {
    const button = event.target;
    const shopProducts = button.parentElement;
    const title = shopProducts.querySelector(".product-title").innerText;
    const price = shopProducts.querySelector(".price").innerText;
    const productImg = shopProducts.querySelector(".product-img").src;

    addProductToCart(title, price, productImg);
    updateTotal();
    updateCartCounter();
}


function addProductToCart(title, price, productImg) {
    const cartItems = document.querySelector(".cart-content");

    // Sprawdź, czy produkt już istnieje w koszyku
    const existingCartItem = Array.from(cartItems.getElementsByClassName("cart-product-title"))
        .find(cartItem => cartItem.innerText.trim().toLowerCase() === title.trim().toLowerCase());

    if (existingCartItem) {
        // Zwiększ ilość istniejącego produktu
        const cartBox = existingCartItem.closest('.cart-box');
        const quantityInput = cartBox.querySelector('.cart-quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;

        // Aktualizuj sumę i licznik
        updateTotal();
        updateCartCounter();
        return;
    }

    // Jeśli produkt nie istnieje, dodaj go do koszyka
    const cartShopBox = document.createElement("div");
    cartShopBox.classList.add("cart-box");
    cartShopBox.innerHTML = `
        <img src="${productImg}" alt="" class="cart-img">
        <div class="detail-box">
            <div class="cart-product-title">${title}</div>
            <div class="cart-price">${price}</div>
            <input type="number" value="1" min="1" class="cart-quantity">
        </div>
        <i class="fas fa-trash cart-remove"></i>`;
    cartItems.append(cartShopBox);

    // Dodaj nasłuchiwacze dla nowo dodanych elementów
    cartShopBox.querySelector(".cart-remove").addEventListener('click', removeCartItem);
    cartShopBox.querySelector(".cart-quantity").addEventListener('change', quantityChanged);

    // Aktualizuj sumę i licznik
    updateTotal();
    updateCartCounter();
}


function updateTotal() {
    const cartBoxes = document.querySelectorAll(".cart-box");
    let total = 0;

    cartBoxes.forEach(cartBox => {
        const price = parseFloat(cartBox.querySelector(".cart-price").innerText.replace("Zł", ""));
        const quantity = parseInt(cartBox.querySelector(".cart-quantity").value);
        total += price * quantity;
    });

    total = Math.round(total * 100) / 100;
    document.querySelector(".total-price").innerText = "Zł" + total;
}


function buyButtonClicked() {
    const cartContent = document.querySelector(".cart-content");
    const cartBoxes = document.querySelectorAll(".cart-box");

    let orderDetails = [];
    cartBoxes.forEach(cartBox => {
        const title = cartBox.querySelector(".cart-product-title").innerText;
        const price = parseFloat(cartBox.querySelector(".cart-price").innerText.replace("Zł", ""));
        const quantity = parseInt(cartBox.querySelector(".cart-quantity").value);
        orderDetails.push({ title, price, quantity });
    });

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_database.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("Zamówienie zostało złożone!");
            cartContent.innerHTML = '';
            updateTotal();
        }
    };
    xhr.send(JSON.stringify(orderDetails));
}







// ================== Theme Toggle Functionality ==================
themeToggleButton?.addEventListener('click', () => toggleTheme(themeIcon));

// Sprawdzenie zapisanej wartości motywu w localStorage
const currentTheme = localStorage.getItem('theme');

// Ustawienie motywu podczas ładowania strony
if (currentTheme === 'dark-mode') {
    document.body.classList.add('dark-mode');
    themeIcon.classList.remove('fa-sun');
    themeIcon.classList.add('fa-moon');
} else {
    themeIcon.classList.remove('fa-moon');
    themeIcon.classList.add('fa-sun');
}

// Funkcja do przełączania motywu
function toggleTheme(themeIcon) {
    document.body.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
        themeIcon.classList.replace('fa-sun', 'fa-moon'); // Ikona księżyca
        localStorage.setItem('theme', 'dark-mode');      // Zapis w localStorage
    } else {
        themeIcon.classList.replace('fa-moon', 'fa-sun'); // Ikona słońca
        localStorage.removeItem('theme');                // Usunięcie zapisu
    }
}



