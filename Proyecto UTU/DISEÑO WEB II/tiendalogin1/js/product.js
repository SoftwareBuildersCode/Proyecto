document.addEventListener('DOMContentLoaded', () => {
    const productos = [
        { id: 1, name: "iPhone 11 64gb", description: "Reacondicionado", price: 397.85, color: "Negro", stock: "Disponible", imgSrc: "img/productos/producto1.jpg" },
        { id: 2, name: "Producto 2", description: "Descripción completa del producto 2.", price: 200.00, color: "Blanco", stock: "Agotado", imgSrc: "img/productos/producto2.jpg" },
        { id: 3, name: "Producto 3", description: "Descripción completa del producto 3.", price: 30.00, color: "Azul", stock: "Disponible", imgSrc: "img/productos/producto3.jpg" },
        { id: 4, name: "Producto 4", description: "Descripción completa del producto 4.", price: 40.00, color: "Rojo", stock: "Disponible", imgSrc: "img/productos/producto4.jpg" },
        { id: 5, name: "Producto 5", description: "Descripción completa del producto 5.", price: 50.00, color: "Verde", stock: "Agotado", imgSrc: "img/productos/producto5.jpg" },
        { id: 6, name: "Producto 6", description: "Descripción completa del producto 6.", price: 60.00, color: "Amarillo", stock: "Disponible", imgSrc: "img/productos/producto6.jpg" },
        { id: 7, name: "Producto 7", description: "Descripción completa del producto 7.", price: 70.00, color: "Naranja", stock: "Disponible", imgSrc: "img/productos/producto7.jpg" },
        { id: 8, name: "Producto 8", description: "Descripción completa del producto 8.", price: 80.00, color: "Morado", stock: "Disponible", imgSrc: "img/productos/producto8.jpg" },
        { id: 9, name: "Producto 9", description: "Descripción completa del producto 9.", price: 90.00, color: "Rosa", stock: "Disponible", imgSrc: "img/productos/producto9.jpg" },
        { id: 10, name: "Producto 10", description: "Descripción completa del producto 10.", price: 100.00, color: "Gris", stock: "Disponible", imgSrc: "img/productos/producto10.jpg" },
        { id: 11, name: "Producto 11", description: "Descripción completa del producto 11.", price: 110.00, color: "Marrón", stock: "Disponible", imgSrc: "img/productos/producto11.jpg" },
        { id: 12, name: "Producto 12", description: "Descripción completa del producto 12.", price: 120.00, color: "Turquesa", stock: "Disponible", imgSrc: "img/productos/producto12.jpg" },
        { id: 13, name: "Producto 13", description: "Descripción completa del producto 13.", price: 130.00, color: "Plateado", stock: "Disponible", imgSrc: "img/productos/producto13.jpg" },
        { id: 14, name: "Producto 14", description: "Descripción completa del producto 14.", price: 140.00, color: "Dorado", stock: "Disponible", imgSrc: "img/productos/producto14.jpg" },
        { id: 15, name: "Producto 15", description: "Descripción completa del producto 15.", price: 150.00, color: "Negro", stock: "Disponible", imgSrc: "img/productos/producto15.jpg" },
    ];

    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');
    const product = productos.find(p => p.id == productId);

    if (producto) {
        document.getElementById('product-name').textContent = producto.name;
        document.getElementById('product-price').textContent = `U$S ${producto.price}`;
        document.getElementById('product-description').textContent = productoct.description;
        document.getElementById('product-color').textContent = productoct.color;
        document.getElementById('product-stock').textContent = productoct.stock;
        document.getElementById('main-img').src = producto.imgSrc;
    } else {
        document.querySelector('.product-page').innerHTML = "<p>Producto no encontrado.</p>";
    }
});
