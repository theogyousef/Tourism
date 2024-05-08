function validateSignupForm() {
    var email = document.getElementById('emailInput').value;
    var firstName = document.getElementById('firstNameInput').value;
    var lastName = document.getElementById('lastNameInput').value;
    var password = document.getElementById('passwordInput').value;
    var confirmPassword = document.getElementById('confirmpasswordInput').value;
    var valid = true;

    // Reset error messages
    document.getElementById('emailError').textContent = '';
    document.getElementById('firstNameError').textContent = '';
    document.getElementById('lastNameError').textContent = '';
    document.getElementById('passwordError').textContent = '';
    document.getElementById('confirmPasswordError').textContent = '';

    // Email validation
    if (!email) {
        document.getElementById('emailError').textContent = 'Email is required';
        valid = false;
    } else if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        document.getElementById('emailError').textContent = 'Invalid email format';
        valid = false;
    }

    // Name validations
    if (!firstName) {
        document.getElementById('firstNameError').textContent = 'First name is required';
        valid = false;
    }
    if (!lastName) {
        document.getElementById('lastNameError').textContent = 'Last name is required';
        valid = false;
    }

    // Password validations
    if (!password) {
        document.getElementById('passwordError').textContent = 'Password is required';
        valid = false;
    }
    else if (!confirmPassword) {
        document.getElementById('confirmPasswordError').textContent = 'confirmPassword is required';
        valid = false;
    } else if (password.length < 8) {
        document.getElementById('passwordError').textContent = 'Password must be at least 8 characters long';
        valid = false;
    }

    if (password !== confirmPassword) {
        document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
        valid = false;
    }

    return valid;
}