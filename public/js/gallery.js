document.addEventListener('livewire:navigated', () => {
    $(document).ready(function () {
        $('.carousel-product img').click(function (event) {
            $('.carousel-product img').removeClass('active-product');
            $(this).addClass('active-product');
            if ($('.product-main-image > img').attr('src') !== $(this).attr('src')) {
                $('.product-main-image > img').hide().attr('src', $(this).attr('src')).fadeIn(1000);
            }
            event.preventDefault();
        });

        $('.next-product').click(function () {
            let last = $('.carousel-product img:last');
            let first = $('.carousel-product img:first');
            let current = $('.product-main-image > img').attr('src');
            let currentMini = $(`.carousel-product img[src="${current}"]`);
            if (last.attr('src') === currentMini.attr('src')) {
                $('.carousel-product img').removeClass('active-product');
                first.addClass('active-product');
                $('.product-main-image > img').hide()
                    .attr('src', $(first).attr('src')).fadeIn(1000);
            } else {
                $('.carousel-product img').removeClass('active-product');
                currentMini.next().addClass('active-product');
                $('.product-main-image > img').hide()
                    .attr('src', $(currentMini.next()).attr('src')).fadeIn(1000);
            }
        });


        $('.prev-product').click(function () {
            let last = $('.carousel-product img:last');
            let first = $('.carousel-product img:first');
            let current = $('.product-main-image > img').attr('src');
            let currentMini = $(`.carousel-product img[src="${current}"]`);
            if (first.attr('src') === currentMini.attr('src')) {
                $('.carousel-product img').removeClass('active-product');
                last.addClass('active-product');
                $('.product-main-image > img').hide()
                    .attr('src', $(last).attr('src')).fadeIn(1000);
            } else {
                $('.carousel-product img').removeClass('active-product');
                currentMini.prev().addClass('active-product');
                $('.product-main-image > img').hide()
                    .attr('src', $(currentMini.prev()).attr('src')).fadeIn(1000);
            }
        });

        /*----------------------------big gallery-----------------------------------*/

        $('#open-gallery').click(function () {
            $('.main-image > img').attr('src', $(this).attr('src'));
            $('.carousel-products img').removeClass('active-product');
            let current = $('.main-image > img').attr('src');
            let currentMini = $(`.carousel-products img[src="${current}"]`);
            currentMini.addClass('active-product');
            $('.gallery').fadeIn(1000);
            $('#shadow2').fadeIn(1000);
        })


        $('.carousel-products img').click(function () {
            $('.carousel-products img').removeClass('active-product');
            $(this).addClass('active-product');
            if ($('.main-image > img').attr('src') !== $(this).attr('src')) {
                $('.main-image > img').hide().attr('src', $(this).attr('src')).fadeIn(1000);
            }
        });

        $('.next-big').click(function () {
            let last = $('.carousel-products img:last');
            let first = $('.carousel-products img:first');
            let current = $('.main-image > img').attr('src');
            let currentMini = $(`.carousel-products img[src="${current}"]`);
            letCurrentMiniIndex = currentMini.index() + 1;
            if (last.attr('src') === currentMini.attr('src')) {
                $('.carousel-products > img').removeClass('active-product');
                first.addClass('active-product');
                $('.main-image > img').hide()
                    .attr('src', $(first).attr('src')).fadeIn(1000);
                $('#scroll-carousel').animate({
                    marginLeft: 0
                }, 1000);
            } else {
                let lengthCAll = $('.carousel-products > img').length;
                $('.carousel-products > img').removeClass('active-product');
                currentMini.next().addClass('active-product');
                $('.main-image > img').hide()
                    .attr('src', $(currentMini.next()).attr('src')).fadeIn(1000);


                if (letCurrentMiniIndex < 5) {
                    $('#scroll-carousel').animate({
                        marginLeft: 0
                    }, 1000);
                } else if (letCurrentMiniIndex > lengthCAll - 6) {
                    let countScroll = $('#scroll-carousel').css('margin-left');
                    let resultSctoll = separateNumberFromText(countScroll);
                    let leftC = resultSctoll.number - 250;
                    let lengthCAll = $('.carousel-products > img').length * 70;
                    let lengthC = $('#scroll-carousel').width();
                    let diferenceLenght = lengthCAll - lengthC;
                    console.log(diferenceLenght);
                    if (leftC < - diferenceLenght) {
                        $('#scroll-carousel').animate({
                            marginLeft: - diferenceLenght
                        }, 1000);
                        return;
                    }
                }
                else {
                    let lengthC = $('#scroll-carousel').width();
                    $('#scroll-carousel').animate({
                        marginLeft: (lengthC / 2) - (letCurrentMiniIndex * 70) - 70 + 35
                    }, 1000);

                }
            }
        });

        $('.prev-big').click(function () {
            let last = $('.carousel-products img:last');
            let first = $('.carousel-products img:first');
            let current = $('.main-image > img').attr('src');
            let currentMini = $(`.carousel-products img[src="${current}"]`);
            letCurrentMiniIndex = currentMini.index();
            console.log(letCurrentMiniIndex);
            if (first.attr('src') === currentMini.attr('src')) {
                $('.carousel-products > img').removeClass('active-product');
                last.addClass('active-product');
                $('.main-image > img').hide()
                    .attr('src', $(last).attr('src')).fadeIn(1000);

                let lengthC = $('#scroll-carousel').width();
                let lengthCAll = $('.carousel-products > img').length * 70;
                let diferenceLenght = lengthCAll - lengthC;
                $('#scroll-carousel').animate({
                    marginLeft: - diferenceLenght
                }, 1000);
            } else {
                $('.carousel-products > img').removeClass('active-product');
                currentMini.prev().addClass('active-product');
                $('.main-image > img').hide()
                    .attr('src', $(currentMini.prev()).attr('src')).fadeIn(1000);


                let lengthCAll = $('.carousel-products > img').length;
                letCurrentMiniIndex = currentMini.index() + 1;
                if (letCurrentMiniIndex < 7) {
                    $('#scroll-carousel').animate({
                        marginLeft: 0
                    }, 1000);
                } else if (letCurrentMiniIndex > lengthCAll - 6) {
                    let lengthCAll = $('.carousel-products > img').length * 70;
                    let countScroll = $('#scroll-carousel').css('margin-left');
                    let resultSctoll = separateNumberFromText(countScroll);
                    let leftC = resultSctoll.number - 250;
                    let lengthC = $('#scroll-carousel').width();
                    let diferenceLenght = lengthCAll - lengthC;
                    console.log(diferenceLenght);
                    if (leftC < - diferenceLenght) {
                        $('#scroll-carousel').animate({
                            marginLeft: - diferenceLenght
                        }, 1000);
                        return;
                    }
                }
                else {
                    let lengthC = $('#scroll-carousel').width();
                    $('#scroll-carousel').animate({
                        marginLeft: (lengthC / 2) - (letCurrentMiniIndex * 70) + 70 + 35
                    }, 1000);
                    console.log(letCurrentMiniIndex * 70)
                }
            }
        });

        $('.next-small').click(function () {
            let countScroll = $('#scroll-carousel').css('margin-left');
            let resultSctoll = separateNumberFromText(countScroll);
            let leftC = resultSctoll.number - 250;
            let lengthCAll = $('.carousel-products > img').length * 70;
            let lengthC = $('#scroll-carousel').width();
            let diferenceLenght = lengthCAll - lengthC;
            if (leftC < - diferenceLenght) {
                $('#scroll-carousel').animate({
                    marginLeft: - diferenceLenght
                }, 1000);
                return;
            }
            $('#scroll-carousel').animate({
                marginLeft: leftC
            }, 1000);
        });


        $('.prev-small').click(function () {
            let countScroll = $('#scroll-carousel').css('margin-left');
            let resultSctoll = separateNumberFromText(countScroll);
            let leftC = resultSctoll.number + 250;
            if (leftC >= 0) {
                $('#scroll-carousel').animate({
                    marginLeft: 0
                }, 1000);
                return;
            }
            $('#scroll-carousel').animate({
                marginLeft: leftC
            }, 1000);
        });

        function separateNumberFromText(text) {
            const numberPart = text.match(/(-?\d+)(.*)/); // Находим первое число в строке
            const number = numberPart ? parseInt(numberPart[0], 10) : NaN; // Преобразуем в число, если найдено
            const textPart = text.replace(/\d+/, '').trim(); // Удаляем число и пробелы
            return {
                number: number,
                text: textPart
            };
        }
    });
});