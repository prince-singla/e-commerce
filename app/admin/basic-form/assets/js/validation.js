$(document).ready(function () {

    $("#userForm").validate({

        // ✅ Live validation triggers
        onkeyup: function (element) {
            $(element).valid();
        },
        onchange: function (element) {
            $(element).valid();
        },
        onfocusout: function (element) {
            $(element).valid();
        },

        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            gender: {
                required: true
            },
            "hobbies[]": {
                required: true
            }
        },

        messages: {
            name: {
                required: "Name is required",
                minlength: "Name must be at least 2 characters"
            },
            email: {
                required: "Email is required",
                email: "Enter a valid email"
            },
            phone: {
                required: "Phone is required",
                digits: "Phone must contain only digits",
                minlength: "Phone must be 10 digits",
                maxlength: "Phone must be 10 digits"
            },
            gender: {
                required: "Please select gender"
            },
            "hobbies[]": {
                required: "Please select at least one hobby"
            }
        },

        errorPlacement: function (error, element) {
            if (element.attr("name") === "hobbies[]") {
                error.insertAfter("#hobbyError");
            }
            else if (element.attr("name") === "gender") {
                error.insertAfter("#genderError");
            }
            else {
                error.insertAfter(element);
            }
        }
    });

});
