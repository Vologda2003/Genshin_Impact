// Переменные

var choice_artifacts = [];
var choice_weapons = [];



function escape_text(text) { 
    var map = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'};
    return text.replace(/[&<>"']/g, function(m) {
        return map[m];
    });
}



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



// Сообщение

var timer;
var timer_delete;

function delete_message() {
    clearTimeout(timer);
    clearTimeout(timer_delete);
    document.getElementsByClassName('message')[0].classList.remove('message-open');
    timer = setTimeout(() => {
        document.getElementsByClassName('message')[0].innerHTML = null;
    }, 500);
}

function message(select) {
    delete_message();
    setTimeout(() => {
        document.getElementsByClassName('message')[0].innerHTML = select;
        document.getElementsByClassName('message')[0].classList.add('message-open');
        timer_delete = setTimeout(() => {
            delete_message();
        }, 1000 * 10);
        document.getElementsByClassName('message')[0].addEventListener('click', function () {
            delete_message();
        });
    }, 500);
}



// Фокус input[type="file"]

window.onload = function () {
    for (let i = 0; i < document.querySelectorAll('input[type="file"').length; i++) {
        document.querySelectorAll('input[type="file"')[i].addEventListener('focus', function () {
            this.parentElement.style.outline = '-webkit-focus-ring-color auto 1px';
        });
        document.querySelectorAll('input[type="file"')[i].addEventListener('blur', function () {
            this.parentElement.style.outline = 'none';
        });
    }
}



// Получение и вывод картинок баннера

document.getElementsByClassName('banner-header-icon-image')[0].addEventListener('change', function () {
    if (document.getElementsByClassName('banner-header-icon-image')[0].files.length !== 0) {
        document.getElementsByClassName('banner-header-icon')[0].style.backgroundImage = "url(" + URL.createObjectURL(document.getElementsByClassName('banner-header-icon-image')[0].files[0]) + ")";
    }
    else {
        document.getElementsByClassName('banner-header-icon')[0].style.backgroundImage = "none";
    }
});

document.getElementsByClassName('banner-header-map-icon-image')[0].addEventListener('change', function () {
    if (document.getElementsByClassName('banner-header-map-icon-image')[0].files.length !== 0) {
        document.getElementsByClassName('banner-header-map-icon')[0].style.backgroundImage = "url(" + URL.createObjectURL(document.getElementsByClassName('banner-header-map-icon-image')[0].files[0]) + ")";
    }
    else {
        document.getElementsByClassName('banner-header-map-icon')[0].style.backgroundImage = "none";
    }
});

document.getElementsByClassName('banner-header-element-value')[0].addEventListener('change', function () {
    if (this.value == '') {
        document.getElementsByClassName('bgImage')[0].style.backgroundImage = "url(../../assets/image/imgElem/none.jpg)";
    } else {
        document.getElementsByClassName('bgImage')[0].style.backgroundImage = "url(../../assets/image/imgElem/" + this.value + ".jpg)";
    }
});

document.getElementsByClassName('banner-header-rare-value')[0].addEventListener('change', function () {
    if (this.value == '') {
        document.getElementsByClassName('banner-header-icon-head')[0].classList.remove('star_4');
        document.getElementsByClassName('banner-header-icon-head')[0].classList.remove('star_5');
    }
    if (this.value == 'star_4') {
        document.getElementsByClassName('banner-header-icon-head')[0].classList.add('star_4');
        document.getElementsByClassName('banner-header-icon-head')[0].classList.remove('star_5');
    }
    if (this.value == 'star_5') {
        document.getElementsByClassName('banner-header-icon-head')[0].classList.remove('star_4');
        document.getElementsByClassName('banner-header-icon-head')[0].classList.add('star_5');
    }
});

document.getElementsByClassName('banner-header-class-value')[0].addEventListener('change', function () {
    for (let i = 0; i < document.getElementsByClassName('recommendations-section-choice-weapons-items-section')[0].childElementCount; i++) {
        if (this.value != '') {
            if (this.value.indexOf(document.getElementsByClassName('recommendations-section-choice-weapons-items-section')[0].children[i].children[2].value)) {
                document.getElementsByClassName('recommendations-section-choice-weapons-items-section')[0].children[i].classList.add('hide-weapons');
            }
            else {
                document.getElementsByClassName('recommendations-section-choice-weapons-items-section')[0].children[i].classList.remove('hide-weapons');
            }
        }
        else {
            document.getElementsByClassName('recommendations-section-choice-weapons-items-section')[0].children[i].classList.remove('hide-weapons');
        }
    }
});



