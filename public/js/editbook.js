function showEditTitle()
{
    document.getElementById('changeName').style.display= 'block';
    document.getElementById('showName').style.display= 'none';
}
function hideEditTitle()
{
    document.getElementById('changeName').style.display= 'none';
    document.getElementById('showName').style.display= 'block';
}
function showEditAuthor()
{
    document.getElementById('changeAuthor').style.display= 'block';
    document.getElementById('showAuthor').style.display= 'none';
}
function hideEditAuthor()
{
    document.getElementById('changeAuthor').style.display= 'none';
    document.getElementById('showAuthor').style.display= 'block';
}
function showEditGenre()
{
    document.getElementById('changeGenre').style.display= 'block';
    document.getElementById('showGenre').style.display= 'none';
}
function hideEditGenre()
{
    document.getElementById('changeGenre').style.display= 'none';
    document.getElementById('showGenre').style.display= 'block';
}
function showEditDescription()
{
    document.getElementById('changeDescription').style.display= 'block';
    document.getElementById('showDescription').style.display= 'none';
}
function hideEditDescription()
{
    document.getElementById('changeDescription').style.display= 'none';
    document.getElementById('showDescription').style.display= 'block';
}

function editBookTitle()
{
    let title = window.document.getElementById('title').value;
    let edit_url = window.document.getElementById('edit_id').value;

    let http = new XMLHttpRequest();
    let url = edit_url;
    let params = JSON.stringify({title: title});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    if (title.length < 6){
        const errorNotification = window.createNotification({
            theme: 'warning',
            showDuration: 10000
        });
        errorNotification({
            message: 'Название должно содержать как минимум 6 символов'
        });
        return;
    }
    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Название книги изменено'
            });
            window.location.href = edit_url;
        } else if (http.readyState === 4 && http.status > 399) {

            const errorNotification = window.createNotification({
                theme: 'error',
                showDuration: 10000
            });
            errorNotification({
                message: 'Упс! Что-то пошло не так!\n'
            });
        }
    };
    http.send(params);
}

function editBookAuthor()
{
    let author = window.document.getElementById('author').value;
    let edit_url = window.document.getElementById('edit_id').value;

    let http = new XMLHttpRequest();
    let url = edit_url;
    let params = JSON.stringify({author: author});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    if (author.length < 6){
        const errorNotification = window.createNotification({
            theme: 'warning',
            showDuration: 10000
        });
        errorNotification({
            message: 'Имя автора должно содержать как минимум 6 символов'
        });
        return;
    }
    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Имя автора изменено'
            });
            window.location.href = edit_url;
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

function editBookGenre()
{
    let genre = window.document.getElementById('genre').value;
    let edit_url = window.document.getElementById('edit_id').value;

    let http = new XMLHttpRequest();
    let url = edit_url;
    let params = JSON.stringify({genre: genre});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Сохранения изменены'
            });
            window.location.href = edit_url;
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

function editBookDescription()
{
    let description = window.document.getElementById('description').value;
    let edit_url = window.document.getElementById('edit_id').value;

    let http = new XMLHttpRequest();
    let url = edit_url;
    let params = JSON.stringify({description: description});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    if (description.length < 50){
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
        if(http.readyState === 4 && http.status === 200) {
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Описание книги изменено'
            });
            window.location.href = edit_url;
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
