const defaultProducts = [
  { id: 'shadow-drift-max', name: 'Shadow Drift Max', price: 80, stock: 12 },
  { id: 'prism-pulse-max', name: 'Prism Pulse Max', price: 90, stock: 4 },
  { id: 'frost-glide-max', name: 'Frost Glide Max', price: 100, stock: 2 },
  { id: 'neon-circuit-max', name: 'Neon Circuit Max', price: 110, stock: 8 },
  { id: 'classic-court-low', name: 'Classic Court Low', price: 120, stock: 0 },
  { id: 'crimson-velocity', name: 'Crimson Velocity', price: 130, stock: 5 },
  { id: 'retro-racer-lx', name: 'Retro Racer LX', price: 140, stock: 6 },
  { id: 'steel-ember-trainer', name: 'Steel Ember Trainer', price: 150, stock: 3 }
];

let cart = [];

function slugify(text) {
  return text.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
}

function getProducts() {
  const savedProducts = localStorage.getItem('shoeInventoryProducts');
  if (!savedProducts) {
    localStorage.setItem('shoeInventoryProducts', JSON.stringify(defaultProducts));
    return [...defaultProducts];
  }
  return JSON.parse(savedProducts);
}

function saveProducts(products) {
  localStorage.setItem('shoeInventoryProducts', JSON.stringify(products));
}

function findProductByName(name) {
  return getProducts().find(product => product.name === name);
}

function updateCartDisplay() {
  const cartItems = document.getElementById('cart-items');
  const cartTotal = document.getElementById('cart-total');
  if (!cartItems || !cartTotal) return;

  cartItems.innerHTML = '';
  let total = 0;

  cart.forEach(item => {
    total += item.price * item.quantity;
    cartItems.innerHTML += `
      <div class="d-flex justify-content-between border-bottom py-2">
        <span>${item.name} x ${item.quantity}</span>
        <strong>$${item.price * item.quantity}</strong>
      </div>
    `;
  });

  cartTotal.textContent = total;
}

function updateProductCards() {
  const products = getProducts();
  const cards = document.querySelectorAll('.card');

  cards.forEach(card => {
    const title = card.querySelector('.card-title');
    const button = card.querySelector('.btn-primary');
    if (!title || !button) return;

    const product = products.find(item => item.name === title.textContent.trim());
    if (!product) return;

    button.dataset.productId = product.id;

    let stockText = card.querySelector('.stock-text');
    if (!stockText) {
      stockText = document.createElement('p');
      stockText.className = 'stock-text fw-bold mb-2';
      button.before(stockText);
    }

    if (product.stock <= 0) {
      stockText.textContent = 'Out of stock';
      stockText.className = 'stock-text fw-bold text-danger mb-2';
      button.textContent = 'Out of Stock';
      button.classList.add('disabled');
      button.setAttribute('aria-disabled', 'true');
    } else {
      stockText.textContent = `Stock: ${product.stock}`;
      stockText.className = product.stock <= 5
        ? 'stock-text fw-bold text-warning mb-2'
        : 'stock-text fw-bold text-success mb-2';
      button.textContent = 'Add to Cart';
      button.classList.remove('disabled');
      button.removeAttribute('aria-disabled');
    }
  });
}

function addToCart(productId) {
  const products = getProducts();
  const product = products.find(item => item.id === productId);

  if (!product || product.stock <= 0) {
    alert('Out of stock');
    updateProductCards();
    return;
  }

  product.stock -= 1;
  saveProducts(products);

  const existingCartItem = cart.find(item => item.id === product.id);
  if (existingCartItem) {
    existingCartItem.quantity += 1;
  } else {
    cart.push({ id: product.id, name: product.name, price: product.price, quantity: 1 });
  }

  updateCartDisplay();
  updateProductCards();
}

document.addEventListener('DOMContentLoaded', function () {
  updateProductCards();

  document.querySelectorAll('.card .btn-primary').forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();
      if (button.classList.contains('disabled')) return;
      addToCart(button.dataset.productId);
    });
  });

  const checkoutBtn = document.getElementById('checkout-btn');
  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', function () {
      alert('Thank you for your purchase');
      cart = [];
      updateCartDisplay();
    });
  }

  const searchBar = document.getElementById('search-bar');
  if (searchBar) {
    searchBar.addEventListener('keyup', function () {
      const keyword = searchBar.value.toLowerCase();
      document.querySelectorAll('.card').forEach(card => {
        const title = card.querySelector('.card-title');
        if (!title) return;
        card.style.display = title.textContent.toLowerCase().includes(keyword) ? '' : 'none';
      });
    });
  }
});

window.addEventListener('storage', updateProductCards);
window.addEventListener('focus', updateProductCards);
