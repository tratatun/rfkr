<div class="news-block__scroll">
    <div class="news-container">
        @foreach ($seoRecords as $seoRecord)
            <div class="news">
                <h3 class="news__caption">{{ $seoRecord->title }}</h3>
                <p class="news__description">{!! $seoRecord->text !!}</p>
            </div>
        @endforeach
    </div>
</div>