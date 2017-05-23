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
                        <a class="btn btn-primary" href="{{url('admin/categories/create')}}">
                            <i class="fa fa-plus"></i> Добави</a>
                    </div>
                </div>
                <div class="row categories-table">
                    <div class="col-md-12">
                        @if(Session::has('success'))
                            <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::has('fail'))
                            <div class="alert alert-error fade in alert-dismissable" style="margin-top:18px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                {{Session::get('fail')}}
                            </div>
                        @endif
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Списък с категориите</h3>
                                <div class="box-tools">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <li>{{ $categories->links() }}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        {{--<th width="4%">--}}
                                        {{--<input type="checkbox"--}}
                                        {{--onclick="$('input[name*=\'delete\']').prop('checked', this.checked);">--}}
                                        {{--</th>--}}
                                        <th>Номер</th>
                                        <th>Име</th>
                                        <th>Описание</th>
                                        <th>Снимка</th>
                                        <th>Видим</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            {{--<td class="action">--}}
                                            {{--<input type="checkbox" value="id" name="delete"/>--}}
                                            {{--</td>--}}
                                            <td class="td-classic" width="4%">{{$category->id}}</td>
                                            <td class="td-classic">{{$category->name}}</td>
                                            <td style="vertical-align: middle;" width="40%">{{$category->description}}</td>
                                            <td class="td-classic" width="200px">
                                                @if($category->category_photo != null)
                                                    <img width="100%" src="{{asset($category->category_photo)}}">
                                                @else
                                                    <img class="img-responsive" src="{{asset('img/no-image.png')}}">
                                                @endif
                                            </td>
                                            @if($category->status)
                                                <td class="td-classic">Да</td>
                                            @else
                                                <td class="td-classic">Не</td>
                                            @endif
                                            <td class="td-classic">
                                                <a href="{{url('admin/categories/'.$category->id.'/edit')}}"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                                                <form class="form-buttons" action="categories/{{ $category->id }}"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Добавяне на категория</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category-name">Име</label>
                                <input type="text" class="form-control" id="category-name"
                                       placeholder="Име на артикула">
                                <small id="category-name" class="form-text text-muted">
                                    test test
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="category-description">Описание</label>
                                <textarea class="form-control" id="category-description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category-price">Цена</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="category-price" min="0">
                                    <span class="input-group-addon">лв.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select-category">Избери категория</label>
                                <select class="form-control" id="select-category">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category-qty">Количество</label>
                                <input type="number" class="form-control" id="category-qty" min="0">
                            </div>
                            <div class="form-group">
                                <p style="font-weight: 700;">Видим</p>
                                <input type="checkbox" id="on-off" data-toggle="toggle" data-on="Да" data-off="Не">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')

    @endsection

    @section('bodyEnd')
    </body>
@endsection