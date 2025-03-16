
<div class="bg-light d-flex justify-content-center align-items-center vh-100">
        <div class="bg-white p-4 rounded shadow-lg w-100" style="max-width: 900px;">
            <h1 class="text-warning fw-bold">Preview order</h1>
            <p class="fw-semibold mt-2">Your selection:</p>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="border-bottom">
                        <tr>
                            <th class="text-start p-3">Image</th>
                            <th class="text-start p-3">Name</th>
                            <th class="text-start p-3">Price</th>
                            <th class="text-end p-3">Quantity</th> <!-- Aligned to the right -->
                        </tr>
                    </thead>
                    <tbody id="order-list">
                        <tr class="border-bottom">
                            <td class="p-2"><img src="https://via.placeholder.com/50" alt="Product" class="img-fluid"></td>
                            <td class="p-2">Green Tea Packing</td>
                            <td class="p-2">$12</td>
                            <td class="p-2 text-end">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity(0)">&minus;</button>
                                    <span class="px-3" id="qty-0">12</span>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity(0)">&plus;</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="p-2"><img src="https://via.placeholder.com/50" alt="Product" class="img-fluid"></td>
                            <td class="p-2">Green Tea Packing</td>
                            <td class="p-2">$12</td>
                            <td class="p-2 text-end">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity(1)">&minus;</button>
                                    <span class="px-3" id="qty-1">12</span>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity(1)">&plus;</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-end">
                <p class="fs-4 fw-bold">Total Price: <span id="grand-total">$288</span></p>
                <div class="mt-3 d-flex flex-column flex-sm-row justify-content-end gap-3">
                    <a href=" " class="btn btn-warning text-white  w-sm-auto" >Add More</a>
                    <a href="/purchase_item_add" class="btn btn-success text-white  w-sm-auto" >Checkout</a>
                </div>
            </div>
        </div>
</div>