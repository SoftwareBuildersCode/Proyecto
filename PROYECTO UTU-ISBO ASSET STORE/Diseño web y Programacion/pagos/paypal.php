<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AZ2uzvkQjGYxPdZZIJM13dOkd4mjYeO3ipG7CFIWnd-34fWdVj_OtnOQCoreweD0ihl6oxPKTPuoft2Q&currency=USD"></script>
</head>
<body>
    <div id="paypal-button-container"></div>

    <script>
    paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: <?php echo $total; ?>
                }
            }]
        });
    },
    onApprove: function(data, actions){
        actions.order.capture().then(function(detalles){
            console.log(detalles)
        });
    },

    onCancel: function(data){
        alert("Pago cancelado");
        console.log(data)
    }
}).render('#paypal-button-container');

</script>
</body>
</html>
