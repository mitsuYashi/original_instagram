// // DOM
const serch = document.querySelector('input');
let serch_val;

function serchJump() {

    // 検索欄を取得
    const serch = document.querySelector('input');
    document.querySelector('#innerSerch').innerHTML = '';

    // 検索欄が空の場合トップページへ
    if (serch.value == '') {
        window.location.href = 'index.php';
    } else {
        document.querySelector('#innerSerch').innerHTML = '';
        document.querySelector('main').classList.add('serch');
    }

    // パラメータの指定
    let params = new URLSearchParams();
    serch_val = serch.value;
    params.append('input_val', serch_val);

    axios.post('./api/auth/serch_request.php', params).then(response => {

        response.data.forEach(element => {
            document.querySelector('#innerSerch').insertAdjacentHTML('beforeend',`<a href="profile.php?id=${element.id}" class="prf"><div class="prf_img cir"><img src="images/visual_picture/${element.icon_path}"><div class="flex"><span>${element.name}</span><span>@${element.user_id}</span></div></div></a>`);
        });

    }).catch(error => {
        // エラーを受け取る
        console.log(error);
    });
}

serch.addEventListener('keyup',serchJump);