// Получение и вывод картинок галереи

let gallery = document.getElementsByClassName('gallery-icon-image')[0];
let gallery_image = '';

function delete_image_gallery_last(image) {
    image.remove();
}

for (let i = 0; i < document.getElementsByClassName('gallery-images-last-image').length; i++) {
    document.getElementsByClassName('gallery-images-last-image')[i].addEventListener('dblclick', function () {
        delete_image_gallery_last(this);
    });
}

function delete_image_gallery(image) {
    let dt = new DataTransfer();
    for (let i = 0; i < gallery.files.length; i++) {
        if (i !== Array.from(document.getElementsByClassName('gallery-images-image')).indexOf(image)) {
            dt.items.add(gallery.files[i]);
        }
    }
    image.remove();
    gallery.files = dt.files;
}

function add_functional_image() {
    for (let i = 0; i < document.getElementsByClassName('gallery-images-image').length; i++) {
        document.getElementsByClassName('gallery-images-image')[i].addEventListener('dblclick', function () {
            delete_image_gallery(this);
        });
    }
}

gallery.addEventListener('change', function () {
    document.getElementsByClassName('gallery-images-section')[0].innerHTML = null;
    if (gallery.files.length !== 0) {
        for (let i = 0; i < gallery.files.length; i++) {
            gallery_image += '<img src="' + URL.createObjectURL(gallery.files[i]) + '" alt="#" class="gallery-images-image">';
        }
        document.getElementsByClassName('gallery-images-section')[0].insertAdjacentHTML('beforeend', gallery_image);
        gallery_image = '';
        add_functional_image();
    }
});



// Навыки

function delete_skill(skill) {
    if (document.getElementsByClassName('skills-section')[0].childElementCount == 1) {
        skill.parentElement.remove();
    }
    else {
        for (let i = 0; i < document.getElementsByClassName('skills-section')[0].childElementCount; i += 2) {
            if (document.getElementsByClassName('skills-section')[0].children[i] == skill.parentElement && i == 0) {
                document.getElementsByClassName('skills-section')[0].children[++i].remove();
                skill.parentElement.remove();
            }
            else if (document.getElementsByClassName('skills-section')[0].children[i] == skill.parentElement && i > 0) {
                document.getElementsByClassName('skills-section')[0].children[--i].remove();
                skill.parentElement.remove();
            }
        }
    }
}

function add_functional_skill(skill) {
    var active_description_skills = null;


    skill.children[1].children[0].children[1].addEventListener('change', function () {
        if (this.files.length !== 0) {
            this.parentElement.style.backgroundImage = "url(" + URL.createObjectURL(this.files[0]) + ")";
        }
        else {
            this.parentElement.style.backgroundImage = "none";
        }
    });


    skill.children[2].children[1].children[1].children[0].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description_skills) {
            document.execCommand('insertUnorderedList', false, null);
        }
    });

    skill.children[2].children[1].children[1].children[1].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description_skills) {
            document.execCommand('bold', false, null);
        }
    });

    skill.children[2].children[1].children[1].children[2].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description_skills) {
            document.execCommand('italic', false, null);
        }
    });

    skill.children[2].children[1].children[1].children[3].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description_skills) {
            document.execCommand('insertHTML', false, '<div><br></div>');
        }
    });

    // skill.children[2].children[1].children[0].onkeydown = function(e) {
    //     if(e.keyCode == 13){
    //         document.execCommand('defaultParagraphSeparator', false, 'p');
    //     }
    // }

    skill.children[2].children[1].children[0].addEventListener('input', function () {
        if (this.innerHTML.length == 0) {
            document.execCommand('insertHTML', false, '<div><br></div>');
        }
    });


    skill.children[2].children[1].children[0].addEventListener('focus', function () {
        skill.children[2].children[1].style.outline = '-webkit-focus-ring-color auto 1px';
        active_description_skills = this;
    });

    skill.children[2].children[1].children[0].addEventListener('blur', function () {
        skill.children[2].children[1].style.outline = 'none';
    });

    skill.children[2].children[1].children[1].addEventListener('click', function () {
        this.parentElement.children[0].focus();
    });


    skill.children[3].addEventListener('click', function () {
        delete_skill(this);
    });
    
    skill.children[2].children[1].children[0].addEventListener("paste", function(e){
        e.preventDefault();
        var text = (e.originalEvent || e).clipboardData.getData('text/plain');
        document.execCommand('insertHtml', false, escape_text(text));
    });
}

