$(document).ready(function() {
    $('.bamboo-btn').on('click', function(e) {
        e.preventDefault();
        var $link = $(e.currentTarget);
        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data) {
            $('.bamboo-nb').html(data.bamboo);

            if ($(".bamboo-nb").val() > 0) {
                $('.bamboo-nb').addClass('test');
            }

        })
    });
});