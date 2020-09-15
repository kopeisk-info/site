@extends('template')

@section('script')

@endsection

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <h1 class="h2">Добавление новой новости</h1>
            <form action="{{ route('news.store') }}" enctype="multipart/form-data" method="post">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Название новости</label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3">
                            <label for="date" class="form-label">Дата публикации</label>
                            <input type="datetime-local" class="form-control" name="date_at" id="date">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <div class="form-file">
                                <input type="file" class="form-file-input" name="image" id="image">
                                <label class="form-file-label" for="image">
                                    <span class="form-file-text"></span>
                                    <span class="form-file-button">Browse</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Текст новости</label>
                    <textarea class="form-control ckeditor" name="text" id="text"></textarea>
                </div>
                <div class="mb-3">
                    <label for="source_link" class="form-label">Ссылка на источник</label>
                    <input type="text" class="form-control" name="source_link" id="source_link">
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3">
                            <label for="church" class="form-label">Церковь</label>
                            <select class="form-select" name="church_id" id="church" aria-label="Выберите церковь">
                                <option selected value="0">Не указана</option>
                                @foreach($churches as $church)
                                    <option value="{{ $church->id }}">{{ $church->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3">
                            <label for="minister" class="form-label">Духовное лицо</label>
                            <select class="form-select" name="minister_id" id="minister" aria-label="Выберите духовное лицо">
                                <option selected value="0">Не указано</option>
                                @foreach($ministers as $minister)
                                    <option value="{{ $minister->id }}">{{ $minister->first_name }} {{ $minister->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Добавить новость</button>
            </form>
        </div>
    </div>
    <script>
        document.querySelector('.form-file-input').addEventListener('change',function(e) {
            var fileName = document.getElementById("image").files[0].name
            var nextSibling = e.target.nextElementSibling.firstChild.nextElementSibling
            nextSibling.innerText = fileName
        })
    </script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@endsection
