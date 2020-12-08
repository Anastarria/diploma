function createBook()
{

    window.document.getElementById('error').style.display = 'none';
    document.getElementById('loader').style.display = 'block';

    let title = window.document.getElementById('title').value;
    let author = window.document.getElementById('author').value;
    let genre = window.document.getElementById('genre').value;
    let description = window.document.getElementById('description').value;


    let http = new XMLHttpRequest();
    let url = '/books/create';
    let params = JSON.stringify({title: title, author: author, genre: genre, description: description});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Content-type', 'multipart/form-data');
    http.setRequestHeader('Accept', 'application/json');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 201) {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('success').style.display = 'block';
            window.location.href = '/';
        } else if (http.readyState === 4 && http.status > 399) {
            let response = JSON.parse(http.responseText);
            window.document.getElementById('error').innerHTML = http.status === 422 ? response.message : response.error;
            window.document.getElementById('error').style.display = 'block';
            document.getElementById('loader').style.display = 'none';

        }
    };
    http.send(params);
}
