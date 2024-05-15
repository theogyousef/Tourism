function validateEmailForm() {
    var email = document.getElementById('emailInput').value;
    var emailError = document.getElementById('emailError');
    var valid = true;

    emailError.textContent = '';

    if (!email) {
        emailError.textContent = 'Email is required';
        valid = false;
    } else if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        emailError.textContent = 'Invalid email format';
        valid = false;
    }

    return valid;
}