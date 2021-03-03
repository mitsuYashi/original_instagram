// DOM
let input_val = 0;
  
const add_posts_sql = () => {
    
    // DOM
    const post_img = document.getElementsByClassName('post_img');
    const post_img_length = document.getElementsByClassName('post_img').length - 1;
    
    // 一番下までスクロールした時の数値を取得(window.innerHeight分(画面表示領域分)はスクロールをしないため引く)
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // ブラウザ間の差異をカバーする
    // ページ全体の高さを取得する
    const scrollHeight = Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight
    );

    const pageMostBottom = scrollHeight - window.innerHeight;

    let loader = document.getElementsByClassName('loader');
    let flg = 0;
    
    if (loader.length == 0) {
        // iosはバウンドするので、無難に `>=` にする
        if (scrollTop + 5 >= pageMostBottom) {
            
            // 読み込み用CSS
            post_img[post_img_length].insertAdjacentHTML('afterend','<div class="loader">Loading...</div>');
            loader = document.getElementsByClassName('loader');

            input_val = input_val + 6;
            let params = new URLSearchParams();
            params.append('input_val', input_val);

            // phpファイルにデータを送信し、受け取る
            axios.post('./api/auth/api.php', params).then(response => {
                
                let index = 0
                // データを全て表示
                response.data.forEach((element, i) => {
                    index = i;

                    const post_img = document.getElementsByClassName('post_img');
                    const post_img_length = document.getElementsByClassName('post_img').length - 1;

                    post_img[post_img_length].insertAdjacentHTML('afterend',`<div class="post_img"><div class="prf_img cir"><a href="profile.php?id=${element.id}"><img src="images/visual_picture/${element.icon_path}"><span>@${element.user_id}</span></a></div><div class="img"><a href="picture.php?id=${element.post_id}"><div class="img_pic"><img src="images/picture/${element.picture_path}" alt="${element.picture_path}" class="${element.filter}"></div></a></div></div>`);
                    
                });

                if (index < 5) {
                    flg = 1;
                    window.removeEventListener("scroll", add_posts_sql);
                }
                loader[0].remove();

            }).catch(error => {
                // エラーを受け取る
                console.log(error);
            });
        }
    }
}
window.addEventListener('scroll', add_posts_sql);