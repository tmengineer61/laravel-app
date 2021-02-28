$(function() {
    $('#search').on('click', function() {
        // GeoLocation
        navigator.geolocation.getCurrentPosition(searchShop,failGetGeolocation);
    })

    function searchShop(pos) {

        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;

        var genre = $('.cond-content.is-select').find('[name="genre_code"]').val();
        $.ajax({
            type: 'POST',
            url: '/api/ajax/search/shop',
            data:{lat:lat, lng:lng, genre:genre},
            dataType: 'json',
            timeout: 5000,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#shop').html('<img src="/images/ajax-loading.gif" class="d-block mx-auto" />');
            }
        })
        .done(function(data) {
            if (data.status) {
                showShop(data);
            } else {
                alert('店舗を検索できませんでした。');
            }
        })
        .fail(function() {
            alert('店舗を検索できませんでした。');
        });

    }
    function failGetGeolocation() {
        alert('位置情報を取得できませんでした。位置情報の取得を許可して再度お試しください。');
    }

    function showShop(data) {
        $('#shop').html(data.views);
    }

    $('.cond-content').on('click', function() {
        // 自身のクラス付け替え
        if ($(this).hasClass('is-select')) {
            $(this).toggleClass('is-select');
            $(this).find('img').toggleClass('is-opacity');
        // その他のクラス付け替え
        } else {
            $(this).parent().find('.cond-content').removeClass('is-select');
            $(this).parent().find('.cond-content').find('img').addClass('is-opacity');
            $(this).addClass('is-select');
            $(this).find('img').removeClass('is-opacity');
        }
    })
})