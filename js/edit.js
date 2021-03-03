// DOM
const select = document.querySelector('select');
const img = document.querySelector('#tar_img');

function all_remove() {

    img.classList.remove('sepia');
    img.classList.remove('brightness');
    img.classList.remove('contrast');
    img.classList.remove('blur');
    img.classList.remove('grayscale');
    img.classList.remove('hue-rotate');
    img.classList.remove('invert');

}

function filter_select() {

    all_remove();

    switch (select.value) {

        case 'sepia':
            img.classList.add('sepia');
            break;
        
        case 'brightness':
            img.classList.add('brightness');
            break;

        case 'contrast':
            img.classList.add('contrast');
            break;

        case 'blur':
            img.classList.add('blur');
            break;

        case 'grayscale':
            img.classList.add('grayscale');
            break;

        case 'hue-rotate':
            img.classList.add('hue-rotate');
            break;

        case 'invert':
            img.classList.add('invert');
            break;

    }

}

select.addEventListener('change', filter_select);