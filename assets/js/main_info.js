// Скрытие и появление header

$(document).ready(function(){
    if($(window).width() < 951){
        $(".show").click(function(){
            $(".hide").css('display','flex');
            $(".show").css('display','none');
            $(".info").css('display','flex');
            $(".search").css('display','flex');
        });
    }
});

$(document).ready(function(){
    if($(window).width() < 951){
        $(".hide").click(function(){
            $(".show").css('display','flex');
            $(".hide").css('display','none');
            $(".info").css('display','none');
            $(".search").css('display','none');
        });
    }
});

$(document).ready(function(){
    if($(window).width() < 951){
        var scrol;
        var y=0;
        $(window).scroll(function(){
            var scrolled = $(window).scrollTop();
            if(scrolled>scrol){
                y++;
                if(y >= 2){
                    $("header").css('display','none');
                    $(".show").css('display','flex');
                    $(".hide").css('display','none');
                    $(".info").css('display','none');
                    $(".search").css('display','none');
                    y=0;
                }
            }else {
            $("header").css('display','flex');
            }
            scrol = scrolled;
        });
    }
});

window.addEventListener("load", function (){
    for(let i = 0; i < document.getElementsByClassName('gallery')[0].childElementCount; i++){
        document.getElementsByClassName('gallery')[0].children[i].addEventListener('click', function(){
            Dialog();
            image(i);
        });
    }

    for(let i = 0; i < document.getElementsByClassName('view-gallery')[0].childElementCount; i++){
        document.getElementsByClassName('view-gallery')[0].children[i].addEventListener('click', function(e){
            switchImage(e, i);
        });
    }
});

function Dialog() {
    document.getElementsByClassName('view-gallery')[0].classList.toggle("view-gallery-open");
}

function image(k) {
    for (let i = 0; i < document.getElementsByClassName('view-gallery')[0].childElementCount; i++) {
        document.getElementsByClassName('view-gallery')[0].children[i].classList.remove("open-image");
    }
    document.getElementsByClassName('image')[k].classList.add("open-image");
}

function switchImage(e, k) {
    let width = document.getElementsByClassName('image')[k].offsetWidth / 2;
    let x = e.clientX - document.getElementsByClassName('image')[k].offsetLeft;
    if (x < width) {
        k--;
        if (k < 0) {
            k = Number(document.getElementsByClassName('view-gallery')[0].childElementCount) - 1;
        }
    }
    else if (x > width) {
        k++;
        if (k > Number(document.getElementsByClassName('view-gallery')[0].childElementCount) - 1) {
            k = 0;
        }
    }
    image(k);
}

document.getElementsByClassName('view-gallery')[0].addEventListener('click', function (e) {
    if (e.target.childNodes.length) {
        Dialog();
    }
});