function create_skill(title) {
    let skills_section = document.createElement('div');
    skills_section.classList.add('skills-section-skill');
    if (title != 'пассивный талант') {
        skills_section.insertAdjacentHTML('beforeend', `<span class="skills-section-title">${title.charAt(0).toUpperCase() + title.slice(1)}</span>
                                    <div class="skills-section-head">
                                        <div class="skills-section-head-image">+
                                            <input type="hidden" name="path_icon_skills[]" value="">
                                            <input type="file" name="icon_skills[]" class="skills-section-head-image-icon" required>
                                        </div>
                                        <div class="skills-section-head-sectionName">
                                            <div class="skills-section-head-sectionName-row">
                                                <span class="skills-section-head-sectionName-row-title">Название:</span>
                                                <input type="text" name="name_skills" class="skills-section-head-sectionName-row-name" required>
                                            </div>
                                        </div>
                                    </div>`);
    }
    else {
        skills_section.insertAdjacentHTML('beforeend', `<span class="skills-section-title">${title.charAt(0).toUpperCase() + title.slice(1)}</span>
                                    <div class="skills-section-head">
                                        <div class="skills-section-head-image">+
                                            <input type="hidden" name="path_icon_skills[]" value="">
                                            <input type="file" name="icon_skills" class="skills-section-head-image-icon" required>
                                        </div>
                                        <div class="skills-section-head-sectionName">
                                            <div class="skills-section-head-sectionName-row">
                                                <span class="skills-section-head-sectionName-row-title">Название:</span>
                                                <input type="text" name="name_skills" class="skills-section-head-sectionName-row-name" required>
                                            </div>
                                            <div class="skills-section-head-sectionName-row">
                                                <span class="skills-section-head-sectionName-row-title">Открытие:</span>
                                                <select name="passive_skills" class="skills-section-head-sectionName-row-openSkills" required>
                                                    <option value="">Выберите</option>
                                                    <option value="разблокируется на 1 уровне возвышения">разблокируется на 1 уровне возвышения</option>
                                                    <option value="разблокируется на 4 уровне возвышения">разблокируется на 4 уровне возвышения</option>
                                                    <option value="разблокируется автоматически">разблокируется автоматически</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>`);
    }

    skills_section.insertAdjacentHTML('beforeend', `<div class="skills-section-description">
                                    <span class="skills-section-description-title">Описание</span>
                                    <div class="skills-section-description-section">
                                        <div class="skills-section-description-section-text" contentEditable="true">
                                            <div>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="skills-section-description-section-button">
                                            <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="skills-section-description-section-button-item">
                                            <img src="../../assets/image/imgElem/bold.svg" alt="#" class="skills-section-description-section-button-item">
                                            <img src="../../assets/image/imgElem/italic.svg" alt="#" class="skills-section-description-section-button-item">
                                            <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="skills-section-description-section-button-item">
                                        </div>
                                    </div>
                                </div>
                                <span class="skills-section-skill-close">X</span>`);

    if (document.getElementsByClassName('skills-section')[0].childElementCount == 0) {
        document.getElementsByClassName('skills-section')[0].appendChild(skills_section);
    }
    else {
        document.getElementsByClassName('skills-section')[0].insertAdjacentHTML('beforeend', `<div class="skills-section-line"></div>`);
        document.getElementsByClassName('skills-section')[0].appendChild(skills_section);
    }
    skills_section.scrollIntoView(false);
    add_functional_skill(skills_section);
    open_choice_skills();
}

function open_choice_skills() {
    document.getElementsByClassName('section-choice-skills')[0].classList.toggle('open-choice-skills');
}

document.getElementsByClassName('skills-button')[0].addEventListener('click', function () {
    open_choice_skills();
});

document.getElementsByClassName('section-choice-skills-button')[0].addEventListener('click', function () {
    open_choice_skills();
});

for (let i = 0; i < document.getElementsByClassName('section-choice-skills-skill-item').length; i++) {
    document.getElementsByClassName('section-choice-skills-skill-item')[i].addEventListener('click', function () {
        create_skill(this.innerText);
    });
}

for (let i = 0; i < document.getElementsByClassName('skills-section-skill').length; i++) {
    add_functional_skill(document.getElementsByClassName('skills-section-skill')[i]);
}



// Выбор материалов возвышения персонажа

var active_item_choice = null;

function dysplay_choice_items() {
    document.getElementsByClassName('section-choice-items')[0].classList.toggle('open-section-choice-items');
}

