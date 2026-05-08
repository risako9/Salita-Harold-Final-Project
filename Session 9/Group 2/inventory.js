const inventoryTable = document.getElementById('inventory-table');
const searchInput = document.getElementById('inventory-search');
const addProductForm = document.getElementById('add-product-form');
const showLimitedBtn = document.getElementById('show-limited-btn');
const limitedCount = document.getElementById('limited-count');
const resetInventoryBtn = document.getElementById('reset-inventory-btn');

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

let showLimitedOnly = false;

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

function getStatus(stock) {
  if (stock <= 0) return { text: 'Out of stock', className: 'badge bg-danger', rowClass: 'out-stock' };
  if (stock <= 5) return { text: 'Limited stock', className: 'badge bg-warning text-dark', rowClass: 'low-stock' };
  return { text: 'Available', className: 'badge bg-success', rowClass: '' };
}

function renderInventory() {
  const products = getProducts();
  const keyword = searchInput.value.toLowerCase();

  const filteredProducts = products.filter(product => {
    const matchesSearch = product.name.toLowerCase().includes(keyword);
    const matchesLimited = !showLimitedOnly || product.stock <= 5;
    return matchesSearch && matchesLimited;
  });

  inventoryTable.innerHTML = '';

  filteredProducts.forEach(product => {
    const status = getStatus(product.stock);
    inventoryTable.innerHTML += `
      <tr class="${status.rowClass}">
        <td>${product.name}</td>
        <td>$${product.price}</td>
        <td>${product.stock}</td>
        <td><span class="${status.className}">${status.text}</span></td>
        <td class="text-end">
          <button class="btn btn-sm btn-success me-2" onclick="addStock('${product.id}')">+ Add Stock</button>
          <button class="btn btn-sm btn-danger" onclick="deleteProduct('${product.id}')">Delete</button>
        </td>
      </tr>
    `;
  });

  limitedCount.textContent = products.filter(product => product.stock > 0 && product.stock <= 5).length;
}

function addStock(productId) {
  const products = getProducts();
  const product = products.find(product => product.id === productId);

  if (product) {
    product.stock += 1;
    saveProducts(products);
    renderInventory();
  }
}

function deleteProduct(productId) {
  const products = getProducts().filter(product => product.id !== productId);
  saveProducts(products);
  renderInventory();
}

addProductForm.addEventListener('submit', function(event) {
  event.preventDefault();

  const products = getProducts();
  const name = document.getElementById('product-name').value.trim();
  const price = Number(document.getElementById('product-price').value);
  const stock = Number(document.getElementById('product-stock').value);

  products.push({
    id: `${slugify(name)}-${Date.now()}`,
    name,
    price,
    stock
  });

  saveProducts(products);
  addProductForm.reset();
  renderInventory();
});

searchInput.addEventListener('keyup', renderInventory);

showLimitedBtn.addEventListener('click', function() {
  showLimitedOnly = !showLimitedOnly;
  showLimitedBtn.textContent = showLimitedOnly ? 'Show all stocks' : 'Show limited stocks only';
  renderInventory();
});

if (resetInventoryBtn) {
  resetInventoryBtn.addEventListener('click', function() {
    localStorage.setItem('shoeInventoryProducts', JSON.stringify(defaultProducts));
    renderInventory();
  });
}

window.addEventListener('storage', renderInventory);
window.addEventListener('focus', renderInventory);

renderInventory();
