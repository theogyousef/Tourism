function validateLoginForm() {
    var email = document.getElementById('emailInput').value;
    var password = document.getElementById('passwordInput').value;
    var emailError = document.getElementById('emailError');
    var passwordError = document.getElementById('passwordError');
    var valid = true;

    emailError.textContent = ''; 
    passwordError.textContent = ''; 

    if (!email) {
        emailError.textContent = 'Email is required';
        valid = false;
    } else if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        emailError.textContent = 'Invalid email format';
        valid = false;
    }

    if (!password) {
        passwordError.textContent = 'Password is required';
        valid = false;
    } else if (password.length < 8) {
        passwordError.textContent = 'Password must be at least 8 characters long';
        valid = false;
    }

    return valid; 
}