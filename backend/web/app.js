$(document).ready(function () {
    $('#video-input').change(function (e) { 
        $(e.target).closest('form').trigger('submit');
    });
    
    $('#update-video-submit').on('click', function (e) {
        $(e.target).closest('form').trigger('submit');
    });

    $('#table_video tbody tr').hover(function () {
            $('.video-description', this).css('transform', 'scale(0)');      
            $('.video-options', this).css('transform', 'scale(1)');      
        }, function () {
            $('.video-description', this).css('transform', 'scale(1)');      
            $('.video-options', this).css('transform', 'scale(0)');      
        }
    );

    $('#copy-icon').on('click', function () {
        let link = $(this).attr('data-link');
        navigator.clipboard.writeText(link);
    });
});