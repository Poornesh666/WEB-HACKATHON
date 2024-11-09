document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const email = document.querySelector('#login-email').value.trim();
        const password = document.querySelector('#login-password').value.trim();
        if (!email || !password) {
            alert('Please fill out all fields.');
            event.preventDefault(); // Prevent submission if fields are empty
        }
    });
});