function delete_image_item() {
    if (active_item_choice.childElementCount == 3) {
        active_item_choice.children[0].remove();
    }
    active_item_choice.children[1].value = null;
    active_item_choice = null;
}

function put_image_item(e) {
    if (active_item_choice.childElementCount == 3) {
        active_item_choice.children[0].remove();
    }
    active_item_choice.children[1].value = e.children[0].src;
    let image = document.createElement('img');
    image.src = e.children[0].src;
    image.alt = '#';
    image.classList.add('item-count-image');
    active_item_choice.prepend(image);
    active_item_choice = null;
}

document.getElementsByClassName('section-choice-items-button')[0].addEventListener('click', function () {
    dysplay_choice_items();
    active_item_choice = null;
});

for (let i = 0; i < document.getElementsByClassName('item-count').length; i++) {
    document.getElementsByClassName('item-count')[i].addEventListener('click', function () {
        dysplay_choice_items();
        active_item_choice = this;
    });
}

for (let i = 0; i < document.getElementsByClassName('section-choice-items-images')[0].childElementCount; i++) {
    document.getElementsByClassName('section-choice-items-images-image')[i].addEventListener('click', function () {
        if (i === 0) {
            delete_image_item();
            dysplay_choice_items();
        }
        else {
            put_image_item(this);
            dysplay_choice_items();
        }
    });
}



// Созвездия

for (let i = 0; i < document.getElementsByClassName('constellation-section-head-image-icon').length; i++) {
    document.getElementsByClassName('constellation-section-head-image-icon')[i].addEventListener('change', function () {
        if (this.files.length !== 0) {
            this.parentElement.style.backgroundImage = "url(" + URL.createObjectURL(this.files[0]) + ")";
        }
        else {
            this.parentElement.style.backgroundImage = "none";
        }
    });
}

for (let i = 0; i < 6; i++) {
    let description = document.getElementsByClassName('constellation-section-description-section')[i];
    var active_description = null;

    description.children[1].children[0].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description) {
            document.execCommand('insertUnorderedList', false, null);
        }
    });

    description.children[1].children[1].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description) {
            document.execCommand('bold', false, null);
        }
    });

    description.children[1].children[2].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description) {
            document.execCommand('italic', false, null);
        }
    });

    description.children[1].children[3].addEventListener('click', function () {
        if (this.parentElement.parentElement.children[0] == active_description) {
            document.execCommand('insertHTML', false, '<div><br></div>');
        }
    });

    // description.children[0].onkeydown = function(e) {
    //     if(e.keyCode == 13){
    //         document.execCommand('defaultParagraphSeparator', false, 'p');
    //     }
    // }

    description.children[0].addEventListener('input', function () {
        if (this.innerHTML.length == 0) {
            document.execCommand('insertHTML', false, '<div><br></div>');
        }
    });


    description.children[0].addEventListener('focus', function () {
        description.style.outline = '-webkit-focus-ring-color auto 1px';
        active_description = this;
    });

    description.children[0].addEventListener('blur', function () {
        description.style.outline = 'none';
    });

    description.children[1].addEventListener('click', function () {
        this.parentElement.children[0].focus();
    });
    
    description.children[0].addEventListener("paste", function(e){
        e.preventDefault();
        var text = (e.originalEvent || e).clipboardData.getData('text/plain');
        document.execCommand('insertHtml', false, escape_text(text));
    });
}



// Выбор артефактов

var active_type_choice = null;

function dysplay_type_choice() {
    document.getElementsByClassName('recommendations-section-choice-artifacts-type')[0].classList.toggle('open-type-choice-artifacts');
}

function delete_type_choice(e) {
    e.parentElement.remove();
}

