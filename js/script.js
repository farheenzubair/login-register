function validateForm() {
    const username = document.getElementsByName('username')[0].value;
    const email = document.getElementsByName('email')[0].value;
    const password = document.getElementById('password').value;
    const confirm_password = document.getElementById('confirm_password').value;

    if (password.length < 8) {
        alert('Password must be at least 8 characters long.');
        return false;
    }

    if (!/[A-Z]/.test(password) || !/[\W]/.test(password)) {
        alert('Password must contain at least one uppercase letter and one special character.');
        return false;
    }

    if (password !== confirm_password) {
        alert('Passwords do not match.');
        return false;
    }

    // AJAX call to check for duplicate username or email
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'register.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.username_exists) {
                alert('Username already exists!');
                return false;
            }
            if (response.email_exists) {
                alert('Email already exists!');
                return false;
            }

            // If no duplicates, submit the form
            document.forms[0].submit();
        }
    };

    const params = 'username=' + encodeURIComponent(username) + '&email=' + encodeURIComponent(email) + '&check_duplicate=true';
    xhr.send(params);

    // Prevent form from submitting until AJAX call completes
    return false;
}
