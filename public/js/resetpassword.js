function validatePasswordResetForm() {
    var password = document.getElementById('passwordInput').value;
    var confirmPassword = document.getElementById('confirmpasswordInput').value;
    var passwordError = document.getElementById('passwordError');
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    var valid = true;

    passwordError.textContent = ''; 
    confirmPasswordError.textContent = ''; 

    if (!password) {
        passwordError.textContent = 'Password is required';
        valid = false;
    } else if (password.length < 8) {
        passwordError.textContent = 'Password must be at least 8 characters long';
        valid = false;
    }

    if (!confirmPassword) {
        confirmPasswordError.textContent = 'Confirm password is required';
        valid = false;
    } else if (password !== confirmPassword) {
        confirmPasswordError.textContent = 'Passwords do not match';
        valid = false;
    }

    return valid; 
}