<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('imgs/technical/favicon.png') }}">
    <title>{{ config('app.name') }} | {{ $title }}</title>
    <base href="{{ asset('/') }}">
    
    {{-- Яндекс.Аналитика --}}
    @include('partials.analytics')

    {{-- Текст --}}
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap');
      .indie-flower-regular {
      font-family: "Indie Flower", cursive;
      font-weight: 400;
      font-style: normal;
      }
    </style>
    {{-- CSS файл --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">

    {{-- Кроппер --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" rel="stylesheet">
    
    {{-- Бутстрап --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    {{-- Иконки --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    {{-- Админка --}}
    <link rel="preload" href="./css/adminlte.css" as="style" />

    {{-- Плагины админки --}}
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
    {{-- swiperjs --}}
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @include('partials.cookie-notification')
  <aside class="sidebar" id="mainSidebar">
    <div class="logo">
        <img width="25px" style="height: 40px !important;" loading="lazy" src="{{ asset('imgs/technical/logo.png') }}"></img>
        <a class="indie-flower-regular fs-1 fw-bold text-nowrap" href="{{ route('main.index') }}"><span class="title-geek">Geek</span>-Print33</a>
    </div>
    <nav>
      <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="navigation"
          data-accordion="false"
          id="navigation"
      >
          <li class="nav-item">
              <a href="{{ route('main.index') }}" class="nav-link active">
                  <i class="fa-solid fa-house-chimney"></i>
                  <p>
                  Главная
                  </p>
              </a>
          </li>
          <li class="nav-item sidebar-cart d-none">
                <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span class="cart-text position-relative">
                        Корзина
                        @if($items_cart->count()>0)
                            <span class="cart-amount position-absolute js-cart-items-count">{{ $items_cart->count() }}</span>
                        @endif
                    </span>
                </a>
          </li>
          <li class="nav-item sidebar-wishlist d-none">
                <a href="{{ route('wishlist.index') }}" class="nav-link">
                    <i class="fa-solid fa-heart"></i>
                    <span class="cart-text">Избранное</span>
                    @if($items_wishlist->count()>0)
                    <span class="wishlist-amount position-absolute js-cart-items-count">{{ $items_wishlist->count() }}</span>
                    @endif
                </a>
          </li>
          <li class="nav-item menu-open">
              <a class="nav-link">
                  <i class="fa-solid fa-align-justify"></i>
                  <p>
                  Каталог
                  <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('products.index') }}" class="nav-link active">
                      <i class="fa-solid fa-arrow-right-long"></i>
                      <p>Все</p>
                      </a>
                  </li>

                  @foreach ($categories as $cat)
                  <li class="nav-item">
                      <a href="{{ url('/products?category_id[]=') . $cat->id }}" class="nav-link">
                          <i class="fa-solid fa-arrow-right-long"></i>
                          <p>{{ $cat->title }}</p>
                      </a>
                  </li>
                  @endforeach
              </ul>
          </li>
          <li class="nav-item">
              <a href="{{ route('main.about_us') }}" class="nav-link active">
                  <i class="fa-solid fa-users-between-lines"></i>
                  <p>
                      О нас
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('main.delivery') }}" class="nav-link active">
                  <i class="fa-solid fa-truck"></i>
                  <p>
                  Доставка и оплата
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('main.contacts') }}" class="nav-link active">
                  <i class="fa-solid fa-phone"></i>
                  <p>
                  Контакты
                  </p>
              </a>
          </li>
      </ul>
    </nav>
    <div class="sidebar-info">
        <hr>
        <div class="sidebar-info-inner p-4 text-center">
            <i class="fa-solid fa-cube"></i>
            3D-услуги
        </div>
    </div>
  </aside>
  <header class="topbar">
        <div class="navbar-wrapper sticky-top">
            <div class="ms-3 navbar-other">
                <div class="topbar-act">
                    <a class="sidebar-toggle-box" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                    <form class="searchForm"
                        action="{{ route('products.index') }}"
                        method="GET"
                        autocomplete="off">
                        <input class="form-control"
                            type="text"
                            name="query"
                            id="search-input"
                            placeholder="Поиск по товарам...">
                        <button type="submit" class="btn btn-link text-dark">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>

                <div class="search-popup__results d-none" id="box-content-search-wrapper">
                    <div class="recent__wrapper sticky-top" id="recentCard">
                        <div class="recent__header">Недавно искали</div>
                        <div class="recent__body">
                            <ul id="recentList" class="search-popup__recent-list"></ul>
                        </div>
                    </div>
                    <div class="search-popup__results-list">
                        <ul id="box-content-search">
            
                        </ul>
                    </div>
                </div>

                <div class="actions">
                    <button class="wishlist">
                            <a href="{{ route('wishlist.index') }}">
                                <i class="fa-solid fa-heart"></i>
                                @if($items_wishlist->count()>0)
                                <span class="wishlist-amount position-absolute js-cart-items-count">{{ $items_wishlist->count() }}</span>
                                @endif
                            </a>
                    </button>
                    <button class="cart">
                        <a href="{{ route('cart.index') }}" clsas="position-relative">
                                <i class="fa-solid fa-basket-shopping"></i>
                            <span class="cart-text">Корзина</span>
                            @if($items_cart->count()>0)
                                <span class="cart-amount position-absolute js-cart-items-count">{{ $items_cart->count() }}</span>
                            @endif
                        </a>
                    </button>
                </div>
            </div>
        </div>
  </header>
  <div class="content">
    <main>
        @yield('main-content')
    </main>

    <footer>
        <div class="footer-wrapper">
            <div class="footer-inner">
                <div>
                    <a class="w-100" href="{{ route('main.index') }}"><span>Главная</span></a>
                    <a class="w-100" href="{{ route('main.about_us') }}"><span>О нас</span></a>
                    <a class="w-100" href="{{ route('main.contacts') }}"><span>Контакты</span></a>
                </div>
                <div>
                    <a class="w-100" href="{{ route('main.delivery') }}"><span>Доставка</span></a>
                    <a class="w-%00" href="{{ route('main.delivery') }}"><span>Оплата</span></a>
                    <a class="d-flex flex-column" href="{{ route('main.privacy') }}"><span>Политика</span>Конфиденциальности</a>
                </div>
            </div>
            <div class="w-100 text-center p-1">
                <p>© 2024-2025 Geek-print33. Все права защищены.</p>
                <p>Наш E-mail: Geek-print33@yandex.ru</p>
            </div>
        </div>
        {{-- Скрипты --}}

        {{-- Админка --}}
        <script src="./js/adminlte.js"></script>

        {{-- Бутстрап --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        {{-- swiperjs --}}
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
        <script src="./js/swiper.js"></script>
        <script src="./js/swiper-products.js"></script>
        <script src="./js/swiper-popularProducts.js"></script>

        {{-- Логика появления fade-in --}}
        <script>
            const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                }
            });
            }, {
            threshold: 0.50 // При 0.XX показывать элемент
            });

            document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
        </script>

        {{-- Копирование почты --}}
        <script>
            function copyText(element) {
                const email = 'Geek-print33@yandex.ru'

                navigator.clipboard.writeText(email).then(() => {
                    const originalText = element.innerHTML;
                    element.innerHTML = 'Почта скопирована!';
                    setTimeout(() => {
                        element.innerHTML = originalText;
                    }, 1500);
                })
                .catch(err => {
                    alert('Не удалось скопировать почту: ' + err);
                });
            }
        </script>

        <script>
            $(function() {
                $("#search-input").on("keyup",function() {
                    var searchQuery = $(this).val().trim();
                    const $box = $("#box-content-search");
                    if (searchQuery.length > 2) {
                        document.querySelector("#box-content-search-wrapper").classList.remove("d-none")
                        $.ajax({
                            type: "GET",
                            url: "{{ route('main.search') }}",
                            data: {query: searchQuery},
                            dataType: 'json',
                            success: function(data) {
                                $("#box-content-search").html('');
                                $.each(data, function(index,item) {
                                    var url = "{{ route('products.show', ['product' => 'product_id']) }}";
                                    var link = url.replace('product_id',item.id);
                                    var image = `/storage/${item.image}`;
                                    $("#box-content-search").append(`
                                        @include('product.search-product')
                                    `);
                                });
                            }
                        }).done(function (data) {
                            if (!data || data.length === 0) {
                                $box.html('<p class="text-center p-5 fw-bold fs-5">Ничего не нашлось.</p>');
                                return;
                            }
                        })
                    }
                    const $input = $('#search-input');
                    const $box_wrapper = $('#box-content-search-wrapper')
                    $(document).on('click', function (e) {
                        if ($input.is(e.target) || $box_wrapper[0].contains(e.target)) {
                            return;
                        }
                        else {
                            document.querySelector("#box-content-search-wrapper").classList.add("d-none")
                        }
                        

                        $input.on('click', function() {
                            if ($input.val().length > 2) {
                                document.querySelector("#box-content-search-wrapper").classList.remove("d-none")
                            }
                            else {
                                $box.addClass('d-none');
                            }
                        })
                    });
                })
            });
        </script>
        <script>
            $(function () {
                const STORAGE_KEY = "recentSearch";
                const MAX_ITEMS = 5;

                function getRecent() {
                    try {
                        return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
                    } catch(e) { return []; }
                }
                function setRecent(list) {
                    localStorage.setItem(STORAGE_KEY, JSON.stringify(list));
                }
                function renderRecent() {
                    const list = getRecent();
                    const $ul  = $('#recentList').empty();
                    const $card= $('#recentCard');

                    if (!list.length) {
                        $ul.addClass('d-none');
                        return;
                    }
                    $ul.removeClass('d-none');

                    list.forEach(text => {
                        $ul.append(
                            `<li class="search-popup__recent-item">
                                    <a class="recent-query" href="{{ route('products.index') }}?query=${text}">${text}</a>
                                    <i class="remove-query fa-solid fa-xmark"></i>
                            </li>`
                        );
                    });
                }
                function addQuery(text) {
                    text = text.trim();
                    if (!text) return;
                    const list = getRecent().filter(q => q !== text);
                    list.unshift(text);
                    setRecent(list.slice(0, MAX_ITEMS));
                    renderRecent();
                }
                $(document).on('click', '.remove-query', function (e) {
                    e.stopPropagation();
                    const text = $(this).siblings('.recent-query').text();
                    const list = getRecent().filter(q => q !== text);
                    setRecent(list);
                    renderRecent();
                });
                $(document).on('click', '.recent-query', function () {
                    $('#search-input').val($(this).text()).trigger('keyup');
                });
                $('#search-input').on('keydown', function (e) {
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        addQuery($(this).val());
                    }
                });
                renderRecent();
            });
        </script>
        <script>
        $(document).on('mouseenter', '.search-popup__recent-item', function () {
            $(this).find('.remove-query').removeClass('d-none');
        });
        $(document).on('mouseleave', '.search-popup__recent-item', function () {
            $(this).find('.remove-query').addClass('d-none');
        });
        </script>
        <script>
            let opened = 1;
            document.addEventListener('DOMContentLoaded', () => {
                const viewportWidth = window.innerWidth;
            const sidebar = document.querySelector('app-loaded');
            var widthEl = document.querySelector('.navbar-wrapper').clientWidth;
            if (viewportWidth < 1025) {
                document.getElementById('mainSidebar').classList.add('sidebar-collapsed');
            }
            document.querySelector('[data-lte-toggle="sidebar"]')
                .addEventListener('click', e => {
                    var widthEl = document.querySelector('.navbar-wrapper').clientWidth;
                    if (opened % 2 == 0) {
                        document.querySelector('.nav-item').style.wordBreak = "keep-all"
                    } else {
                        document.querySelector('.nav-item').style.wordBreak = "break-all"
                    }
                    opened += 1;
                    console.log(widthEl)
                    if (widthEl < 1024 && opened % 2 == 0) {
                        document.querySelector('.content').classList.toggle('d-none');
                        document.querySelector('footer').classList.toggle('d-none');
                        document.querySelector('.actions').classList.add('d-none');
                        document.querySelector('.sidebar-cart').classList.remove('d-none');
                        document.querySelector('.sidebar-wishlist').classList.remove('d-none');

                        document.querySelector('.topbar-act').style.width = "100%"
                        document.querySelector('.topbar-act').style.justifyContent = "center"
                        console.log(opened)
                    } else if (opened % 2 == 1) {
                        document.querySelector('.sidebar-cart').classList.add('d-none');
                        document.querySelector('.sidebar-wishlist').classList.add('d-none');
                        document.querySelector('.actions').classList.remove('d-none');
                        document.querySelector('.content').classList.remove('d-none');
                        console.log(opened)
                    }
                    e.preventDefault();
                    document.getElementById('mainSidebar').classList.toggle('sidebar-collapsed');
                });
            })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    </footer>
  </div>
</body> 
</html>