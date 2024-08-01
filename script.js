document.getElementById("paymentForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const cardNumber = document.getElementById("cardNumber").value;
    const expiry = document.getElementById("expiry").value;
    const cvv = document.getElementById("cvv").value;

    // You would typically perform additional validation here before sending data to the server

    const formData = new FormData();
    formData.append("cardNumber", cardNumber);
    formData.append("expiry", expiry);
    formData.append("cvv", cvv);

    fetch("process_payment.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("status").textContent = data.message;
    })
    .catch(error => {
        console.error("Error:", error);
    });
});