// JavaScript para la funcionalidad del carrito

function addToCart(id, name, price) {
    // Obtener el carrito del localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Verificar si el producto ya está en el carrito
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        alert('Este producto ya está en el carrito.');
        return;
    }

    // Agregar el nuevo producto al carrito
    cart.push({ id: id, name: name, price: price });
    localStorage.setItem('cart', JSON.stringify(cart));

    // Mostrar mensaje de éxito (opcional)
    alert('Producto añadido al carrito.');

    // Actualizar contador de productos en el header (opcional)
    updateCartCounter();
}

function updateCartCounter() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartLogo = document.querySelector('.header-right img[alt="Carrito"]');
    if (cartLogo) {
        cartLogo.setAttribute('title', `Carrito (${cart.length})`);
    }
}

// Función para ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    updateCartCounter();
});
