{{-- カード表示を横並びにする：d-flex 折り返す：flex-wrap センター寄せする：justify-content-center --}}
<div class="d-flex flex-wrap justify-content-center cards">
    @foreach($shopList as $shop)
    <div class="card my-1" style="width: 20rem;">
        <div class="card-header">
            <a href="{{$shop['urls']['pc']}}" target="blank">
                {{$shop['name']}}
            </a>
        </div>
        <div class="card-body">
            @foreach ($shop['photo'] as $device => $info)
            {{-- PCの時のみ表示したい： d-none d-md-blockをつける。 SPの時のみ表示したい：d-md-noneをつける --}}
            <div class="shop-image {{$device == 'pc' ? 'd-none d-md-block' : 'd-md-none'}}">
                <img src="{{$info['l']}}" class="d-block mx-auto" />
            </div>
            @endforeach
        </div>
        <div class="card-footer">
            <p>ジャンル：{{$shop['genre']['name']}}</p>
            <p>平均予算 :{{$shop['budget']['average']}}</p>
            <p>営業時間	:{{$shop['open']}}</p>
        </div>
    </div>
    @endforeach
</div>