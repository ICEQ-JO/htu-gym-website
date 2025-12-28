```javascript

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

    const choosePlanButtons = document.querySelectorAll('.choose-plan');
    choosePlanButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const planId = this.getAttribute('data-plan-id');
            const userId = 1;
            window.location.href = '../php-pages/dashboard.php?action=add&plan_id=' + planId + '&user_id=' + userId;
        });
    });
});
```
