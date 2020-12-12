function registering()
{

    window.document.getElementById('error').style.display = 'none';
    document.getElementById('loader').style.display = 'block';

    let email = window.document.getElementById('email').value;
    let name = window.document.getElementById('name').value;
    let nickname = window.document.getElementById('nickname').value;
    let password = window.document.getElementById('password').value;

    function emailIsValid (email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }
    if (!emailIsValid(email)){
        window.document.getElementById('error').innerHTML = "Формат email адреса неверный. Проверьте правильно ли указан адрес. Также в поле с адресом не должно быть пробелов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }
    if (nickname.length < 6){
        window.document.getElementById('error').innerHTML = "Длина юзернейма должна составлять не менее 6 символов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }
    if (name.length < 3){
        window.document.getElementById('error').innerHTML = "В поле Имя должно быть не менее 3 символов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }
    if (password.length < 8){
        window.document.getElementById('error').innerHTML = "Пароль должен состоять минимум из 8 символов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }

    let format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if (!format.test(password)){
        window.document.getElementById('error').innerHTML = "Пароль не соответствует требованиям! Убедитесь что ваш пароль содержит: буквы верхнего и нижнего регистра, цифры, специальные символы";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }


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

    function emailIsValid (email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }
    if (!emailIsValid(email)){
        window.document.getElementById('error').innerHTML = "Формат email адреса неверный. Проверьте правильно ли указан адрес. Также в поле с адресом не должно быть пробелов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }

    if (password.length < 8){
        window.document.getElementById('error').innerHTML = "Пароль должен состоять минимум из 8 символов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }

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

function resetPassword()
{
    document.getElementById('loader').style.display = 'block';
    let email = window.document.getElementById('email').value;

    function emailIsValid (email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }
    if (!emailIsValid(email)){
        window.document.getElementById('error').innerHTML = "Формат email адреса неверный. Проверьте правильно ли указан адрес. Также в поле с адресом не должно быть пробелов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }

    let http = new XMLHttpRequest();
    let url = '/password_reset';
    let params = JSON.stringify({email: email});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            document.getElementById('loader').style.display = 'none';
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Письмо отправлено. Проверьте свой почтовый ящик.'
            });

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
function resetConfirmation()
{
    document.getElementById('loader').style.display = 'block';
    let email = window.document.getElementById('email').value;
    let password = window.document.getElementById('password').value;

    let http = new XMLHttpRequest();
    let url = '/reset_confirmation';
    let params = JSON.stringify({email: email, password: password});
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/json');
    http.setRequestHeader('Accept', 'application/json');

    if (password.length < 8){
        window.document.getElementById('error').innerHTML = "Пароль должен состоять минимум из 8 символов.";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }

    let format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if (!format.test(password)){
        window.document.getElementById('error').innerHTML = "Пароль не соответствует требованиям! Убедитесь что ваш пароль содержит: буквы верхнего и нижнего регистра, цифры, специальные символы";
        window.document.getElementById('error').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
        return;
    }

    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            document.getElementById('loader').style.display = 'none';
            const successNotification = window.createNotification({
                theme: 'success',
                showDuration: 10000
            });
            successNotification({
                message: 'Пароль успешно изменен'
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
