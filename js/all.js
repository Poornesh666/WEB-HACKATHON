document.addEventListener('DOMContentLoaded', function () {
    console.log('Website loaded successfully');

    // Basic navigation toggle for small screens
    // const navToggle = document.querySelector('.navbar-toggler');
    // const navCollapse = document.querySelector('.navbar-collapse');

    // if (navToggle && navCollapse) {
    //     navToggle.addEventListener('click', function () {
    //         navCollapse.classList.toggle('show');
    //     });
    // }

    // Simple form validation feedback
    const forms = document.querySelectorAll('form');
    forms.forEach((form) => {
        form.addEventListener('submit', function (event) {
            const inputs = form.querySelectorAll('input, textarea');
            let isValid = true;

            inputs.forEach((input) => {
                if (!input.value.trim()) {
                    isValid = false;
                    alert(`Please fill out the ${input.name} field.`);
                }
            });

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
});