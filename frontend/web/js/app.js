$(document).ready(function () {
    $('#search-bar button').click(function (e) { 
        e.preventDefault();
        if($('#search-bar input').val() != ''){
            $('#search-bar').submit();
        }
    });
});