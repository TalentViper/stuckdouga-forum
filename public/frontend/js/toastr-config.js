// resources/js/toastr-config.js
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-full-width", // Custom class for full width
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

// Custom CSS for full width and colors
document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.innerHTML = `
        .toast-top-full-width {
            top: 0;
            right: 0;
            left: 0;
            width: 100%;
            margin: 0;
        }
        #toast-container > .toast-success {
            background-color: green;
        }
        #toast-container > .toast-error {
            background-color: red;
        }
        #toast-container > .toast-info {
            background-color: soft grey;
        }
        #toast-container > .toast-warning {
            background-color: red;
        }
    `;
    document.head.appendChild(style);
});
