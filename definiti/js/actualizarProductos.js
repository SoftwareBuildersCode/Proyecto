function eliminar() {
    let botonElimina = document.getElementById('btn-elimina');
    let id = botonElimina.value;
    let url = 'clases/actualizar_carrito.php';
    let formData = new FormData();
    formData.append('action', 'eliminar');
    formData.append('id', id);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.ok) {
            location.reload();
        } else {
            console.error('Error en la respuesta:', data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
