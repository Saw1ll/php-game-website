document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('.password-toggle-btn');
            togglePassword.addEventListener('click', function () {
                const passwordFields = document.querySelectorAll(this.getAttribute('toggle'));
                passwordFields.forEach(function (field) {
                    field.type = field.type === 'password' ? 'text' : 'password';
                })
                this.textContent = passwordFields[0].type === 'password' ? "Show password input" : "Hide password input";
            })
        })