// Array para almacenar los productos en el carrito
let cart = [];

// Función para agregar productos al carrito
function addToCart(name, price) {
  // Buscar si el producto ya está en el carrito
  const productIndex = cart.findIndex(item => item.name === name);
  const quantity = parseInt($("#cantidad").val());
    
    if (productIndex !== -1) {
        cart[productIndex].quantity = quantity;
    }else {
        cart.push({ name, price, quantity: quantity });
    }
  
 // updateCart();
}

// Función para actualizar el carrito y el total
function updateCart() {
 // const cartItemsContainer = document.getElementById("cart-items");
  //const totalPriceElement = document.getElementById("total-price");
  let totalPrice = 0;

  // Limpiar el contenido del carrito antes de actualizar
  cartItemsContainer.innerHTML = "";

  // Recorrer los productos del carrito y mostrarlos
  cart.forEach(item => {
    // Crear un div para el producto
    const itemDiv = document.createElement("div");
    itemDiv.innerText = `${item.name} - $${item.price} x ${item.quantity}`;
    
    // Crear botón para eliminar el producto
    const removeButton = document.createElement("button");
    removeButton.innerText = "Eliminar";
    removeButton.onclick = () => removeFromCart(item.name);
    
    // Agregar el botón al div del producto
    itemDiv.appendChild(removeButton);
    cartItemsContainer.appendChild(itemDiv);

    // Sumar el precio total
    totalPrice += item.price * item.quantity;
  });

  // Actualizar el precio total en el HTML
  totalPriceElement.innerText = totalPrice;
}

// Función para eliminar un producto del carrito
function removeFromCart(name) {
  const productIndex = cart.findIndex(item => item.name === name);

  if (productIndex !== -1) {
    // Reducir la cantidad o eliminar el producto si es la última unidad
    if (cart[productIndex].quantity > 1) {
      cart[productIndex].quantity -= 1;
    } else {
      cart.splice(productIndex, 1);
    }
  }

  updateCart();
}
