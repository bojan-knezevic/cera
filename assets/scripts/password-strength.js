function updatePasswordInputColor(isStrong, passwordInput) {
    if (isStrong) {
        passwordInput.removeClass("password-weak");
        passwordInput.addClass("password-strong");
    } else {
        passwordInput.removeClass("password-strong");
        passwordInput.addClass("password-weak");
    }
}

/* Password Strength */
function checkPasswordStrength(passwordInput, pathAdjustment = '') {
    let password = passwordInput.val();
    if (password) {
        $.ajax({
            url: pathAdjustment+"auth/password-strength-check.php",
            method: "POST",
            dataType: "json",
            data: { password: password },
            success: function(data) {
                updatePasswordInputColor(data.complexity === "Strong", passwordInput);
            }
        });
    } else {
        updatePasswordInputColor(false, passwordInput);
    }
}