const MAX_PREVIEW_FILES = 5; // 最大プレビュー数の設定

let key = 0; // 画像、削除ボタンリンク用
let rmCount = 0; // 削除数
let fileCount = 0; // アップロードされたファイル数

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("file__upload-button").addEventListener("click", function () {
        document.getElementById("file__upload-input").click();
    });

    document.getElementById("file__upload-input").addEventListener("change", function () {
        loadImage(this);
    });
});

function loadImage(input) {
    // プレビュー数が上限を超える場合は処理を中止する
    if (fileCount + input.files.length > MAX_PREVIEW_FILES) {
        alert(`最大で${MAX_PREVIEW_FILES}枚までしか選択できません。`);
        // ファイル選択をリセットする
        document.getElementById("file__upload-input").value = "";
        return;
    }

    for (let i = 0; i < input.files.length; i++) {
        let fileReader = new FileReader();
        fileReader.onload = function (e) {
            key++;
            fileCount = key - rmCount;
            let field = document.getElementById("form__input-image_field");
            let figure = document.createElement("figure");
            let rmBtn = document.createElement("button");
            let img = new Image();
            img.src = e.target.result;
            img.classList.add("file__upload-image");
            rmBtn.classList.add("file__upload-rmbutton");
            rmBtn.type = "button";
            rmBtn.name = key;
            rmBtn.textContent = "✕";
            rmBtn.onclick = function () {
                document.getElementById("img-" + rmBtn.name).remove();
                rmCount++;
                fileCount = key - rmCount;
            };
            figure.setAttribute("id", "img-" + key);
            figure.appendChild(img);
            figure.appendChild(rmBtn);
            field.appendChild(figure);
        };
        fileReader.readAsDataURL(input.files[i]);
    }
}