function create_type_choice(e) {
    dysplay_type_choice();
    if (e == 1) {
        document.getElementsByClassName('recommendations-section-artifacts')[0].insertAdjacentHTML('beforeend', `<div class="recommendations-section-artifacts-type">
                                                                                                <span class="recommendations-section-artifacts-type-image-delete" onclick="delete_type_choice(this)">X</span>
                                                                                                <div class="recommendations-section-artifacts-type-image" onclick="display_choice_artifacts(this)">
                                                                                                    <input type="hidden" name="id_artifacts[]" value="">
                                                                                                    <div class="recommendations-section-artifacts-type-image-add">+</div>
                                                                                                    <span class="recommendations-section-artifacts-type-image-count">4</span>
                                                                                                </div>
                                                                                            </div>`);
    }
    else {
        document.getElementsByClassName('recommendations-section-artifacts')[0].insertAdjacentHTML('beforeend', `<div class="recommendations-section-artifacts-type">
                                                                                                <span class="recommendations-section-artifacts-type-image-delete" onclick="delete_type_choice(this)">X</span>
                                                                                                <div class="recommendations-section-artifacts-type-image" onclick="display_choice_artifacts(this)">
                                                                                                    <input type="hidden" name="id_artifacts[]" value="">
                                                                                                    <div class="recommendations-section-artifacts-type-image-add">+</div>
                                                                                                    <span class="recommendations-section-artifacts-type-image-count">2</span>
                                                                                                </div>
                                                                                                <div class="recommendations-section-artifacts-type-image" onclick="display_choice_artifacts(this)">
                                                                                                    <input type="hidden" name="id_artifacts[]" value="">
                                                                                                    <div class="recommendations-section-artifacts-type-image-add">+</div>
                                                                                                    <span class="recommendations-section-artifacts-type-image-count">2</span>
                                                                                                </div>
                                                                                            </div>`);
    }
}

function display_choice_artifacts(e) {
    document.getElementsByClassName('recommendations-section-choice-artifacts-items')[0].classList.toggle('open-choice-artifacts');
    active_type_choice = e;
}

function put_image_choice_artifacts(e) {
    if (active_type_choice.childElementCount == 4) {
        active_type_choice.children[3].remove();
    }
    active_type_choice.insertAdjacentHTML('beforeend', `<img src="${e.children[2].src}" alt="#" class="recommendations-section-artifacts-type-image-icon ${e.children[0].value}">`);
    active_type_choice.children[0].value = e.children[1].value;
    document.getElementsByClassName('recommendations-section-choice-artifacts-items')[0].classList.remove('open-choice-artifacts');
    active_type_choice = null;
}

document.getElementsByClassName('recommendations-section-choice-artifacts-type-value')[0].addEventListener('click', function () {
    create_type_choice(2);
});

document.getElementsByClassName('recommendations-section-choice-artifacts-type-value')[1].addEventListener('click', function () {
    create_type_choice(1);
});

document.getElementsByClassName('recommendations-section-choice-artifacts-items-button')[0].addEventListener('click', function () {
    document.getElementsByClassName('recommendations-section-choice-artifacts-items')[0].classList.remove('open-choice-artifacts');
    active_type_choice = null;
});

document.getElementsByClassName('recommendations-section-choice-artifacts-button')[0].addEventListener('click', function () {
    dysplay_type_choice();
});

for (let i = 0; i < document.getElementsByClassName('recommendations-section-choice-artifacts-items-section')[0].childElementCount; i++) {
    document.getElementsByClassName('recommendations-section-choice-artifacts-items-item')[i].addEventListener('click', function () {
        put_image_choice_artifacts(this);
    });
}



// Выбор оружия

function display_choice_weapons() {
    document.getElementsByClassName('recommendations-section-choice-weapons-items')[0].classList.toggle('open-choice-weapons');
}

function output_choice_weapons(e) {
    if (e.children[4].checked) {
        document.getElementsByClassName('recommendations-section-weapons')[0].insertAdjacentHTML('beforeend', `<div class="recommendations-section-weapons-item">
                                                                                                <img src="${e.children[3].src}" alt="#" class="recommendations-section-weapons-item-image ${e.children[1].value}">
                                                                                                <span class="recommendations-section-weapons-item-name">${e.children[0].value}</span>
                                                                                            </div>`);
        choice_weapons.push(Number(e.children[4].value));
    } else {
        for (let i = 0; i < document.getElementsByClassName('recommendations-section-weapons')[0].childElementCount; i++) {
            if (document.getElementsByClassName('recommendations-section-weapons-item')[i].children[1].innerHTML == e.children[0].value) {
                document.getElementsByClassName('recommendations-section-weapons-item')[i].remove();
                choice_weapons.splice(choice_weapons.indexOf(Number(e.children[4].value)), 1);
            }
        }
    }
}

function acrive_weapons(e) {
    e.parentElement.classList.toggle('active-choice-weapons');
}

document.getElementsByClassName('recommendations-section-choice-weapons-button')[0].addEventListener('click', function () {
    display_choice_weapons();
});

document.getElementsByClassName('recommendations-section-choice-weapons-items-button')[0].addEventListener('click', function () {
    display_choice_weapons();
});

