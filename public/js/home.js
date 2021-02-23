$(function() {
    $('#search').on('click', function() {
        // GeoLocation
        navigator.geolocation.getCurrentPosition(searchShop,failSearchShop);
    })

    function searchShop(pos) {

        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;

        $.ajax({
            type: 'POST',
            url: '/api/ajax/search/shop',
            data:{lat:lat, lng:lng},
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
                alert('エラーです');
            }
        })
        .fail(function() {
            // TODO:
        });

    }
    function failSearchShop(error) {
        alert('エラーです');
    }

    function showShop(data) {
        $('#shop').html(data.views)
    }
})