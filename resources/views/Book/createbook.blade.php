@extends('layout')
@section('content')
    <div class="container">
        <div id="loader" style="display: none">Processing...</div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form enctype="multipart/form-data">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h3>Book info</h3>
                            </div>
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="exampleFormControlInput1">Название книги</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="exampleFormControlInput1">Автор</label>
                                <input type="text" class="form-control" name="author" id="author" required>
                            </div>
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="exampleFormControlSelect1">Жанр</label>
                                <select class="form-control" id="genre" name="genre">
                                    <option>Фентези</option>
                                    <option>Научная Фантастика</option>
                                    <option>Детектив</option>
                                    <option>Роман</option>
                                    <option>Приключения</option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="exampleFormControlFile1">Обложка (разрешенные форматы: jpeg, png)</label>
                                <input type="file" accept="image/jpeg,image/png" class="form-control-file" id="cover" name="cover" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="exampleFormControlFile1">Файл книги (разрешенные форматы: txt, doc, docx)</label>
                                <input type="file" accept="text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword" class="form-control-file" id="path_to_book" name="path_to_book" required>
                            </div>

                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="exampleFormControlTextarea1">О книге</label>
                                <textarea class="form-control" name="description" id="description" rows="6"></textarea>
                            </div>
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="submit" name="submit" class="btn btn-primary" onclick="return createBook()">Добавить книгу</button>
                                </div>
                            </div>
                        </div>
                      </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/createbook.js') }}" ></script>
    @endpush

@endsection