for (let i = 0; i < document.getElementsByClassName('recommendations-section-choice-weapons-items-section')[0].childElementCount; i++) {
    document.getElementsByClassName('recommendations-section-choice-weapons-items-item-input')[i].addEventListener('change', function () {
        acrive_weapons(this);
        output_choice_weapons(this.parentElement);
    });

    if(document.getElementsByClassName('recommendations-section-choice-weapons-items-item-input')[i].checked){
        output_choice_weapons(document.getElementsByClassName('recommendations-section-choice-weapons-items-item-input')[i].parentElement);
    }
}





// Отправка данных на сервер

var control_data = true;

function structure_gallery_image(){
    let images = [];

    if(document.getElementsByClassName('gallery-images-last-section')[0].childElementCount != 0){
        for(let i = 0; i < document.getElementsByClassName('gallery-images-last-section')[0].childElementCount; i++){
            images.push(`assets/image/characters/${document.getElementsByName('name_en')[0].value}/${document.getElementsByClassName('gallery-images-last-section')[0].children[i].src.split('/').pop()}`);
        }
    }
    else{
        images = JSON.parse(document.getElementsByName('gallery_image_last')[0].value);
    }

    return JSON.stringify(images);
}

function skills_constellation_info_type(section) {
    let type_info = section.innerHTML.replace(/\n/g, '').replace(/\s{2,}/g, '');
    let structure_type_info = [];

    if (!type_info.includes("<i>")) {
        if (!type_info.includes("<b>") && !type_info.includes("<ul>")) {
            structure_type_info.push(0);
            if (type_info != "<br>") {
                structure_type_info.push(type_info.split("<br>"));
            }
            else {
                structure_type_info.push([]);
            }
        }

        if (type_info.includes("<b>") && !type_info.includes("<ul>")) {
            structure_type_info.push(1);
            structure_type_info.push(section.children[0].innerText);
            structure_type_info.push(type_info.slice(type_info.indexOf("</b>") + 8).split("<br>"));
        }

        else if (type_info.includes("<b>") && type_info.includes("<ul>")) {
            structure_type_info.push(2);
            structure_type_info.push(section.children[0].innerText);
            let structure_type_info_ul_li = [];
            for (let i = 0; i < section.children[2].childElementCount; i++) {
                structure_type_info_ul_li.push(section.children[2].children[i].textContent);
            }
            structure_type_info.push(structure_type_info_ul_li);
        }

        else if (!type_info.includes("<b>") && type_info.includes("<ul>")) {
            structure_type_info.push(3);
            let structure_type_info_ul_li = [];
            for (let i = 0; i < section.children[0].childElementCount; i++) {
                structure_type_info_ul_li.push(section.children[0].children[i].textContent);
            }
            structure_type_info.push(structure_type_info_ul_li);
        }
    }

    return structure_type_info;
}

function structure_skills_info() {
    let skills_info = [];
    for (let i = 0; i < document.getElementsByClassName('skills-section-skill').length; i++) {
        let skills_info_skill = [];

        if (document.getElementsByClassName('skills-section-skill')[i].children[0].innerText == 'Обычная атака') {
            skills_info_skill.push([document.getElementsByClassName('skills-section-head-sectionName-row-name')[i].value]);
        }
        else if (document.getElementsByClassName('skills-section-skill')[i].children[0].innerText == 'Элементальный навык' || document.getElementsByClassName('skills-section-skill')[i].children[0].innerText == 'Взрыв стихии' || document.getElementsByClassName('skills-section-skill')[i].children[0].innerText == 'Другое') {
            skills_info_skill.push([document.getElementsByClassName('skills-section-head-sectionName-row-name')[i].value, document.getElementsByClassName('skills-section-skill')[i].children[0].innerText.toLowerCase()]);
        }
        else if (document.getElementsByClassName('skills-section-skill')[i].children[0].innerText == 'Пассивный талант') {
            skills_info_skill.push([document.getElementsByClassName('skills-section-head-sectionName-row-name')[i].value, document.getElementsByClassName('skills-section-skill')[i].children[0].innerText.toLowerCase(), document.getElementsByClassName('skills-section-skill')[i].children[1].children[1].children[1].children[1].value]);
        }

        let skill_info_type = [];
        for (let j = 0; j < document.getElementsByClassName('skills-section-description-section-text')[i].childElementCount; j++) {
            let info_type = skills_constellation_info_type(document.getElementsByClassName('skills-section-description-section-text')[i].children[j]);
            if (info_type.length) {
                skill_info_type.push(info_type);
            }
        }
        skills_info_skill.push(skill_info_type);

        if (document.getElementsByClassName('skills-section-description-section-text')[i].children[document.getElementsByClassName('skills-section-description-section-text')[i].childElementCount - 1].innerHTML.replace(/\s{2,}/g, '').includes("<i>")) {
            skills_info_skill.push(document.getElementsByClassName('skills-section-description-section-text')[i].children[document.getElementsByClassName('skills-section-description-section-text')[i].childElementCount - 1].innerText);
        }

        skills_info.push(skills_info_skill);
    }
    return JSON.stringify(skills_info);
}

