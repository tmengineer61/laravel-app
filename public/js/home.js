$(function() {
    $('#search').on('click', function() {
        // GeoLocation
        navigator.geolocation.getCurrentPosition(searchShop,failGetGeolocation);
    })

    function searchShop(pos) {

        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;

        // hidden値を更新
        $('#lat').val(lat);
        $('#lng').val(lng);

        var genre = $('.cond-content.is-select').find('[name="genre_code"]').val();
        var page = 1;
        ajaxSearchShop(lat, lng, genre, page);
    }

    function ajaxSearchShop(lat, lng, genre, page) {
        $.ajax({
            type: 'GET',
            url: '/api/ajax/search/shop',
            data:{lat:lat, lng:lng, genre:genre, page:page},
            dataType: 'json',
            timeout: 5000,
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

    $('.cond-content').not('.is-modal').on('click', function() {
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

    $('#reflect').on('click', function() {
        $selectedGenre = $('[id^=genre]:checked');
        $condContent = $('.cond-content.is-modal');
        $condContent.find('input').val($selectedGenre.val());
        // 全ての選択条件をリセットする
        $condContent.parent().find('.cond-content').removeClass('is-select');
        $condContent.parent().find('.cond-content').find('img').addClass('is-opacity');
        // 選択状態にする
        $condContent.addClass('is-select');
        $condContent.find('img').removeClass('is-opacity');
    })

    $(document).on('click', 'a[class="page-link"]', function() {
        var page = $(this).data('page');

        const lat = $('#lat').val();
        const lng = $('#lng').val();
        var genre = $('.cond-content.is-select').find('[name="genre_code"]').val();
        ajaxSearchShop(lat, lng, genre, page);
    })

    function sliderSetting() {
        var width = $(window).width();
 
        // SP表示のみSlick化する
        if(width <= 766){
            $('.slider').not('.slick-initialized').slick({
                autoplay: false,
                // 画像を中央表示
                centerMode: true,
                // 前後の画像をどれだけ表示するか
                centerPadding: "20px",
                // 表示する画像の数
                slideToShow: 1,
                // 次の画像までの余白をなくす
                variableWidth: true,
                // 最後の画像まで表示した後にループさせるか
                infinite: false,
            });
        } else {
            $('.slider.slick-initialized').slick('unslick');
        }
    }
    sliderSetting();
 
    $(window).resize( function() {
        sliderSetting();
    });
})