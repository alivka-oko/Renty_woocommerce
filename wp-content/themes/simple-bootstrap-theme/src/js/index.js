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
        delay: 20000,
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
        delay: 20000,
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
            delay: 20000,
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

