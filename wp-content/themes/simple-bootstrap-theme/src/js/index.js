import '../scss/main.scss';


import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, Thumbs } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

$('a[href^="#"]').click(function () {
    let anchor = $(this).attr('href');
    $('html, body').animate({
        scrollTop: $(anchor).offset().top
    }, 600);
});

const swiperArticles = new Swiper('.swiper.articles', {
    // Optional parameters
    modules: [Autoplay, Navigation],
    direction: 'horizontal',
    loop: true,
    spaceBetween: 25,
    slidesPerView: 4,
    autoplay: {
        delay: 100000,
    },
    navigation: {
        nextEl: ".articles .control-element.next",
        prevEl: ".articles .control-element.prev",
    },
});

const swiperSimilar = new Swiper('.swiper.similar', {
    // Optional parameters
    modules: [Autoplay, Navigation],
    direction: 'horizontal',
    loop: true,
    spaceBetween: 25,
    slidesPerView: 4,
    autoplay: {
        delay: 100000,
    },
    navigation: {
        nextEl: ".similar .control-element.next",
        prevEl: ".similar .control-element.prev",
    },
});

const swiperVideos = new Swiper('.swiper.videos', {
    // Optional parameters
    modules: [Navigation],
    direction: 'horizontal',
    loop: true,
    spaceBetween: 25,
    slidesPerView: 3,
    navigation: {
        nextEl: ".videos .control-element.next",
        prevEl: ".videos .control-element.prev",
    },
});
// Находим все элементы .swiper на странице
const swiperContainers = document.querySelectorAll('.swiper-container.products');

// Проходим по каждому элементу .swiper-container и инициализируем Swiper
swiperContainers.forEach((swiperContainer, index) => {
    const swiper = new Swiper(swiperContainer.querySelector(`.swiper-${index + 1}`), {
        modules: [Autoplay, Navigation, Pagination],
        direction: 'horizontal',
        loop: true,
        pagination: {
            el: swiperContainer.querySelector(`.swiper-pagination-${index + 1}`),
            clickable: true,
            renderBullet: function (index, className) {
                return `<span class="dot swiper-pagination-bullet"></span>`;
            },
        },
        autoplay: {
            delay: 1000000,
        },
    });
});

const swiperThumbnail = new Swiper(".swiper_thumbnail", {
    slidesPerView: "auto",
})

const swiperSingleProduct = new Swiper('.swiper_main', {
    modules: [Autoplay, Navigation, Pagination, Thumbs],
    loop: true,
    navigation: {
        nextEl: ".swiper-product-next",
        prevEl: ".swiper-product-prev",
    },
    thumbs: {
        swiper: swiperThumbnail,
    },
})


document.addEventListener('DOMContentLoaded', function () {
    var priceMin_def = productData.priceMin;
    var priceMax_def = productData.priceMax;
    var areaMin_def = productData.areaMin;
    var areaMax_def = productData.areaMax;

    console.log(priceMin_def);
    console.log(priceMax_def);
    console.log(areaMin_def);
    console.log(areaMax_def);

    document.getElementById('search-form').addEventListener('submit', generateFilterURL);

    function generateFilterURL(event) {
        event.preventDefault();

        var priceMin = document.getElementById('price-min').value;
        var priceMax = document.getElementById('price-max').value;
        var areaMin = document.getElementById('area-min').value;
        var areaMax = document.getElementById('area-max').value;

        var baseUrl = "/shop";
        var url = baseUrl;

        var filters = [];

        // Обработка цены
        if (priceMin || priceMax) {
            if (priceMin && !priceMax) {
                filters.push('price-' + priceMin + '-to-' + priceMax_def);
            } else if (!priceMin && priceMax) {
                filters.push('price-' + priceMin_def + '-to-' + priceMax);
            } else if (priceMin && priceMax) {
                filters.push('price-' + priceMin + '-to-' + priceMax);
            }
        }

        // Обработка площади
        if (areaMin || areaMax) {
            if (areaMin && !areaMax) {
                filters.push('area-value-' + areaMin + '-to-' + areaMax_def);
            } else if (!areaMin && areaMax) {
                filters.push('area-value-' + areaMin_def + '-to-' + areaMax);
            } else if (areaMin && areaMax) {
                filters.push('area-value-' + areaMin + '-to-' + areaMax);
            }
        }

        if (filters.length > 0) {
            url += '/swoof/' + filters.join('/');
        }

        // Проверяем наличие хотя бы одного фильтра перед перенаправлением
        if (filters.length > 0) {
            window.location.href = url;
        } else {
            // Если нет фильтров, перенаправляем на базовый URL
            window.location.href = baseUrl;
        }
    }
});
