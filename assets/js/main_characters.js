// Скрытие и появление header

$(document).ready(function () {
    if ($(window).width() < 951) {
        $(".show").click(function () {
            $(".hide").css('display', 'flex');
            $(".show").css('display', 'none');
            $(".info").css('display', 'flex');
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

window.addEventListener("load", function (){
    for(let i = 0; i < document.getElementsByClassName('gallery-image')[0].childElementCount; i++){
        document.getElementsByClassName('gallery-image')[0].children[i].addEventListener('click', function(){
            Dialog();
            image(i);
        });
    }

    for(let i = 0; i < document.getElementsByClassName('view-gallery')[0].childElementCount; i++){
        document.getElementsByClassName('view-gallery')[0].children[i].addEventListener('click', function(e){
            switchImage(e, i);
        });
    }

    skills(0);
});

for(let i = 0; i < document.getElementsByClassName('skills-icon').length; i++){
    document.getElementsByClassName('skills-icon')[i].addEventListener('click', function(){
        skills(i);
    });
}

function skills(e){
    //Активный значок навыка
    for(let i = 0; i < document.getElementsByClassName('skills-icon').length; i++){
        if(document.getElementsByClassName('icon-character')[0].classList.contains('anemo')){
            document.getElementsByClassName('skills-icon')[i].classList.remove('skills-anemo');
        }
        else if(document.getElementsByClassName('icon-character')[0].classList.contains('geo')){
            document.getElementsByClassName('skills-icon')[i].classList.remove('skills-geo');
        }
        else if(document.getElementsByClassName('icon-character')[0].classList.contains('cryo')){
            document.getElementsByClassName('skills-icon')[i].classList.remove('skills-cryo');
        }
        else if(document.getElementsByClassName('icon-character')[0].classList.contains('pyro')){
            document.getElementsByClassName('skills-icon')[i].classList.remove('skills-pyro');
        }
        else if(document.getElementsByClassName('icon-character')[0].classList.contains('electro')){
            document.getElementsByClassName('skills-icon')[i].classList.remove('skills-electro');
        }
        else if(document.getElementsByClassName('icon-character')[0].classList.contains('hydro')){
            document.getElementsByClassName('skills-icon')[i].classList.remove('skills-hydro');
        }
        else if(document.getElementsByClassName('icon-character')[0].classList.contains('dendro')){
            document.getElementsByClassName('skills-icon')[i].classList.remove('skills-dendro');
        }
    }
    if(document.getElementsByClassName('icon-character')[0].classList.contains('anemo')){
        document.getElementsByClassName('skills-icon')[e].classList.add('skills-anemo');
    }
    else if(document.getElementsByClassName('icon-character')[0].classList.contains('geo')){
        document.getElementsByClassName('skills-icon')[e].classList.add('skills-geo');
    }
    else if(document.getElementsByClassName('icon-character')[0].classList.contains('cryo')){
        document.getElementsByClassName('skills-icon')[e].classList.add('skills-cryo');
    }
    else if(document.getElementsByClassName('icon-character')[0].classList.contains('pyro')){
        document.getElementsByClassName('skills-icon')[e].classList.add('skills-pyro');
    }
    else if(document.getElementsByClassName('icon-character')[0].classList.contains('electro')){
        document.getElementsByClassName('skills-icon')[e].classList.add('skills-electro');
    }
    else if(document.getElementsByClassName('icon-character')[0].classList.contains('hydro')){
        document.getElementsByClassName('skills-icon')[e].classList.add('skills-hydro');
    }
    else if(document.getElementsByClassName('icon-character')[0].classList.contains('dendro')){
        document.getElementsByClassName('skills-icon')[e].classList.add('skills-dendro');
    }

    //Активное описание навыка
    for(let i = 0; i < document.getElementsByClassName('skills-info-skill').length; i++){
        document.getElementsByClassName('skills-info-skill')[i].classList.remove('skill-active');
    }
    document.getElementsByClassName('skills-info-skill')[e].classList.add('skill-active');
}