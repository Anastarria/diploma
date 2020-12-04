function registering()
{

    window.document.getElementById('error').style.display = 'none';
    document.getElementById('loader').style.display = 'block';

    let email = window.document.getElementById('email').value;
    let name = window.document.getElementById('name').value;
    let nickname = window.document.getElementById('nickname').value;
    let password = window.document.getElementById('password').value;

    let http = new XMLHttpRequest();
    let url = '/register';
    let params = JSON.stringify({email: email, name: name, nickname: nickname, password: password});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 201) {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('success').style.display = 'block';
            window.location.href = '/checkemail';
        } else if (http.readyState === 4 && http.status > 399) {
            let response = JSON.parse(http.responseText);
            window.document.getElementById('error').innerHTML = http.status === 422 ? response.message : response.error;
            window.document.getElementById('error').style.display = 'block';
            document.getElementById('loader').style.display = 'none';

        }
    };
    http.send(params);
}

function login()
{

    window.document.getElementById('error').style.display = 'none';
    document.getElementById('loader').style.display = 'block';
    let email = window.document.getElementById('email').value;
    let password = window.document.getElementById('password').value;

    let http = new XMLHttpRequest();
    let url = '/login';
    let params = JSON.stringify({email: email, password: password});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('success').style.display = 'block';
            window.location.href = '/';
        } else if (http.readyState === 4 && http.status > 399) {
            let response = JSON.parse(http.responseText);
            let errorMessage = http.status === 422 ? response.message : response.error;
            window.document.getElementById('error').innerHTML = errorMessage;
            window.document.getElementById('error').style.display = 'block';
            document.getElementById('loader').style.display = 'none';
        }
    };
    http.send(params);
}
