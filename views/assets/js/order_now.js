
let quantities = [12, 12];
let pricePerItem = 12;

function updateTotalPrice() {
    let grandTotal = 0;
    for (let i = 0; i < quantities.length; i++) {
        grandTotal += quantities[i] * pricePerItem;
    }
    document.getElementById("grand-total").textContent = `$${grandTotal}`;
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

updateTotalPrice(); // Initialize total prices on load