@extends('front.layout.main')
@section('title', $dead->full_name)
@section('css')
    <style>
        .map iframe {
            width: 100%;
        }

        .comment-author-image {
            background: #2d48c3;
            color: #fff;
            display: inline-block;
            width: 90px;
            height: 90px;
            text-align: center;
            border-radius: 16px;
            font-weight: 700;
            font-size: 60px;
            margin-right: 20px;
            line-height: 90px;
            float: left;
        }
    </style>
@endsection
@section('content')
    <main>
        <div class="listing-details-area pb-100 pt-100">
            <div class="map"> {!! $dead->cemetery->address_map ?? '' !!} </div>
            <div class="news-content">
                <div class="container">
                    <div class="author-box-main mb-60">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6">
                                <div class="news-left mb-20 mb-lg-0">
                                    <div class="author-box d-sm-flex align-items-center" style="width: 800px;">
                                        <div class="thumb radius-img-50 mb-30 mb-sm-0" style="width: 80px; height: 80px;">
                                            <img src="{{ $dead->image }}" alt=""
                                                style="height: 100%; width: 100%;">
                                        </div>
                                        <div class="content">
                                            <h4 class="author-name">
                                                {{ $dead->full_name }}
                                            </h4>
                                            <div class="author-meta d-md-flex">
                                                <div class="mr-20">
                                                    <span class="font-weight-bold">Anne Adı: </span>
                                                    {{ $dead->mother_name }}
                                                </div>
                                                <div class="mr-20">
                                                    <span class="font-weight-bold">Baba Adı: </span>
                                                    {{ $dead->father_name }}
                                                </div>
                                                <div class="mr-20">
                                                    <span class="font-weight-bold">Eş Adı: </span>
                                                    {{ $dead->spouse_name ? $dead->spouse_name : 'Yok' }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Meslek: </span>
                                                    {{ $dead->job ? $dead->job : 'Yok' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div
                                    class="news-right d-flex align-items-sm-center justify-content-lg-end flex-column flex-sm-row">
                                    <div class="content-wrap d-sm-flex align-items-center">
                                        <div class="content-1 n-content-1 pr-40 mb-15 mb-sm-0">
                                            <div class="news-tag">
                                                <span class="font-weight-bold d-inline-block">Doğum Tarihi:</span>
                                                {{ $dead->day_of_birth . '.' . $dead->month_of_birth . '.' . $dead->year_of_birth }}
                                            </div>
                                            <div class="news-tag">
                                                <span class="font-weight-bold d-inline-block">Ölüm Tarihi:</span>
                                                {{ $dead->day_of_death . '.' . $dead->month_of_death . '.' . $dead->year_of_death }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="news-description">
                        <div class="row">
                            <div class="col-xl-8 col-lg-7">
                                <div class="desc-box  mb-16">
                                    {!! $dead->content !!}
                                </div>
                                <hr class="mt-20 mb-45">
                                @if ($comments->count() > 0)
                                    <div class="review-box pb-36">
                                        <h5 class="has-border mb-40">Yorumlar</h5>
                                        <div class="review-list">
                                            @foreach ($comments as $comment)
                                                <div class="single-review fix  pb-32 mb-40">
                                                    <div class="review-thumb f-review-thumb f-left mr-40">
                                                        <span
                                                            class="comment-author-image">{{ $comment->comment_full_name[0] }}</span>
                                                    </div>
                                                    <div class="review-content fix mt-11">
                                                        <div class="content-top">
                                                            <h5 class="d-inline-block">
                                                                {{ $comment->comment_full_name }}
                                                            </h5>
                                                            <small
                                                                class="text-muted">({{ $comment->comment_email }})</small>
                                                            <hr>
                                                            <h5 class="d-inline-block">{{ $comment->comment_title }}
                                                            </h5>
                                                            <p>{{ $comment->comment_message }}</p>
                                                            <input type="hidden" class="comment-id"
                                                                value="{{ $comment->id }}">
                                                            <div class="clearfix">
                                                                <a href="#"
                                                                    class="float-right text-muted text-decoration-none answer-button">Yorumu
                                                                    Cevapla</a>
                                                            </div>
                                                        </div>
                                                        <div class="answer-form answer-{{ $comment->id }}">
                                                            <hr>
                                                            <h5 class="mb-27 d-inline-block">
                                                                {{ $comment->comment_title . ' Yorumunu Cevapla' }}
                                                            </h5>
                                                            <a href="#"
                                                                class="ml-2 text-muted text-decoration-none close-button">İptal
                                                                Et</a>
                                                            <form action="{{ route('comment_answer.store') }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="comment_id"
                                                                    value="{{ $comment->id }}">
                                                                <div class="review-main mb-50 mb-lg-0">
                                                                    <div class="row custom-row-2">
                                                                        <div class="col-xl-6 custom-col-2">
                                                                            <div class="input-group mb-20">
                                                                                <span
                                                                                    class="text-danger">{{ $errors->first('answer_full_name') }}</span>
                                                                                <input type="text" placeholder="Ad Soyad"
                                                                                    name="answer_full_name"
                                                                                    class="input-default">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6 custom-col-2">
                                                                            <div class="input-group mb-20">
                                                                                <span
                                                                                    class="text-danger">{{ $errors->first('answer_email') }}</span>
                                                                                <input type="text" placeholder="Email"
                                                                                    name="answer_email"
                                                                                    class="input-default">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-12 custom-col-2">
                                                                            <div class="input-group mb-20">
                                                                                <span
                                                                                    class="text-danger">{{ $errors->first('answer_title') }}</span>
                                                                                <input type="text"
                                                                                    placeholder="Yorum Başlığı"
                                                                                    name="answer_title"
                                                                                    class="input-default">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-12 custom-col-2">
                                                                            <div class="input-group mb-25">
                                                                                <span
                                                                                    class="text-danger">{{ $errors->first('answer_message') }}</span>
                                                                                <textarea name="answer_message" class="textarea-default" id="answer_message" cols="30" rows="10"
                                                                                    placeholder="Mesaj"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-12 custom-col-2">
                                                                            <button type="submit" class="btn-default">Şimdi
                                                                                Gönder <i class="fal fa-paper-plane"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <hr>
                                                        <div class="content-bottom">
                                                            <div class="review-list">
                                                                @foreach ($comment->answers as $answer)
                                                                    @if ($answer->status == 1)
                                                                        <div class="single-review fix  pb-32 mb-40">
                                                                            <div
                                                                                class="review-thumb f-review-thumb f-left mr-40">
                                                                                <span
                                                                                    class="comment-author-image">{{ $answer->answer_full_name[0] }}</span>
                                                                            </div>
                                                                            <div class="review-content fix mt-11">
                                                                                <div class="content-top">
                                                                                    <h5>{{ $answer->answer_full_name }}
                                                                                        <small
                                                                                            class="text-muted">({{ $answer->answer_email }})</small>
                                                                                    </h5>
                                                                                    <hr>
                                                                                    <h5>{{ $answer->answer_title }}
                                                                                    </h5>
                                                                                    <p>{{ $answer->answer_message }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="fas fa-info"></i> Şu anda mevta ile alakalı bir taziye defteri yok!
                                    </div>
                                @endif
                                <div class="review-form">
                                    <h5 class="has-border mb-27">Taziye Defteri</h5>
                                    <form action="{{ route('comment.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="dead_id" value="{{ $dead->id }}">
                                        <div class="review-main mb-50 mb-lg-0">
                                            <div class="row custom-row-2">
                                                <div class="col-xl-6 custom-col-2">
                                                    <div class="input-group mb-20">
                                                        <span
                                                            class="text-danger">{{ $errors->first('comment_full_name') }}</span>
                                                        <input type="text" placeholder="Ad Soyad"
                                                            name="comment_full_name" class="input-default">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 custom-col-2">
                                                    <div class="input-group mb-20">
                                                        <span
                                                            class="text-danger">{{ $errors->first('comment_email') }}</span>
                                                        <input type="text" placeholder="Email" name="comment_email"
                                                            class="input-default">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 custom-col-2">
                                                    <div class="input-group mb-20">
                                                        <span
                                                            class="text-danger">{{ $errors->first('comment_title') }}</span>
                                                        <input type="text" placeholder="Yorum Başlığı"
                                                            name="comment_title" class="input-default">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 custom-col-2">
                                                    <div class="input-group mb-25">
                                                        <span
                                                            class="text-danger">{{ $errors->first('comment_message') }}</span>
                                                        <textarea name="comment_message" class="textarea-default" id="comment_message" cols="30" rows="10"
                                                            placeholder="Mesaj"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 custom-col-2">
                                                    <button type="submit" class="btn-default">Şimdi Gönder <i
                                                            class="fal fa-paper-plane"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-5">
                                <div class="sidebar-wrapper">
                                    <div class="single-widget d-inline-block d-lg-block">
                                        <h4 class="widget-title mb-0"><span>//</span> Mevta Fotoğrafı</h4>
                                        <div class="sponsor-thumb">
                                            <a href="listing-details.html">
                                                <img src="{{ $dead->image }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="single-widget widget-2 mt-30">
                                        <div class="widget-map">
                                            <div class="map-frame pb-27">
                                                @if ($dead->cemetery->address_map ?? '')
                                                    {!! $dead->cemetery->address_map ?? '' !!}
                                                @else
                                                    <img src="{{ $dead->image }}" alt="">
                                                @endif
                                            </div>
                                            <div class="map-content pl-20 pr-20">
                                                <ul class="address-list">
                                                    @if ($dead->country_id == '190')
                                                        <li><i
                                                                class="fal fa-location"></i>{{ $dead->country ? $dead->country->title : '-' . ' ' . $dead->province->name . ' ' . $dead->district->name . ' ' . $dead->neighborhood->name }}
                                                        </li>
                                                        <li><i
                                                                class="fal fa-monument"></i>{{ $dead->cemetery ? $dead->cemetery->title : $dead->cemetery_name }}
                                                        </li>
                                                    @else
                                                        <li><i
                                                                class="fal fa-location"></i>{{ $dead->country ? $dead->country->title : '-' . ' ' . $dead->province_name . ' ' . $dead->district_name . ' ' . $dead->neighborhood_name }}
                                                        </li>
                                                        <li><i class="fal fa-monument"></i>{{ $dead->cemetery_name }}
                                                        </li>
                                                    @endif
                                                    <li><i class="fal fa-building"></i>
                                                        @forelse ($dead->organisations as $org)
                                                            {{ $org->name . ', ' }}
                                                        @empty
                                                            Kurum Yok
                                                        @endforelse
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
@section('js')
    <script>
        $(".answer-form").hide();
        $(".answer-button").click(function(event) {
            event.preventDefault();

            var commentId = $(this).closest(".content-top").find(".comment-id").val();

            $(".answer-" + commentId).show();
            $(".review-form").hide();
            $(this).hide();
        });
        $(".close-button").click(function(event) {
            event.preventDefault();

            var commentId = $(this).closest(".review-content").find(".comment-id").val();

            $(".answer-" + commentId).hide();
            $(".answer-button").show();
            $(".review-form").show();
        });
    </script>
@endsection
