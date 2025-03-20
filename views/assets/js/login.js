document.getElementById("togglePassword").addEventListener("click", function() {
    const passwordInput = document.getElementById("password");
    const toggleBtn = document.getElementById("togglePassword");
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleBtn.textContent = "🔒"; // Change to lock icon when password is visible
    } else {
        passwordInput.type = "password";
        toggleBtn.textContent = "👁️"; // Change back to eye icon when password is hidden
    }
});

document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch("/users/authenticate", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            let messageDiv = document.getElementById("message");
            if (data.status === "success") {
                messageDiv.innerHTML = "<div class='alert alert-success'>" + data.message + "</div>";
                setTimeout(() => {
                    window.location.href = "/dashboard";
                }, 2000);
            } else {
                messageDiv.innerHTML = "<div class='alert alert-danger'>" + data.message + "</div>";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            document.getElementById("message").innerHTML = "<div class='alert alert-danger'>An error occurred. Please try again.</div>";
        });
});

// Add subtle background zoom effect
window.addEventListener('scroll', function() {
    const bg = document.body;
    const scrollPosition = window.scrollY;
    bg.style.backgroundSize = `${100 + scrollPosition / 40}%`; /* Subtle zoom effect */
});