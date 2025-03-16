<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .total-price {
            font-size: 1.5em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Order Now</h1>
        <p class="text-center"><strong>Your select:</strong></p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="path_to_image1.jpg" alt="Green Tea Packing" class="img-fluid" style="width: 50px;"></td>
                    <td>Green Tea Packing</td>
                    <td>12$</td>
                    <td>
                        <input type="number" class="form-control quantity-input" value="12">
                    </td>
                </tr>
                <tr>
                    <td><img src="path_to_image2.jpg" alt="Green Tea Packing" class="img-fluid" style="width: 50px;"></td>
                    <td>Green Tea Packing</td>
                    <td>12$</td>
                    <td>
                        <input type="number" class="form-control quantity-input" value="12">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-right total-price">
            Total Price: 24$
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-primary">Add More</button>
            <button class="btn btn-success">Checkout</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>