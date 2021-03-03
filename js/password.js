const show = document.getElementById('passwordCheck');
const pass = document.getElementById('password');

show.addEventListener('change', () => {
    if (show.checked){
        pass.setAttribute('type', 'text');
    } else {
        pass.setAttribute('type', 'password');
    }
}, false);