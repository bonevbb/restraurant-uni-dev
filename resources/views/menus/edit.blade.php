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
                    Менюта
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Кухня</a></li>
                    <li class="active">Менюта</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{url('admin/menus/'.$menus->id)}}" method="post">
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
                                <label for="menu-name">Име</label>
                                <input type="text" class="form-control" id="name" name="menu_name" value="{{$menus->menu_name}}">
                                <small id="menu-name" class="form-text text-muted">
                                    test test
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="menu-description">Описание</label>
                                <textarea class="form-control" id="menu-description" rows="3" name="menu_description">{{$menus->menu_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="menu-price">Цена</label>
                                <div class="input-group">
                                    <input type="number" name="menu_price" class="form-control" id="menu-price" min="0" value="{{$menus->menu_price}}">
                                    <span class="input-group-addon">лв.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select-category">Избери категория</label>
                                <select class="form-control" id="select-category" name="id_category">
                                    <option disabled>...</option>
                                    @foreach($categories as $category)
                                        @if($menus->id_menu_category == $category->id_category)
                                            <option selected value="{{$category->id_category}}">{{$category->name}}</option>
                                            @else
                                            <option value="{{$category->id_category}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="menu-qty">Количество</label>
                                <input type="number" class="form-control" id="menu-qty" name="menu_qty" min="0" value="{{$menus->stock_qty}}">
                            </div>
                            <div class="form-group">
                                <p style="font-weight: 700;">Видим</p>
                                @if($menus->menu_status)
                                <input type="checkbox" checked name="enable_menu" id="on-off" data-toggle="toggle" data-on="Да" data-off="Не">
                                    @else
                                    <input type="checkbox" name="enable_menu" id="on-off" data-toggle="toggle" data-on="Да" data-off="Не">
                                @endif
                            </div>
                            <div class="pull-right form-group">
                                <a href="{{url('admin/menus')}}" class="btn btn-default">Назад</a>
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

    @endsection

    @section('bodyEnd')
    </body>
@endsection