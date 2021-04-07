<!-- Modal -->
<div class="modal fade" id="otherGenreModal" tabindex="-1" role="dialog" aria-labelledby="otherGenreModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="otherGenreModalLabel">その他のジャンル</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="cond-other-genre d-flex flex-wrap">
                    @foreach ($otherGenreList as $otherGenre)
                    <div class="othere-genre mx-2">
                        <input type="radio" name="genre" value="{{$otherGenre['genre_code']}}"
                            id="genre_{{$otherGenre['genre_code']}}" {{$loop->first ? 'checked' : ''}}>
                        <label for="genre_{{$otherGenre['genre_code']}}">
                            {{$otherGenre['title']}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="reflect">反映する</button>
            </div>
        </div>
    </div>
</div>