window.addEventListener('scroll', function () {
    document.querySelector('header').classList.toggle('shadow-head', window.scrollY > 20);
});


document.addEventListener('livewire:navigated', () => {
    $('#shadow, .close').click(function () {
        $('#shadow').fadeOut();
        $('#basket').fadeOut();
        $('#wish-list').fadeOut();
        $('.add-comment').fadeOut();
        $('body').css("overflow", "auto");
        return false;
    });
    $('#open-basket').click(function () {
        $('#shadow').fadeIn();
        $('#basket').fadeIn();
        $('body').css("overflow", "hidden");
        return true;
    });
    $('.open-wish').click(function () {
        $('#shadow').fadeIn();
        $('#wish-list').fadeIn();
        $('body').css("overflow", "hidden");
        return true;
    });

    $('#review-add').click(function () {
        $('.add-comment').fadeIn();
        $('#shadow').fadeIn();
        $('body').css("overflow", "hidden");
        return true;
    });
})

document.addEventListener('livewire:navigated', () => {
    $('#catalog').click(function () {
        if ($('.catalog').css("display") === "none") {
            $('.catalog').fadeIn();
            $('#shadow2').fadeIn();
        } else {
            $('.catalog').fadeOut();
            $('#shadow2').fadeOut();
        }
    });
    $('#shadow2, #shadow3, #closeGallery').click(function () {
        $('.catalog').fadeOut();
        $('#shadow2').fadeOut();
        $('#shadow3').fadeOut();
        $(".drop-down").fadeOut();
        $(".gallery").fadeOut();
        $('.search-panel').removeClass('d-block-md');
    });
})


document.addEventListener('livewire:navigated', () => {
    const sliderMin = document.getElementById('slider-min');
    const sliderMax = document.getElementById('slider-max');

    if (sliderMin && sliderMax) {
        sliderMin.addEventListener('input', () => {
            if (parseInt(sliderMin.value) > parseInt(sliderMax.value)) {
                sliderMin.value = sliderMax.value;
            }
        });

        sliderMax.addEventListener('input', () => {
            if (parseInt(sliderMax.value) < parseInt(sliderMin.value)) {
                sliderMax.value = sliderMin.value;
            }
        });
    }

    // const plus = document.querySelector(".plus"),
    //     minus = document.querySelector(".minus"),
    //     num = document.querySelector(".num");
    // let a = num.value;
    // plus.addEventListener("click", () => {

    //     if (a < 100) {
    //         a++;
    //         num.value = a;
    //     }

    // });

    // minus.addEventListener("click", () => {
    //     if (a > 1) {
    //         a--;
    //         num.value = a;
    //     }
    // });
});

document.addEventListener('livewire:navigated', () => {
    $('#description').click(function () {
        $('#features-desc').css("display", "none");
        $('#comments-desc').css("display", "none");
        $('#description-desc').fadeIn();
        $('#description').addClass('active');
        $('#features').removeClass('active');
        $('#comments').removeClass('active');
    });
    $('#features').click(function () {
        $('#description-desc').css("display", "none");
        $('#comments-desc').css("display", "none");
        $('#features-desc').fadeIn();
        $('#features').addClass('active');
        $('#comments').removeClass('active');
        $('#description').removeClass('active');
    });
    $('#comments, #open-reviews').click(function () {
        $('#description-desc').css("display", "none");
        $('#features-desc').css("display", "none");
        $('#comments-desc').fadeIn();
        $('#comments').addClass('active');
        $('#description').removeClass('active');
        $('#features').removeClass('active');
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('review_js') && urlParams.get('review_js') === 'true') {
        $('#description-desc').css("display", "none");
        $('#features-desc').css("display", "none");
        $('#comments-desc').fadeIn();
        $('#comments').addClass('active');
        $('#description').removeClass('active');
        $('#features').removeClass('active');
    }
});

document.addEventListener('livewire:navigated', () => {
    $('#top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });
})

$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });
});


document.addEventListener('livewire:navigated', () => {
    $('#account-btn-1').click(function () {
        $('#account-show-1').fadeIn();
        $('#account-show-2').css("display", "none");
        $('#account-show-3').css("display", "none");
        $('#account-btn-1').addClass('active');
        $('#account-btn-2').removeClass('active');
        $('#account-btn-3').removeClass('active');
    });
    $('#account-btn-2').click(function () {
        $('#account-show-2').fadeIn();
        $('#account-show-1').css("display", "none");
        $('#account-show-3').css("display", "none");
        $('#account-btn-2').addClass('active');
        $('#account-btn-1').removeClass('active');
        $('#account-btn-3').removeClass('active');
    });
    $('#account-btn-3').click(function () {
        $('#account-show-3').fadeIn();
        $('#account-show-1').css("display", "none");
        $('#account-show-2').css("display", "none");
        $('#account-btn-3').addClass('active');
        $('#account-btn-1').removeClass('active');
        $('#account-btn-2').removeClass('active');
    });
});


document.addEventListener('livewire:navigated', () => {
    $('#search-md').click(function () {
        $('.search-panel').addClass('d-block-md');
        $('#shadow3').fadeIn();
    });


    $('#show-menu').click(function () {
        if ($('.lead-hidden-menu').css('display') == 'block') {
            $('#show-menu img:nth-child(1)').animate({
                rotate: '0deg',
                marginBottom: '14px',
            });
            $('#show-menu img:nth-child(2)').fadeIn();
            $('#show-menu img:nth-child(3)').animate({
                rotate: '0deg',
                marginTop: '14px',
            });
            $('.lead-hidden-menu').slideUp();
        } else {
            $('#show-menu img:nth-child(1)').animate({
                rotate: '-135deg',
                marginBottom: '-4px',
            });
            $('#show-menu img:nth-child(2)').fadeOut();
            $('#show-menu img:nth-child(3)').animate({
                rotate: '135deg',
                marginTop: '-4px',
            });
            $('.lead-hidden-menu').slideDown();
        }
    });
});

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "500",
    "timeOut": "4000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "slideDown",
    "hideMethod": "slideUp"
}
