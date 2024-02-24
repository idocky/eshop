$(document).ready(function(){
    $('.slider').slick({
        dots: true, // показывать точки навигации
        infinite: true, // зациклить слайдер
        speed: 500, // скорость анимации
        slidesToShow: 3, // количество слайдов, которые отображаются одновременно
        slidesToScroll: 1, // количество слайдов, которые прокручиваются за один раз
        responsive: [
            {
                breakpoint: 768, // при ширине экрана менее 768 пикселей
                settings: {
                    slidesToShow: 2 // отображать 2 слайда
                }
            },
            {
                breakpoint: 480, // при ширине экрана менее 480 пикселей
                settings: {
                    slidesToShow: 1 // отображать 1 слайд
                }
            }
        ]
    });
});
