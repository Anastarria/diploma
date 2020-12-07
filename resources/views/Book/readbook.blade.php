
@extends('layout')
@section('content')
    <div class="container">
       <h3>Name Author</h3>
        <h5>Page Number</h5>
        <h5>Go to Page</h5>
    </div>
    <div class="container">
          <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h3>Soooo let's goooo</h3>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
{{--                                {{$book}}--}}


                                {{file_get_contents(resource_path('../storage/app/public/books/Mahanenko.txt'))}}

                            </div>


                        </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/bookmark.js') }}" ></script>
    @endpush
@endsection
