$(function () {
    $('#link-form').on('beforeSubmit', function () {
        $('.button-submit').prop("disabled", true);
        $(this).find('.button-submit__preloader').show();
        var data = $(this).serialize(),
            url = $(this).attr('action');
        $.post(url, data, function (response) {
            try {
                if (response.status === 'succ') {
                    $('.short_links__long-url').text(response.longUrl);
                    $('.short_links__short-url').text(response.shortUrl);
                    $('.short_links__result').show();
                } else {
                    alert('error');
                }

                $('.button-submit__preloader').hide();
                $('.button-submit').prop("disabled", false);
            } catch (e) {
                $('.button-submit__preloader').hide();
                $('.button-submit').prop("disabled", false);
                console.log('Error: ' + e.message);
            }
        });

        return false;
    });

    $('#short_links-copy').click(function () {
        var shortUrl = $('.short_links__short-url').text(),
            $txt = $('<textarea />');
        $txt.val(shortUrl).css({width: "1px", height: "1px"}).appendTo('body');
        $txt.select();
        if (document.execCommand('copy')) {
            $txt.remove();
        }
        $(this).text('Скопирован');
    });
});