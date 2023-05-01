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



// Вывод редкости

function rare_secttion(rare){
    document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_5');
    document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_4');
    document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_3');
    document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_2');
    document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_1');
    if (rare != '') {
        document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_5');
        document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_4');
        document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_3');
        document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_2');
        document.getElementsByClassName('items-form-add-header-logo')[0].classList.remove('star_1');
        document.getElementsByClassName('items-form-add-header-logo')[0].classList.add(rare);
    }
}



// Получение и вывод картинки

let items_image = document.getElementsByClassName('items-form-add-header-logo-icon-image')[0];

items_image.addEventListener('change', function () {
    document.getElementsByClassName('items-form-add-header-logo-icon')[0].style.backgroundImage = "url(" + URL.createObjectURL(items_image.files[0]) + ")";
});

document.getElementsByClassName('items-form-add')[0].addEventListener('reset', function () {
    if(path == "none"){
        document.getElementsByClassName('items-form-add-header-logo-icon')[0].style.backgroundImage = path;
    }
    else{
        document.getElementsByClassName('items-form-add-header-logo-icon')[0].style.backgroundImage = "url(" + path + ")";
    }
    rare_secttion(rare_item);
});



// Редкость

document.getElementsByName('items_rare')[0].addEventListener('change', function() {
    rare_secttion(this.value);
});



// Фильтр

if (document.getElementsByClassName('items-section-filter')[0]) {

    function filter(rare) {
        let items = document.getElementsByClassName('items-section-all')[0];
        for (let i = 0; i < items.childElementCount; i++) {
            items.children[i].style.display = 'flex';
            if (rare != '') {
                if (!items.children[i].children[0].children[0].classList.contains(rare)) {
                    items.children[i].style.display = 'none';
                }
            }
        }
    }

    function filter_active(item_filter) {
        for (let i = 0; i < document.getElementsByClassName('items-section-filter-item').length; i++) {
            document.getElementsByClassName('items-section-filter-item')[i].classList.remove('active_filter');
        }
        item_filter.classList.add('active_filter');
    }

    document.getElementsByClassName('items-section-filter-item')[0].addEventListener('click', function () {
        filter('');
        filter_active(this);
    });

    document.getElementsByClassName('items-section-filter-item')[1].addEventListener('click', function () {
        filter('star_1');
        filter_active(this);
    });

    document.getElementsByClassName('items-section-filter-item')[2].addEventListener('click', function () {
        filter('star_2');
        filter_active(this);
    });

    document.getElementsByClassName('items-section-filter-item')[3].addEventListener('click', function () {
        filter('star_3');
        filter_active(this);
    });

    document.getElementsByClassName('items-section-filter-item')[4].addEventListener('click', function () {
        filter('star_4');
        filter_active(this);
    });

    document.getElementsByClassName('items-section-filter-item')[5].addEventListener('click', function () {
        filter('star_5');
        filter_active(this);
    });

}