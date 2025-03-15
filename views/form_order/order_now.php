<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white p-4 rounded shadow-lg w-75">
        <h1 class="text-warning fw-bold">Order Now</h1>
        <p class="fw-semibold mt-2">Your select :</p>
        
        <div class="mt-4">
            <table class="table">
                <thead class="border-bottom">
                    <tr>
                        <th class="text-start p-3">Image</th>
                        <th class="text-start p-3">Name</th>
                        <th class="text-start p-3">Price</th>
                        <th class="text-start p-3">Quantity</th>
                    </tr>
                </thead>
                <tbody id="order-list">
                    <tr class="border-bottom">
                        <td class="p-2"><img src="https://via.placeholder.com/50" alt="Product" class="w-25"></td>
                        <td class="p-2">Green Tea Packing</td>
                        <td class="p-2">$12</td>
                        <td class="p-2 d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity(0)">&lt;</button>
                            <span class="px-3" id="qty-0">12</span>
                            <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity(0)">&gt;</button>
                        </td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="p-2"><img src="https://via.placeholder.com/50" alt="Product" class="w-25"></td>
                        <td class="p-2">Green Tea Packing</td>
                        <td class="p-2">$12</td>
                        <td class="p-2 d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity(1)">&lt;</button>
                            <span class="px-3" id="qty-1">12</span>
                            <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity(1)">&gt;</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-end">
            <p class="fs-4 fw-bold">Total Price: <span id="total-price">$24</span></p>
            <div class="mt-3 d-flex justify-content-end gap-3">
                <button class="btn btn-warning text-white" onclick="showPopup('Add more items?')">Add More</button>
                <button class="btn btn-success text-white" onclick="showPopup('Proceed to checkout?')">Checkout</button>
            </div>
        </div>
    </div>

    <div id="popup" class="position-fixed top-0 start-0 w-100 h-100 d-none bg-dark bg-opacity-50 d-flex justify-content-center align-items-center">
        <div class="bg-white p-4 rounded shadow-lg w-25">
            <p id="popup-message" class="fs-5 fw-semibold"></p>
            <div class="mt-3 d-flex justify-content-end gap-3">
                <button class="btn btn-danger" onclick="closePopup()">Cancel</button>
                <button class="btn btn-primary" onclick="closePopup()">OK</button>
            </div>
        </div>
    </div>
    
    <script>
        let quantities = [12, 12];
        let pricePerItem = 12;

        function updateTotalPrice() {
            let totalPrice = quantities.reduce((sum, qty) => sum + qty * pricePerItem, 0);
            document.getElementById("total-price").textContent = `$${totalPrice}`;
        }

        function increaseQuantity(index) {
            quantities[index]++;
            document.getElementById(`qty-${index}`).textContent = quantities[index];
            updateTotalPrice();
        }

        function decreaseQuantity(index) {
            if (quantities[index] > 1) {
                quantities[index]--;
                document.getElementById(`qty-${index}`).textContent = quantities[index];
                updateTotalPrice();
            }
        }

        function showPopup(message) {
            document.getElementById("popup-message").textContent = message;
            document.getElementById("popup").classList.remove("d-none");
        }

        function closePopup() {
            document.getElementById("popup").classList.add("d-none");
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
