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
                        <a class="btn btn-primary" href="{{url('admin/menus/create')}}">
                            <i class="fa fa-plus"></i> Добави</a>
                    </div>
                </div>
                <div class="row menus-table">
                    <div class="col-md-12">
                        @if(Session::has('success'))
                            <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                {{Session::get('success')}}
                            </div>
                        @endif
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Списък с менютата</h3>
                                <div class="box-tools">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <li>{{ $menus->links() }}</li>
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
                                        <th>Снимка</th>
                                        <th>Име</th>
                                        <th>Цена</th>
                                        <th>Категория</th>
                                        <th>Количество</th>
                                        <th>Видим</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menus as $menu)
                                        <tr>
                                            {{--<td class="action">--}}
                                                {{--<input type="checkbox" value="id" name="delete"/>--}}
                                            {{--</td>--}}
                                            <td width="4%" class="td-classic">{{$menu->id}}</td>
                                            <td width="200px">
                                                @if($menu->menu_photo != null)
                                                <img width="100%" src="{{asset($menu->menu_photo)}}">
                                                    @else
                                                    <img class="img-responsive" src="{{asset('img/no-image.png')}}">
                                                @endif
                                            </td>
                                            <td class="td-classic">{{$menu->menu_name}}</td>
                                            <td class="td-classic">{{$menu->menu_price}}</td>
                                            <td class="td-classic">{{$menu->category->name}}</td>
                                            <td class="td-classic">{{$menu->stock_qty}}</td>
                                            @if($menu->menu_status)
                                            <td class="td-classic">Да</td>
                                                @else
                                                <td class="td-classic">Не</td>
                                            @endif
                                            <td class="td-classic">
                                                <a href="{{url('admin/menus/'.$menu->id.'/edit')}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></a>
                                                {{--<a  href="{{url('admin/menus/destroy')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>--}}
                                                <form class="form-buttons" action="menus/{{ $menu->id }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
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
    @endsection

    @section('scripts')

    @endsection

    @section('bodyEnd')
    </body>
@endsection