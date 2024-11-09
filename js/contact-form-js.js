document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function (event) {
        const name = document.querySelector('#contact-name').value.trim();
        const email = document.querySelector('#contact-email').value.trim();
        const phone = document.querySelector('#contact-phone').value.trim();
        const subject = document.querySelector('#contact-subject').value;
        const message = document.querySelector('#contact-message').value.trim();

        // Basic validation
        if (!name || !phone || !email || !subject || !message) {
            alert('Please fill out all fields.');
            event.preventDefault();
            return;
        }

        // Name validation (minimum 2 characters)
        if (name.length < 2) {
            alert('Please enter a valid name (minimum 2 characters).');
            event.preventDefault();
            return;
        }

        // Email validation
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Please enter a valid email address.');
            event.preventDefault();
            return;
        }

        // Phone validation (10 digits)
        if (!/^\d{10}$/.test(phone)) {
            alert('Please enter a valid 10-digit phone number.');
            event.preventDefault();
            return;
        }

        // Message length validation
        if (message.length < 20) {
            alert('Please provide a more detailed message (minimum 20 characters).');
            event.preventDefault();
            return;
        }
    });
});
