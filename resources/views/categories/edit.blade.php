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
                    Категория
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
                        <form action="{{url('admin/categories/'.$category->id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
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
                                <input type="text" class="form-control" id="name" name="category_name" value="{{$category->name}}">
                                <small id="category-name" class="form-text text-muted">
                                    test test
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="category-description">Описание</label>
                                <textarea class="form-control" id="category-description" rows="3" name="category_description">{{$category->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image-category" class="btn btn-primary" >Добавете нова снимка</label>
                                <input type="file" id="image-category" name="image_category" accept="image/*" style="display: none">
                                <div>
                                    @if($category->category_photo != null)
                                        <img id="image-preview-edit" src="{{asset($category->category_photo)}}" alt="category image" />
                                    @else
                                        <img id="image-preview-edit" src="{{asset('img/no-image.png')}}" alt="category image" />
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                <p style="font-weight: 700;">Видим</p>
                                @if($category->status)
                                <input type="checkbox" checked name="enable_category" id="on-off" data-toggle="toggle" data-on="Да" data-off="Не">
                                    @else
                                    <input type="checkbox" name="enable_category" id="on-off" data-toggle="toggle" data-on="Да" data-off="Не">
                                @endif
                            </div>
                            <div class="pull-right form-group">
                                <a href="{{url('admin/categories')}}" class="btn btn-default">Назад</a>
                                <button type="submit" class="btn btn-primary">Промени</button>
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

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#image-preview-edit').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
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