function structure_constellation_info() {
    let constellation_info = [];
    for (let i = 0; i < document.getElementsByClassName('constellation-section').length; i++) {
        let constellation_info_skill = [];

        if (document.getElementsByClassName('constellation-section-head-image-icon')[i].files.length !== 0) {
            constellation_info_skill.push(`assets/image/characters/${document.getElementsByName('name_en')[0].value}/Constellation/${document.getElementsByClassName('constellation-section-head-image-icon')[i].files[0].name}`);
        }
        else {
            constellation_info_skill.push(document.getElementsByName('icon_constellation_path[]')[i].value);
        }

        constellation_info_skill.push(document.getElementsByClassName('constellation-section-head-sectionName-name')[i].value);

        let constellation_info_skill_text = [];
        for (let j = 0; j < document.getElementsByClassName('constellation-section-description-section-text')[i].childElementCount; j++) {
            let info_type = skills_constellation_info_type(document.getElementsByClassName('constellation-section-description-section-text')[i].children[j]);
            if (info_type.length) {
                constellation_info_skill_text.push(info_type);
            }
        }
        constellation_info_skill.push(constellation_info_skill_text);

        constellation_info.push(constellation_info_skill);
    }
    return JSON.stringify(constellation_info);
}

function structure_items_character() {
    let items_level_character = [];
    for (let i = 0; i < document.getElementsByClassName('item-character-section')[0].childElementCount; i += 2) {
        let items_level = [Number(document.getElementsByClassName('item-character-section')[0].children[i].children[0].innerText)];
        let items_level_item = [];
        for (let j = 0; j < document.getElementsByClassName('item-character-section')[0].children[i].children[1].childElementCount; j++) {
            if (document.getElementsByClassName('item-character-section')[0].children[i].children[1].children[j].childElementCount === 2) {
                items_level_item.push([Number(document.getElementsByClassName('item-character-section')[0].children[i].children[1].children[j].children[0].innerText), '']);
            }
            else {
                items_level_item.push([Number(document.getElementsByClassName('item-character-section')[0].children[i].children[1].children[j].children[1].innerText), `assets/image/items/${document.getElementsByClassName('item-character-section')[0].children[i].children[1].children[j].children[2].value.split('/').pop()}`]);
            }
        }
        items_level.push(items_level_item);
        items_level_character.push(items_level);
    }
    return JSON.stringify(items_level_character);
}

function structure_items_skills() {
    let items_level_skills = [];
    for (let i = 0; i < document.getElementsByClassName('item-character-section')[1].childElementCount; i += 2) {
        let items_level = [Number(document.getElementsByClassName('item-character-section')[1].children[i].children[0].innerText)];
        let items_level_item = [];
        for (let j = 0; j < document.getElementsByClassName('item-character-section')[1].children[i].children[1].childElementCount; j++) {
            if (document.getElementsByClassName('item-character-section')[1].children[i].children[1].children[j].childElementCount === 2) {
                items_level_item.push([Number(document.getElementsByClassName('item-character-section')[1].children[i].children[1].children[j].children[0].innerText), '']);
            }
            else {
                items_level_item.push([Number(document.getElementsByClassName('item-character-section')[1].children[i].children[1].children[j].children[1].innerText), `assets/image/items/${document.getElementsByClassName('item-character-section')[1].children[i].children[1].children[j].children[2].value.split('/').pop()}`]);
            }
        }
        items_level.push(items_level_item);

        items_level_skills.push(items_level);
    }
    return JSON.stringify(items_level_skills);
}

