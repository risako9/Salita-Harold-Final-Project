
// search function

const searchBar = document.getElementById("search-bar");
const cards = document.querySelectorAll(".card");

searchBar.addEventListener("keyup", function () {
  const searchValue = searchBar.value.toLowerCase();

  cards.forEach(card => {
    const title = card.querySelector(".card-title").textContent.toLowerCase();
    const description = card.querySelector(".card-text").textContent.toLowerCase();

    if (title.includes(searchValue) || description.includes(searchValue)) {
      card.style.display = "block";
    } else {
      card.style.display = "none";
    }
  });
});

//sidebar

const addToCartButtons = document.querySelectorAll(".btn-primary");
const cartItems = document.getElementById("cart-items");
const cartTotal = document.getElementById("cart-total");
const checkoutBtn = document.getElementById("checkout-btn");

let total = 0;

addToCartButtons.forEach(function(button) {
  button.addEventListener("click", function(event) {
    event.preventDefault();

    const card = button.closest(".card");
    const title = card.querySelector(".card-title").innerText;
    const priceText = card.querySelector(".card-body p:nth-of-type(2)").innerText;
    const price = Number(priceText.replace("$", ""));

    const item = document.createElement("div");
    item.classList.add("cart-item");

    item.innerHTML = `
      <p><strong>${title}</strong></p>
      <p>$${price}</p>
    `;

    cartItems.appendChild(item);

    total += price;
    cartTotal.innerText = total;
      });
});

checkoutBtn.addEventListener("click", () => {
  // Check if the total is 0 or if there are no items in the cart
  if (total === 0) {
    alert("No item was purchased");
  } else {
    alert("Thank you for your purchase");

    // Clear cart items and reset total
    cartItems.innerHTML = "";
    total = 0; // Important: Reset the variable so the next purchase starts at 0
    cartTotal.textContent = "0";
  }
});