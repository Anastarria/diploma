function showEditName()
{
    document.getElementById('changeName').style.display= 'block';
    document.getElementById('showName').style.display= 'none';

}

function hideEditName()
{
    document.getElementById('changeName').style.display= 'none';
    document.getElementById('showName').style.display= 'block';
}

function showEditEmail()
{
    document.getElementById('showEmail').style.display= 'none';
    document.getElementById('changeEmail').style.display= 'block';
}

function hideEditEmail()
{
    document.getElementById('showEmail').style.display= 'block';
    document.getElementById('changeEmail').style.display= 'none';
}

function showEditPassword()
{
    document.getElementById('showHiddenPassword').style.display= 'none';
    document.getElementById('changePassword').style.display= 'block';
}

function hideEditPassword()
{
    document.getElementById('showHiddenPassword').style.display= 'block';
    document.getElementById('changePassword').style.display= 'none';
}

function editProfileName()
{
    window.document.getElementById('error').style.display = 'none';
    document.getElementById('loader').style.display = 'block';

    let name = window.document.getElementById('name').value;

    let http = new XMLHttpRequest();
    let url = '/profile/edit';
    let params = JSON.stringify({name: name});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            document.getElementById('loader').style.display = 'none';

            window.location.href = '/profile/edit';
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Имя пользователя успешно изменено'
            });
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

function editProfilePassword()
{
    window.document.getElementById('error').style.display = 'none';
    document.getElementById('loader').style.display = 'block';

    let password = window.document.getElementById('password').value;

    let format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if (!format.test(password)){
        window.document.getElementById('error').innerHTML = "Пароль не соответствует требованиям! Убедитесь что ваш пароль содержит: буквы верхнего и нижнего регистра, цифры, специальные символы";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }

    let http = new XMLHttpRequest();
    let url = '/profile/edit';
    let params = JSON.stringify({password: password});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            document.getElementById('loader').style.display = 'none';

            window.location.href = '/profile/edit';
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Пароль успешно изменен'
            });
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
