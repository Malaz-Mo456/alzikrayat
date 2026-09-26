// Show or hide the password.
function togglePassword() {
    const input = document.getElementById('password');

    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}


// Check the login form.
const loginForm = document.getElementById('loginForm');

if (loginForm) {
    loginForm.addEventListener('submit', function(event) {

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const clientError = document.getElementById('clientError');

        clientError.style.display = 'none';
        clientError.textContent = '';

        if (email === '') {
            event.preventDefault();
            clientError.textContent = 'Email is required.';
            clientError.style.display = 'block';
            return;
        }

        if (!email.includes('@')) {
            event.preventDefault();
            clientError.textContent = 'Please enter a valid email address.';
            clientError.style.display = 'block';
            return;
        }

        if (password === '') {
            event.preventDefault();
            clientError.textContent = 'Password is required.';
            clientError.style.display = 'block';
        }
    });
}


// Check the registration form.
const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener('submit', function(event) {

        const firstName = document.getElementById('first_name').value.trim();
        const lastName = document.getElementById('last_name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        const clientError =
            document.getElementById('clientRegisterError');

        clientError.style.display = 'none';
        clientError.textContent = '';

        if (firstName === '') {
            event.preventDefault();
            clientError.textContent = 'First name is required.';
            clientError.style.display = 'block';
            return;
        }

        if (firstName.length > 50) {
            event.preventDefault();
            clientError.textContent = 'First name is too long.';
            clientError.style.display = 'block';
            return;
        }

        if (!/^[\p{L}]+$/u.test(firstName)) {
            event.preventDefault();
            clientError.textContent =
                'First name must contain letters only.';
            clientError.style.display = 'block';
            return;
        }

        if (lastName === '') {
            event.preventDefault();
            clientError.textContent = 'Last name is required.';
            clientError.style.display = 'block';
            return;
        }

        if (lastName.length > 50) {
            event.preventDefault();
            clientError.textContent = 'Last name is too long.';
            clientError.style.display = 'block';
            return;
        }

        if (!/^[\p{L}]+$/u.test(lastName)) {
            event.preventDefault();
            clientError.textContent =
                'Last name must contain letters only.';
            clientError.style.display = 'block';
            return;
        }

        if (email === '') {
            event.preventDefault();
            clientError.textContent = 'Email is required.';
            clientError.style.display = 'block';
            return;
        }

        if (!email.includes('@')) {
            event.preventDefault();
            clientError.textContent =
                'Please enter a valid email address.';
            clientError.style.display = 'block';
            return;
        }

        if (password.length < 8) {
            event.preventDefault();
            clientError.textContent =
                'Password must be at least 8 characters.';
            clientError.style.display = 'block';
            return;
        }
    });
}