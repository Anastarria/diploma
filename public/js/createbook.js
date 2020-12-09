function createBook()
{
    let title = window.document.getElementById('title').value;
    let author = window.document.getElementById('author').value;
    let genre = window.document.getElementById('genre').value;
    let description = window.document.getElementById('description').value;
    let path_to_book = window.document.getElementById('path_to_book').value;
    let cover = window.document.getElementById('cover').value;

    let http = new XMLHttpRequest();
    let url = '/books/create';
    let params = JSON.stringify({title: title, author: author, genre: genre, description: description, path_to_book: path_to_book, cover: cover});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Content-type', 'multipart/form-data');
    http.setRequestHeader('Accept', 'application/json');

    if (author.length < 6){
        const errorNotification = window.createNotification({
            theme: 'info',
            showDuration: 10000
        });
        errorNotification({
            message: 'Имя автора должно содержать как минимум 6 символов'
        });
        return;
    }

    if (title.length < 3){
        const errorNotification = window.createNotification({
            theme: 'info',
            showDuration: 10000
        });
        errorNotification({
            message: 'Название должно содержать как минимум 6 символов'
        });
        return;
    }

    if (description.length <= 50){
        const errorNotification = window.createNotification({
            theme: 'info',
            showDuration: 10000
        });
        errorNotification({
            message: 'Подумайте над чуть более детальным описанием, не менее 50 символов'
        });
        return;
    }

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 201) {
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Книга добавлена'
            });
            window.location.href = '/';
        } else if (http.readyState === 4 && http.status > 399) {
            const errorNotification = window.createNotification({
                theme: 'error',
                showDuration: 10000
            });
            errorNotification({
                message: 'Упс! Что-то пошло не так!'
            });
        }
    };
    http.send(params);
}
