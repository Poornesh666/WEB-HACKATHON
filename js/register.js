document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        const name = document.querySelector('#reg-name').value.trim();
        const email = document.querySelector('#reg-email').value.trim();
        const password = document.querySelector('#reg-password').value.trim();
        const phone = document.querySelector('#reg-phone').value.trim();
        const confirmPassword = document.querySelector('#confirm-password').value.trim();
        if (!name || !phone || !email || !password) {
            alert('Please fill out all fields.');
            event.preventDefault();
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Please enter a valid email address.');
            event.preventDefault();
            return;
        }
        if (!/^\d{10}$/.test(phone)) {
            alert('Please enter a valid 10-digit phone number.');
            event.preventDefault();
            return;
        }
        if (password !== confirmPassword) {
            alert('Passwords do not match. Please check and try again.');
            event.preventDefault();
            return;
        }
    });
});
