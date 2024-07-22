function validateForm() 
{
    const password = document.getElementById('password').value;
    const confirm_password = document.getElementById('confirm_password').value;

    if (password.length < 8) 
        {
        alert('Password must be at least 8 characters long.');
        return false;
        }

    if (!/[A-Z]/.test(password) || !/[\W]/.test(password)) 
        {
        alert('Password must contain at least one uppercase letter and one special character.');
        return false;
        }

    if (password !== confirm_password) 
        {
        alert('Passwords do not match.');
        return false;
        }

    return true;
}

function validateLoginForm() 
{
    return true;
}

function validateRegistrationForm() 
{
    return validateForm();
}
