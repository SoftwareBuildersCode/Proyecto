// Variables para almacenar los productos
let productos = [];
let descripciones = [];
let precios = [];
let imagenes = [];

// Función para agregar un producto
function agregarProducto(nombre, descripcion, precio, imagen) {
    productos.push(nombre);
    descripciones.push(descripcion);
    precios.push(precio);
    imagenes.push(imagen);
    mostrarProductos();
    mostrarPanelControl();
}

// Función para mostrar los productos en la lista
function mostrarProductos() {
    const listaProductos = document.getElementById('listaProductos');
    listaProductos.innerHTML = '';
    
    for (let i = 0; i < productos.length; i++) {
        const itemLista = document.createElement('li');
        itemLista.innerHTML = `
            <img src="${imagenes[i]}" alt="${productos[i]}" class="imagen-producto">
            <span>Nombre: ${productos[i]}, Descripción: ${descripciones[i]}, Precio: $${precios[i]}</span>
        `;
        listaProductos.appendChild(itemLista);
    }
}

// Función para mostrar los productos en el panel de control
function mostrarPanelControl() {
    const panelControl = document.getElementById('panelControlProductos');
    panelControl.innerHTML = '';
    
    for (let i = 0; i < productos.length; i++) {
        const itemProducto = document.createElement('div');
        itemProducto.classList.add('item-producto');
        itemProducto.innerHTML = `
            <img src="${imagenes[i]}" alt="${productos[i]}" class="imagen-producto">
            <strong>Nombre:</strong> <input type="text" value="${productos[i]}" data-index="${i}" class="editar-nombre"><br>
            <strong>Descripción:</strong> <input type="text" value="${descripciones[i]}" data-index="${i}" class="editar-descripcion"><br>
            <strong>Precio:</strong> <input type="number" value="${precios[i]}" data-index="${i}" class="editar-precio"><br>
            <button onclick="actualizarProducto(${i})">Actualizar</button>
        `;
        panelControl.appendChild(itemProducto);
    }
}

// Función para actualizar un producto
function actualizarProducto(index) {
    const nombreInput = document.querySelector(`.editar-nombre[data-index='${index}']`);
    const descripcionInput = document.querySelector(`.editar-descripcion[data-index='${index}']`);
    const precioInput = document.querySelector(`.editar-precio[data-index='${index}']`);

    productos[index] = nombreInput.value;
    descripciones[index] = descripcionInput.value;
    precios[index] = precioInput.value;

    mostrarProductos();
    mostrarPanelControl();
}

// Función para manejar la carga de imagen y convertirla a base64
function manejarCargaImagen(file, callback) {
    const reader = new FileReader();
    reader.onload = function(event) {
        callback(event.target.result);
    };
    reader.readAsDataURL(file);
}

// Manejo del evento submit del formulario
document.getElementById('formularioProducto').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const nombre = document.getElementById('nombreProducto').value;
    const descripcion = document.getElementById('descripcionProducto').value;
    const precio = document.getElementById('precioProducto').value;
    const archivoImagen = document.getElementById('imagenProducto').files[0];
    
    if (archivoImagen) {
        manejarCargaImagen(archivoImagen, function(datosImagen) {
            agregarProducto(nombre, descripcion, precio, datosImagen);
            document.getElementById('formularioProducto').reset();
        });
    }
});
