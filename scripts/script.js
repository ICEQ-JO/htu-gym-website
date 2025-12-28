

document.addEventListener('DOMContentLoaded', function () {

    const forms = document.querySelectorAll('form');

    forms.forEach(function (form) {
        form.addEventListener('submit', function (e) {

            const fields = form.querySelectorAll('input, textarea');
            let hasEmptyField = false;


            fields.forEach(function (field) {
                if (field.value.trim() === '') {
                    hasEmptyField = true;
                }
            });


            if (hasEmptyField) {
                e.preventDefault();
                alert('Please Enter The Required feilds');
            }
        });
    });
});
