document.addEventListener("DOMContentLoaded", function() {
    $("#btn-notify").on("click", function() {
        new Toastify({ node: $("#test-notify").clone().removeClass("hidden")[0], duration: -1, newWindow: true, close: true, gravity: "top", position: "right", stopOnFocus: true, }).showToast();
    });


    $(".validate-form-2").each(function() {
        var pristine = new Pristine(this, {
            classTo: "input-form",
            errorClass: "has-error",
            errorTextParent: "input-form",
            errorTextClass: "text-danger mt-2"
        });
        pristine.addValidator($(this).find('input[type="url"]')[0], function(value) {
            var expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
            var regex = new RegExp(expression);
            if (!value.length || value.length && value.match(regex)) {
                return true;
            }
            return false;
        }, "This field is URL format only", 2, false);
        $(this).on("submit", function(e) {
            e.preventDefault();
            var valid = pristine.validate();
            if (valid) {


                new Toastify({
                    node: $("#success-notification-content").clone().removeClass("hidden")[0],
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true
                }).showToast();
            } else {
                new Toastify({
                    node: $("#failed-notification-content").clone().removeClass("hidden")[0],
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true
                }).showToast();
            }

        });
    });
})