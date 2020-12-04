function addBookmark()
{
    document.getElementById('removeBookmark').style.display = 'block';
    document.getElementById('addBookmark').style.display = 'none';
    
    let book_id = window.document.getElementById('book_id').value;
    let user_id = window.document.getElementById('user_id').value;

    let http = new XMLHttpRequest();
    let url = '/books/bookmark/add';
    let params = JSON.stringify({book_id: book_id, user_id: user_id});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');



    const successNotification = window.createNotification({
        theme: 'success',
        showDuration: 5000
    });

    successNotification({
        message: 'Книга добавлена в закладки'
    });



    http.send(params);
}

function removeBookmark()
{
    document.getElementById('addBookmark').style.display = 'block';
    document.getElementById('removeBookmark').style.display = 'none';

    let book_id = window.document.getElementById('book_id').value;
    let user_id = window.document.getElementById('user_id').value;

    let http = new XMLHttpRequest();
    let url = '/books/bookmark/remove';
    let params = JSON.stringify({book_id: book_id, user_id: user_id});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');



    const successNotification = window.createNotification({
        theme: 'success',
        showDuration: 5000
    });

    successNotification({
        message: 'Книга удалена из закладок'
    });



    http.send(params);
}
