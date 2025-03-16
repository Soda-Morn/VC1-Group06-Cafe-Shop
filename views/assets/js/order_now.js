
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
