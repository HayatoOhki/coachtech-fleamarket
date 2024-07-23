// detail.blade.php コメント削除
const commentDeleteBtns = document.getElementsByClassName("comment__delete--button");

for (let i = 0; i < commentDeleteBtns.length; i++) {
    commentDeleteBtns[i].addEventListener("click", function (event) {
        if (!confirm("コメントを削除します。よろしいですか？")) {
            event.preventDefault();
        }
    });
};

// user.blade.php ユーザー削除
const userDeleteBtns = document.getElementsByClassName("user__delete--button");

for (let i = 0; i < userDeleteBtns.length; i++) {
    userDeleteBtns[i].addEventListener("click", function (event) {
        if (!confirm("ユーザーを削除します。よろしいですか？")) {
            event.preventDefault();
        }
    });
};