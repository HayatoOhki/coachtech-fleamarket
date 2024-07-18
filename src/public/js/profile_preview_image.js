document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("file__upload-button").addEventListener("click", function () {
        document.getElementById("file__upload-input").click();
    });

    document.getElementById("file__upload-input").addEventListener("change", function () {
        loadImage(this);
    });
});

function loadImage(input) {
    if (!input.files.length) {
        document.getElementById("file__upload-input").value = "";
        return;
    }
    if (document.getElementById("file__upload-image")) {
        document.getElementById("file__upload-image").parentNode.removeChild(document.getElementById("file__upload-image"));
    }
    let fileReader = new FileReader();
    fileReader.onload = function (e) {
        let field = document.getElementById("form__input-image_preview");
        let img = new Image();
        img.src = e.target.result;
        img.setAttribute("id", "file__upload-image");
        field.appendChild(img);
    };
    fileReader.readAsDataURL(input.files[0]);
}