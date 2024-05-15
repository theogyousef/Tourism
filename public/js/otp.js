function validateOTPForm() {
    var otpInput = document.getElementById('otpInput').value;
    var otpError = document.getElementById('otpError');
    var valid = true;

    otpError.textContent = ''; 

    if (!otpInput) {
        otpError.textContent = 'OTP is required';
        valid = false;
    } else if (!otpInput.match(/^[0-9]{4,6}$/)) {
        otpError.textContent = 'OTP must be 4 to 6 digits long and numeric';
        valid = false;
    }

    return valid;
}
