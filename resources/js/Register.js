function validateForm() {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    var usernameError = document.getElementById('username-error');
    var emailError = document.getElementById('email-error');
    var passwordError = document.getElementById('password-error');
    var confirmPasswordError = document.getElementById('confirm-password-error');

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    var isValid = true;

    if (username === "" || email === "" || password === "" || confirmPassword === "") {  
        document.getElementById("username-error").textContent = username === "" ? "Username không được để trống" : "";
        document.getElementById("email-error").textContent = email === "" ? "Email không được để trống" : "";
        document.getElementById("password-error").textContent = password === "" ? "Password không được để trống" : "";
        document.getElementById("confirm-password-error").textContent = confirmPassword === "" ? "Confirm Password không được để trống" : "";
        isValid = false;
    } else {
        if (!usernameRegex.test(username)) {
            usernameError.textContent = 'Username phải có ít nhất 5 ký tự và chỉ chứa chữ cái, số và dấu gạch dưới.';
            isValid = false; 
        } else {
            usernameError.textContent = ''; 
        }

        // Validate email   
        if (!emailRegex.test(email)) {
            emailError.textContent = 'Email không hợp lệ.';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        // Validate password
        if (!passwordRegex.test(password)) {
            passwordError.textContent = 'Password phải có ít nhất 8 ký tự, bao gồm ít nhất một chữ cái và một số.';
            isValid = false;
        } else {
            passwordError.textContent = '';
        }

        // Validate confirm password
        if (password !== confirmPassword) {
            confirmPasswordError.textContent = 'Password không khớp.';
            isValid = false;
        } else {
            confirmPasswordError.textContent = '';
        }
    }
    
   
    if (isValid) {
        window.location.href = "index.html";
    }
  
    return isValid;
}


