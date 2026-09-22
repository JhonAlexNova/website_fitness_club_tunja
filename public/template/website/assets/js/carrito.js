const CART_STORAGE_KEY = 'fitness_club_tunja_cart';

let cart = [];

try {
  cart = JSON.parse(localStorage.getItem(CART_STORAGE_KEY) || '[]');
  if (!Array.isArray(cart)) cart = [];
} catch (error) {
  cart = [];
}

function saveCart() {
  try {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
  } catch (error) {
    // El carrito sigue funcionando durante la sesión si el navegador bloquea storage.
  }
}

function addToCart(id, name, price) {
  // Compatibilidad con enlaces antiguos que todavía envían (nombre, precio).
  if (typeof id !== 'number') { price = name; name = id; id = null; }
  const quantityInput = document.getElementById('cantidad');
  const quantity = Math.max(1, parseInt(quantityInput ? quantityInput.value : 1, 10) || 1);
  const numericPrice = Number(price) || 0;
  const productIndex = cart.findIndex(item => item.id === id || item.name === name);

  if (productIndex !== -1) {
    cart[productIndex].quantity += quantity;
  } else {
    cart.push({ id, name, price: numericPrice, quantity });
  }

  saveCart();
  updateCart();
}

function formatPrice(value) {
  return '$' + Number(value || 0).toLocaleString('es-CO');
}

function updateCart() {
  const cartItemsContainer = document.getElementById('cart-items');
  const totalPriceElement = document.getElementById('total-price');
  const emptyState = document.getElementById('cart-empty');
  const cartContent = document.getElementById('cart-content');

  if (!cartItemsContainer || !totalPriceElement) return;

  cartItemsContainer.innerHTML = '';
  let totalPrice = 0;

  cart.forEach((item, index) => {
    const row = document.createElement('tr');
    const itemTotal = Number(item.price || 0) * Number(item.quantity || 0);
    totalPrice += itemTotal;

    const nameCell = document.createElement('td');
    nameCell.textContent = item.name;
    const priceCell = document.createElement('td');
    priceCell.textContent = formatPrice(item.price);
    const quantityCell = document.createElement('td');
    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.min = '1';
    quantityInput.value = item.quantity;
    quantityInput.setAttribute('aria-label', 'Cantidad de ' + item.name);
    quantityInput.addEventListener('change', () => {
      cart[index].quantity = Math.max(1, parseInt(quantityInput.value, 10) || 1);
      saveCart();
      updateCart();
    });
    quantityCell.appendChild(quantityInput);
    const totalCell = document.createElement('td');
    totalCell.textContent = formatPrice(itemTotal);
    const actionCell = document.createElement('td');
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'cart-remove';
    removeButton.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i><span class="sr-only">Eliminar</span>';
    removeButton.addEventListener('click', () => removeFromCart(item.name));
    actionCell.appendChild(removeButton);

    row.append(nameCell, priceCell, quantityCell, totalCell, actionCell);
    cartItemsContainer.appendChild(row);
  });

  totalPriceElement.textContent = formatPrice(totalPrice);

  if (emptyState && cartContent) {
    emptyState.hidden = cart.length > 0;
    cartContent.hidden = cart.length === 0;
  }
}

function openCheckout() {
  const validItems = cart.filter(item => item.id);
  if (!validItems.length) {
    alert('Actualiza el carrito agregando nuevamente los productos desde la tienda.');
    return;
  }
  const form = document.getElementById('checkout-form');
  if (form) form.querySelector('[name="items"]').value = JSON.stringify(validItems.map(item => ({id: item.id, quantity: item.quantity})));
  if (form) form.submit();
}

function removeFromCart(name) {
  cart = cart.filter(item => item.name !== name);
  saveCart();
  updateCart();
}

document.addEventListener('DOMContentLoaded', updateCart);

document.addEventListener('DOMContentLoaded', function () {
  const button = document.getElementById('add-to-cart-button');
  if (!button) return;

  button.addEventListener('click', function (event) {
    event.preventDefault();
    addToCart(
      Number(button.dataset.productId),
      button.dataset.productName,
      Number(button.dataset.productPrice)
    );
    button.textContent = 'Producto agregado · Ver carrito';
    button.href = button.href || '/carrito';
    button.classList.add('added-to-cart');
    window.dispatchEvent(new Event('storage'));
    window.setTimeout(function () { window.location.href = button.href; }, 350);
  });
});
