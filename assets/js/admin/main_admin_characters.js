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



// Фильтр

var rare = '';
var element = '';

function filter(){
    let characters = document.getElementsByClassName('characters-all-section')[0];
    for(let i = 0; i < characters.childElementCount; i++){
        if(rare != '' && element != ''){
            if(characters.children[i].classList.contains(element) && characters.children[i].children[3].value == rare){
                characters.children[i].style.display = 'flex';
            }
            else{
                characters.children[i].style.display = 'none';
            }
        }
        else if(rare == '' && element != ''){
            if(characters.children[i].classList.contains(element)){
                characters.children[i].style.display = 'flex';
            }
            else{
                characters.children[i].style.display = 'none';
            }
        }
        else if(rare != '' && element == ''){
            if(characters.children[i].children[3].value == rare){
                characters.children[i].style.display = 'flex';
            }
            else{
                characters.children[i].style.display = 'none';
            }
        }
        else{
            characters.children[i].style.display = 'flex';
        }
    }
}

function filter_active_rare(rare_filter){
    for(let i = 0; i < document.getElementsByClassName('characters-all-filter-rare-item-text').length; i++){
        document.getElementsByClassName('characters-all-filter-rare-item-text')[i].classList.remove('active-filter-rare');
    }
    rare_filter.parentElement.children[1].classList.add('active-filter-rare');
}

function filter_active_element(element_filter){
    for(let i = 0; i < document.getElementsByClassName('characters-all-filter-element-item-image').length; i++){
        document.getElementsByClassName('characters-all-filter-element-item-image')[i].classList.remove('active-filter-element');
    }
    element_filter.parentElement.children[1].classList.add('active-filter-element');
}

for(let i = 0; i < document.getElementsByClassName('characters-all-filter-rare-item').length; i++){
    document.getElementsByClassName('characters-all-filter-rare-item-value')[i].addEventListener('change', function(){
        rare = this.value;
        filter();
        filter_active_rare(this);
    });
}

for(let i = 0; i < document.getElementsByClassName('characters-all-filter-element-item').length; i++){
    document.getElementsByClassName('characters-all-filter-element-item-value')[i].addEventListener('change', function(){
        element = this.value;
        filter();
        filter_active_element(this);
    });
}