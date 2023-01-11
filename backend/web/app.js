$(document).ready(function () {
    $('#video-input').change(function (e) { 
        $(e.target).closest('form').trigger('submit');
    });
});