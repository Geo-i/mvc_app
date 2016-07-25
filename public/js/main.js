function showPreview() {

    var email = document.getElementById('email').value;
    var name = document.getElementById('name').value;
    var message = document.getElementById('message').value;
    var image = document.getElementById('image');

    if (!email || !message || !name) {
        alert('Поля Email, Имя и Сообщение обязательны для заполнения');
        return false;
    }

    var preview = document.querySelector('.preview_template');
    preview.className = 'well row preview_template';

    preview.querySelector('.email').innerHTML = email;
    preview.querySelector('.name').innerHTML = name;
    preview.querySelector('.message').innerHTML = message;
    if (image.files.length) {
        renderImage(image, preview.querySelector('.preview_image'));
    }

    return false;
}

function renderImage(imagefile, preview) //нагуглил и чуть изменил
{
    // HTML5 FileAPI: Firefox 3.6+, Chrome 6+
    if (typeof(FileReader) != 'undefined') {
        var reader = new FileReader();
        reader.onload = function (e) {
            preview.style.backgroundImage = 'url(' + e.target.result + ')';
        }
        reader.readAsDataURL(imagefile.files.item(0));
    }
    // Firefox 3.0-3.6
    else if (imagefile.files && imagefile.files.item(0).getAsDataURL) {
        preview.style.backgroundImage = 'url(' + imagefile.files.item(0).getAsDataURL() + ')';
    }
    // HTML4 browsers
    else {
        // ajax file upload here
    }
}
