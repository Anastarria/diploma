@extends('layout')
@section('content')
    <div class="container">

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h3>Создание книги. Добавление обложки и файла книги</h3>
                            </div>

                        <form enctype="multipart/form-data" method="post" action="/books/create/{{$title}}">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="exampleFormControlFile1">Обложка (разрешенные форматы: jpeg, png)</label>
                                <input type="file" accept="image/jpeg,image/png" class="form-control-file" id="cover" name="cover" required>
                            </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label for="exampleFormControlFile1">Файл книги (разрешенные форматы: txt, doc, docx)</label>
                                    <input type="file" accept="text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword" class="form-control-file" id="path_to_book" name="path_to_book" required>
                                </div>
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Готово!</button>
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
