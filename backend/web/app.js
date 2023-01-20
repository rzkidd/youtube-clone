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

    $(function() {
        // images preview with JavaScript
        var reader = new FileReader();
        var thumbnailPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                reader.onload = function(event) {
                    let thumbnail = new Image();
                    thumbnail.src = event.target.result;
                    thumbnail.width = 100;
                    // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    $(thumbnail).attr('class', 'me-3 position-absolute top-0 start-0 w-100 rounded').appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[0]);
            }

            $('.thumbnail-delete').on('click', function () {
                removeFile(input, 0);
                $('.thumbnail-input img').remove();
                $('.thumbnail-upload').css('transform', 'scale(1)');
                $('.thumbnail-options').css('transform', 'scale(0)');
                $('.thumbnail-input img').css('opacity', 1);
            });
        };

        const removeFile = (input, index) => {
            let dt = new DataTransfer();
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i]
                if (index !== i)
                    dt.items.add(file) // here you exclude the file. thus removing it.
            }
                
            input.files = dt.files // Assign the updates list
        }
        
        $('.thumbnail-input').hover(function () {
                // over
                if ($('.thumbnail-input img').length){
                    $('.thumbnail-upload').css('transform', 'scale(0)');
                    $('.thumbnail-options').css('transform', 'scale(1)');
                    $('.thumbnail-input img').css('opacity', 0.7);
                } else {
                    $('.thumbnail-input').css('background-color', 'var(--hover-bg-color)');
                    $('.thumbnail-input').css('color', '#fff !important');
                }
            }, function () {
                // out
                if ($('.thumbnail-input img').length){
                    $('.thumbnail-upload').css('transform', 'scale(1)');
                    $('.thumbnail-options').css('transform', 'scale(0)');
                    $('.thumbnail-input img').css('opacity', 1);
                } else {
                    $('.thumbnail-input').css('background-color', 'var(--bg-color)');
                    $('.thumbnail-input').css('color', 'unset');
                }
            }
        );

        $('#thumbnail-input').on('change', function() {
            $('.thumbnail-upload').css('display', 'none');
            thumbnailPreview(this, 'button#thumbnail-preview');
        });

        

    });

    $(function(){
        $('#update-video-form').find(':input').each(function(i, elem) {
            $(this).data("previous-value", $(this).val());
        });
    
        function restore() {
    
            $('#update-video-form').find(':input').each(function(i, elem) {
                $(this).val($(this).data("previous-value"));
            });
            $('span.tag').remove();
        }
    
        $('a[data-bs-toggle="undo-changes"]').click(function() {
    
            restore();
        });
    });

});