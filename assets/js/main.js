// Скрытие и появление header

$(document).ready(function () {
    if ($(window).width() < 951) {
        $(".show").click(function () {
            $(".hide").css('display', 'flex');
            $(".show").css('display', 'none');
            $(".title_filter").css('display', 'flex');
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
            $(".title_filter").css('display', 'none');
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
                    $(".title_filter").css('display', 'none');
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



// Получение и вывод персонажей

function data() {
    let elements = [];
    let rare = null;
    for (let i = 0; i < document.getElementsByClassName("elements")[0].childElementCount; i += 2) {
        if (document.getElementsByClassName("elements")[0].children[i].checked) {
            elements[elements.length] = document.getElementsByClassName("elements")[0].children[i].value;
        }
    }
    for (let i = 0; i < document.getElementsByClassName("rare_section")[0].childElementCount; i += 2) {
        if (document.getElementsByClassName("rare_section")[0].children[i].checked) {
            rare = document.getElementsByClassName("rare_section")[0].children[i].value;
        }
    }

    $.ajax({
        method: "POST",
        url: "vendor/componets/get_data.php",
        data: { elements: elements, rare: rare },
        success: function (characters) {
            let character = JSON.parse(characters);
            let character_info = "";
            if (character.length != 0) {
                for (let i = 0; i < character.length; i++) {
                    character_info += `<div class="character ${character[i].element}">
                        <a href="vendor/characters/characters.php?name_en=${character[i].name_en}">
                            <img src="assets/image/characters/${character[i].name_en}/${character[i].name_en}.png" alt="#">
                        </a>
                        <a class="name" href="vendor/characters/characters.php?name_en=${character[i].name_en}">${character[i].name_ru}</a>
                        <div class="star">${character_rare(character[i].rare)}</div>
                        <div class="items">
                            <img src="${character[i].weapon}" alt="#" class="weapon">
                            <div class="item_element">
                                <img src="assets/image/elements/${character[i].element}.png" alt="#">
                            </div>
                        </div>
                    </div>`
                }
            }
            $(".content").html(character_info);
            document.getElementsByClassName("filter_block")[0].classList.remove("filter_block_open");
        }
    });
    elements = null;
    rare = null;
}

function character_rare(e) {
    let rare = "";
    for (let j = 0; j < e; j++) {
        rare += '<img src="assets/image/imgElem/levelStar.png" alt="#">'
    }
    return rare;
}

$(document).ready(function () {
    $('.filter').submit(function (e) {
        e.preventDefault();
        save_filter();
        data();
    });
});



// Визуализация редкости персонажа

function rare_display(e) {
    for (let i = 0; i < 5; i++) {
        if (i <= e) {
            document.getElementsByClassName("rare-image")[i].style.filter = "none";
        }
        else {
            document.getElementsByClassName("rare-image")[i].style.filter = "grayscale(100%)";
        }
    }
}

for(let i = 0; i < document.getElementsByClassName('rare-image').length; i++){
    document.getElementsByClassName('rare-image')[i].addEventListener('click', function () {
        rare_display(i);
    })
}



// Сброс фильтра до сохранённого при закрытии фильтра

function filter() {

    let elements = [];
    if (sessionStorage.getItem('elements') != null) {
        elements = JSON.parse(sessionStorage.getItem('elements'));
        for (let i = 0; i < elements.length; i++) {
            document.getElementsByClassName("elements")[0].children[elements[i]].checked = true;
        }
    }


    let rare = null;
    if (sessionStorage.getItem('rare') != null) {
        rare = JSON.parse(sessionStorage.getItem('rare'));
        for (let i = 0; i < document.getElementsByClassName("rare_section")[0].childElementCount; i += 2) {
            if (i <= rare && rare !== null) {
                document.getElementsByClassName("rare_section")[0].children[i + 1].style.filter = "none";
            }
            else {
                document.getElementsByClassName("rare_section")[0].children[i + 1].style.filter = "grayscale(100%)";
            }
        }
        if (rare !== null) {
            document.getElementsByClassName("rare_section")[0].children[rare].checked = true;
        }
    }
}



// Открытие и закрытие фильтра

document.getElementsByClassName("title_filter")[0].addEventListener("click", displayFilter);

document.getElementsByClassName("close_filter")[0].addEventListener("click", function () {
    displayFilter();
    document.getElementById("filter").reset();
    for (let i = 0; i < 5; i++) {
        document.getElementsByClassName("rare-image")[i].style.filter = "grayscale(100%)";
    }
    filter();
});

function displayFilter() {
    document.getElementsByClassName("filter_block")[0].classList.toggle("filter_block_open");
}



// Сохранение фильтра

function save_filter() {

    let elements = [];
    for (let i = 0; i < document.getElementsByClassName("elements")[0].childElementCount; i += 2) {
        if (document.getElementsByClassName("elements")[0].children[i].checked) {
            elements[elements.length] = i;
        }
    }
    sessionStorage.setItem('elements', JSON.stringify(elements));
    elements = null;

    let rare = null;
    for (let i = 0; i < document.getElementsByClassName("rare_section")[0].childElementCount; i += 2) {
        if (document.getElementsByClassName("rare_section")[0].children[i].checked) {
            rare = i;
        }
    }
    sessionStorage.setItem('rare', JSON.stringify(rare));
    rare = null;
}


window.addEventListener("load", function () {
    filter();

    // Появление карточек после обновления страницы
    data();
});



// Удаление фильтра

document.getElementsByClassName("reset_filter")[0].addEventListener("click", () => {
    sessionStorage.clear();

    for (let i = 0; i < 5; i++) {
        document.getElementsByClassName("rare-image")[i].style.filter = "grayscale(100%)";
    }

    for (let i = 0; i < document.getElementsByClassName("elements")[0].childElementCount; i += 2) {
        if (document.getElementsByClassName("elements")[0].children[i].checked) {
            document.getElementsByClassName("elements")[0].children[i].checked = false;
        }
    }

    for (let i = 0; i < document.getElementsByClassName("rare_section")[0].childElementCount; i += 2) {
        if (document.getElementsByClassName("rare_section")[0].children[i].checked) {
            document.getElementsByClassName("rare_section")[0].children[i].checked = false;
        }
    }

    data();
});



// Сохранение карточек до обновления страницы

window.addEventListener('unload', function () {
    sessionStorage.clear();
});