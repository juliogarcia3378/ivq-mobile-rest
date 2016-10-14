jQuery.extend(jQuery.validator.messages, {
    required: "Mandatory field.",
    remote: "Error.",
    email: "Insert a valid email.",
    url: "Insert a valid URL.",
    date: "Insert a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Insert a valid number.",
    digits: "Just digits",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "The values provide not match.",
    accept: "Invalid Extension.",
    maxlength: jQuery.validator.format("Enter less than {0} characters."),
    minlength: jQuery.validator.format("Enter at least {0} characters."),
    rangelength: jQuery.validator.format("Enter a valid value between {0} y {1} caracteres."),
    range: jQuery.validator.format("Enter a valid value between {0} y {1}."),
    max: jQuery.validator.format("Enter a valid value between {0}."),
    min: jQuery.validator.format("Enter a valid value between {0}.")
});