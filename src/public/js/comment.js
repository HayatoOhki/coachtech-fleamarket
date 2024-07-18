const deleteBtns = document.getElementsByClassName("comment__delete--button");

for (let i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener("click", function () {
        var checked = window.confirm("コメントを削除します。よろしいですか？");
        if (!checked) {
            event.preventDefault();
        }
    });
};
