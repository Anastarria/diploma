@extends('layout')
@section('content')
    <div class="container">
        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">Название книги</label>
                <input type="text" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Автор</label>
                <input type="text" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Жанр</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Фентези</option>
                    <option>Научная Фантастика</option>
                    <option>Детектив</option>
                    <option>Роман</option>
                    <option>Приключения</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Обложка</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Файл книги (разрешенные форматы:)</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">О книге</label>
                <textarea class="form-control" placeholder="Краткое описание" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </form>
    </div>


@endsection
