function agregarProducto(id, token){
    let url = 'clases/carrito.php';
    let formData = new FormData();
    formData.append('id', id);
    formData.append('token', token);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    })
    .then(response => response.json())
    .then(data => {
        if(data.ok){
            let elemento = document.getElementById('num_cart'); 
            elemento.innerHTML = data.numero; 
        }
    })
    .catch(error => console.error('Error:', error));
}
