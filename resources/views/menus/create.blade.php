@extends('layouts.admin')

@section('loadCSS')
    <link rel="stylesheet" href="{{asset('/ui/jquery-ui-themes-1.12.1/themes/smoothness/jquery-ui.css')}}"/>
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
                        <form action="{{url('admin/menus')}}" method="post" enctype="multipart/form-data">
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
                                <label for="menu-name">Име</label>
                                <input type="text" class="form-control" id="name"
                                       placeholder="Име на артикула" name="menu_name">
                                <small id="menu-name" class="form-text text-muted">
                                    test test
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="menu-description">Описание</label>
                                <textarea class="form-control" id="menu-description" rows="3"
                                          name="menu_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="menu-price">Цена</label>
                                <div class="input-group">
                                    <input type='number' step='0.01' placeholder='0.00' class="form-control"
                                           id="menu-price" name="menu_price"/>
                                    <span class="input-group-addon">лв.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select-category">Избери категория</label>
                                <select class="form-control" id="select-category" name="id_category">
                                    <option selected disabled>...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="menu-qty">Количество</label>
                                <input type="number" class="form-control" id="menu-qty" name="menu_qty" min="0">
                            </div>
                            <div class="form-group">
                                <label for="image-menu" class="btn btn-primary">Добавете снимка</label>
                                <input type="file" id="image-menu" name="image_menu" accept="image/*"
                                       style="display: none">
                                <div>
                                    <img id="image-preview" src="#" alt="product image"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="menu-options">Изберете съставките на ястието</label>
                                <input type="text" class="form-control" id="menu-options" name="menu_options">
                            </div>
                            <div class="form-group">
                                <p style="font-weight: 700;">Видим</p>
                                <input type="checkbox" checked name="enable_menu" id="on-off" data-toggle="toggle"
                                       data-on="Да" data-off="Не">
                            </div>
                            <div class="pull-right form-group">
                                <a href="{{url('admin/menus')}}" class="btn btn-default">Назад</a>
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
            $(document).on('ready', function () {
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

                $("#image-menu").change(function () {
                    readURL(this);
                });
            })
        </script>
        <script type="text/javascript">
            $(function () {
                var availableTags = [];
                $.ajax({
                    url: 'product-options',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (response) {
                        $.each(response, function (key, row) {
                            availableTags.push(row.name);
                        });

                        function split(val) {
                    return val.split(/,\s*/);
                }

                function extractLast(term) {
                    return split(term).pop();
                }

                $("#menu-options")
                // don't navigate away from the field on tab when selecting an item
                    .on("keydown", function (event) {
                        if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).autocomplete("instance").menu.active) {
                            event.preventDefault();
                        }
                    })
                    .autocomplete({
                        minLength: 0,
                        source: function (request, response) {
                            // delegate back to autocomplete, but extract the last term
                            response($.ui.autocomplete.filter(
                                availableTags, extractLast(request.term)));
                        },
                        focus: function () {
                            // prevent value inserted on focus
                            return false;
                        },
                        select: function (event, ui) {
                            var terms = split(this.value);
                            // remove the current input
                            terms.pop();
                            // add the selected item
                            terms.push(ui.item.value);
                            // add placeholder to get the comma-and-space at the end
                            terms.push("");
                            this.value = terms.join(", ");
                            return false;
                        }
                    });
                    }
                });
            });
        </script>
        <script src="{{asset('ui/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
    @endsection

    @section('bodyEnd')
    </body>
@endsection