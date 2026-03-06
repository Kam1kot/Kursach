@extends('layouts.header')

@section('main-content')
    <div class="main-inner mt-5 pt-5">
        {{-- Блок баннеров --}}
        <div class="main-banners">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <a class="swiper-slide banner-wrapper" href="{{ route('products.index') }}">
                        <img loading="lazy" src="{{ asset('imgs/technical/main_banner.png') }}" alt="Geek-Print33. Уют в каждой детали">
                    </a>
                    <a class="swiper-slide banner-wrapper" href="{{ route('products.show',['product' => 103]) }}">
                        <img loading="lazy" src="{{ asset('imgs/technical/main_banner_sobaka_tovar.png') }}" alt="Geek-Print33. Уют в каждой детали">
                    </a>
                </div>
                <div class="swiper-pagination"></div>
    
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        {{-- Блок популярных товаров --}}
        <div class="mt-4 pt-4 pb-4 w-100 d-block justify-content-center">
            <div class="text-center">
                <h2 class="fs-2">Популярные товары</h2>
            </div>
            <div class="popular-product-list">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($products->sortByDesc('sold')->take(3) as $product)
                            <div class="swiper-slide">
                                @include('product.card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="see-other d-flex justify-content-center fs-4 fw-bold my-2 fade-in">
                <a class="" href="{{ route('products.index') }}">Смотреть остальное!</a>
            </div>
        </div>

        <!-- <div class="w-100 running-text">
            <div class="mt-1 mb-3" id="running-text">Только сегодня! Успейте купить игрушки до Нового Года и получите скидку в <bolder>35%</bolder></div>
        </div> -->

        {{-- Блок о нас --}}
        <div class="mt-4 mb-4">
            <div class="text-center mb-4 fade-in">
                <h2 class="fs-2">Индивидуальные 3D-изделия</h2>
            </div>
            <section class="content-wrapper ind-1">
                <div class="content-inner ind-2"> 
                    <div class="banner-wrapper mb-3 fade-in">
                        <img src="{{ asset('imgs/technical/you-ideas-banner.png') }}" alt="">
                    </div>
                    <div class="your-ideas-wrapper fade-in">
                        <p class="fs-2 fw-bold mb-2">Создаем по вашим идеям</p>
                        <p class="mb-2">В мире стандартных решений мы видим возможность быть уникальными. Наша миссия — превратить ваши идеи в реальность с помощью индивидуальных 3D-изделий.</p>
                        <p class="mb-2">Наши мастера 3D-печати работают с уважением к деталям, создавая изделия, которые не только выглядят великолепно, но и служат долгие годы.</p>
                        <p class="mb-4">Чтобы начать создание вашего уникального изделия, свяжитесь с нами. Мы с радостью расскажем о наших возможностях и поможем вам принять решение.</p>
                        <div class="d-flex align-items-center gap-2 w-100 flex-wrap justify-content-center">
                            <a class="btn" target="_blank" href="https://vk.com/im?media=&sel=810995763">Связаться с нами <b>VK</b></a>
                            <a class="btn" href="{{ route('feedback') }}">Связаться с нами <b>Почтой</b></a>
                            <a class="btn" target="_blank" href="https://www.avito.ru/profile/messenger/channel/u2u-Rb4dz_GzFWD6R53lDeIyTw">Связаться с нами <b>Avito</b></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection()