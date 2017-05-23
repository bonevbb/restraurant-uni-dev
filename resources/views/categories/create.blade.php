@extends('layouts.admin')

@section('loadCSS')

@endsection

@section('bodyStart')
    <body class="hold-transition skin-blue sidebar-mini">
    @endsection

    @section('adminContent')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Категории
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Кухня</a></li>
                    <li class="active">Категории</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{url('admin/categories')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="category-name">Име</label>
                                <input type="text" class="form-control" id="name"
                                       placeholder="Име на категория" name="category_name">
                                <small id="category-name" class="form-text text-muted">
                                    test test
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="category-description">Описание</label>
                                <textarea class="form-control" id="category-description" rows="3" name="category_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image-category" class="btn btn-primary" >Добавете снимка</label>
                                <input type="file" id="image-category" name="image_category" accept="image/*" style="display: none">
                                <div>
                                    <img id="image-preview" src="#" alt="category image" />
                                </div>
                            </div>
                            <div class="form-group">
                                <p style="font-weight: 700;">Видим</p>
                                <input type="checkbox" checked name="enable_category" id="on-off" data-toggle="toggle" data-on="Да" data-off="Не">
                            </div>
                            <div class="pull-right form-group">
                                <a href="{{url('admin/categories')}}" class="btn btn-default">Назад</a>
                                <button type="submit" class="btn btn-primary">Запази</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    @endsection

    @section('scripts')
        <script>
            $(document).on('ready',function () {
                $('#image-preview').hide();

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#image-preview').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);

                        $('#image-preview').show();
                    }
                }

                $("#image-category").change(function(){
                    readURL(this);
                });
            })
        </script>
    @endsection

    @section('bodyEnd')
    </body>
@endsection