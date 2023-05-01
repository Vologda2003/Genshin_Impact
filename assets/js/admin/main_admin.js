// Скрытие и появление header

$(document).ready(function () {
    if ($(window).width() < 951) {
        $(".show").click(function () {
            $(".hide").css('display', 'flex');
            $(".show").css('display', 'none');
            $(".info").css('display', 'flex');
            $(".admin").css('display', 'flex');
            $(".search").css('display', 'flex');
        });
    }
});

$(document).ready(function () {
    if ($(window).width() < 951) {
        $(".hide").click(function () {
            $(".show").css('display', 'flex');
            $(".hide").css('display', 'none');
            $(".info").css('display', 'none');
            $(".admin").css('display', 'none');
            $(".search").css('display', 'none');
        });
    }
});

$(document).ready(function () {
    if ($(window).width() < 951) {
        var scrol;
        var y = 0;
        $(window).scroll(function () {
            var scrolled = $(window).scrollTop();
            if (scrolled > scrol) {
                y++;
                if (y >= 2) {
                    $("header").css('display', 'none');
                    $(".show").css('display', 'flex');
                    $(".hide").css('display', 'none');
                    $(".info").css('display', 'none');
                    $(".admin").css('display', 'none');
                    $(".search").css('display', 'none');
                    y = 0;
                }
            } else {
                $("header").css('display', 'flex');
            }
            scrol = scrolled;
        });
    }
});