function structure_recommendation_artifacts() {
    choice_artifacts = [];
    control_data = true;
    for (let i = 0; i < document.getElementsByClassName('recommendations-section-artifacts')[0].childElementCount; i++) {
        if (document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].childElementCount === 2) {
            if (document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[1].children[0].value !== '') {
                choice_artifacts.push([4, Number(document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[1].children[0].value), Number(document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[1].children[0].value)]);
            }
            else {
                control_data = false;
                message('артефакты');
            }
        }
        else if (document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].childElementCount === 3) {
            if (document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[1].children[0].value !== '' && document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[2].children[0].value !== '' && document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[1].children[0].value != document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[2].children[0].value) {
                choice_artifacts.push([2, Number(document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[1].children[0].value), Number(document.getElementsByClassName('recommendations-section-artifacts')[0].children[i].children[2].children[0].value)]);
            }
            else {
                control_data = false;
                message('артефакты');
            }
        }
    }
}

document.getElementsByClassName('content-form')[0].addEventListener('submit', function (e) {
    e.preventDefault();

    if(document.getElementsByClassName('gallery-images-last-section')[0].childElementCount === 0 && document.getElementsByClassName('gallery-icon-image')[0].files.length === 0){
        message('Галерея пустая! Прошлые картинки будут внесены в галерею!');
    }

    structure_recommendation_artifacts();

    // Структурирование данных

    var formData = new FormData();

    // Заполнение данными

    formData.append('save_update_button', document.getElementsByName('save_button')[0]); //Кнопка

    formData.append('id', document.getElementsByName('id')[0].value); // id персонажа
    
    formData.append('icon', document.getElementsByName('icon')[0].files[0]); //Значок
    formData.append('icon_path', document.getElementsByName('icon_path')[0].value); //Прошлый значок

    formData.append('name_ru', document.getElementsByName('name_ru')[0].value); //Название на анг. яз.
    formData.append('name_en', document.getElementsByName('name_en')[0].value); //Название на рус. яз.
    formData.append('weapon', document.getElementsByName('character_class')[0].value); //Класс
    formData.append('element', document.getElementsByName('character_element')[0].value); //Элемент
    formData.append('rare_character', document.getElementsByName('character_rare')[0].value); //Редкость
    formData.append('region', document.getElementsByName('character_region')[0].value); //Регион
    formData.append('description', document.getElementsByName('character_description')[0].value); //Описание

    formData.append('map', document.getElementsByName('map')[0].files[0]); //Именная карта
    formData.append('map', document.getElementsByName('map_path')[0].value); //Прошлая именная карта

    for (let i = 0; i < document.getElementsByName('gallery[]')[0].files.length; i++) { //Галерея
        formData.append('gallery[]', document.getElementsByName('gallery[]')[0].files[i]);
    }
    formData.append('gallery_last', structure_gallery_image()); //Картинки прошлой галереи
    formData.append('gallery_images_last', document.getElementsByName('gallery_image_last')[0].value) //Все картинки прошлой галереи

    for (let i = 0; i < document.getElementsByName('icon_skills[]').length; i++) { //Значки навыков
        if(document.getElementsByName('icon_skills[]')[i].files.length !== 0){
            formData.append('number_icon[]', i);
            formData.append('skills_icon_delete[]', document.getElementsByName('path_icon_skills[]')[i].value);
            formData.append('skills_icon[]', document.getElementsByName('icon_skills[]')[i].files[0]);
        }
        formData.append('path_icon_skills[]', document.getElementsByName('path_icon_skills[]')[i].value);
    }
    formData.append('skills_info', structure_skills_info()); //Название и описание навыков

    formData.append('item_character', structure_items_character()); //Выбор предметов персонажа
    formData.append('item_skills', structure_items_skills()); //Выбор предметов навыков

    for (let i = 0; i < document.getElementsByName('icon_constellation[]').length; i++) { //Значки созвездий
        if(document.getElementsByName('icon_constellation[]')[i].files.length !== 0){ 
            formData.append('constellation_icon_delete[]', document.getElementsByName('icon_constellation_path[]')[i].value);
            formData.append('constellation_icon[]', document.getElementsByName('icon_constellation[]')[i].files[0]);
        }
    }
    formData.append('constellation', structure_constellation_info()); //Название и описание созвездий

    formData.append('recommendation_artifacts', JSON.stringify(choice_artifacts)); //Выбор артефактов
    formData.append('recommendation_weapons', JSON.stringify(choice_weapons)); //Выбор оружия

    // Отправка данных
    
    if (control_data) {
        $.ajax({
            method: "POST",
            url: "main_admin.php",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (filesUpdate) {
                if(filesUpdate != 'Успешно'){
                    message(filesUpdate);
                }
                else{
                    window.location.href = "admin_characters.php";
                }
            }
        });
    }
});