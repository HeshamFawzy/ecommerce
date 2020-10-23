@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('categories.create-category') }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('categories.store') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>{{ __('categories.name_en') }}</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a Category Name in English"
                                                       name="name_en" required>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>{{ __('categories.name_en') }}</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a Category Name in Arabic"
                                                       name="name_ar" required>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>{{ __('categories.image') }}</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6" data-pg-collapsed>
                                                    <input type="file" class="form-control"
                                                           placeholder="Please Enter a Category Image" id="uploadImage"
                                                           name="image" required>
                                                </div>
                                                <div class="col-3 border">
                                                    <img id="image" src="#" alt="Uploaded Image" width="100%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>{{ __('categories.size-image') }}</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6" data-pg-collapsed>
                                                    <input type="file" class="form-control"
                                                           placeholder="Please Enter a Category Size Image"
                                                           id="uploadSizeImage" name="sizeImage" required>
                                                </div>
                                                <div class="col-3 border">
                                                    <img id="sizeImage" src="#" alt="Uploaded Image" width="100%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container pt-4">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table id="sizesTable" class="table table-active">
                                                        <tbody>
                                                        <tr>
                                                            <th>Size</th>
                                                            <th>Chest</th>
                                                            <th>Waist</th>
                                                            <th>Regular</th>
                                                            <th>Inseam</th>
                                                            <th>Long(Tall) Inseam</th>
                                                        </tr>
                                                        @foreach ($sizes as $size)
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               id="formInput{{$size->name}}" value="">
                                                                        <label class="form-check-label"
                                                                               for="formInput56">{{ $size->name }}</label>
                                                                    </div>
                                                                </td>
                                                                @foreach ($parts as $part)
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control {{ $size->name }}"
                                                                               name="value[{{ $part->name }}][]">
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success mt-5 float-right"><span class="fas fa-plus"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@push('custom-foot')
    <script>
        $(function () {
            $('.Xs, .S, .M, .L, .Xl').hide();
            $(function () {
                $("#formInputXs").click(function () {
                    if ($(this).is(":checked")) {
                        $(".Xs").show();
                        $(".Xs").prop('required', true);
                    } else {
                        $(".Xs").hide();
                        $(".Xs").prop('required', false);
                    }
                });
                $("#formInputS").click(function () {
                    if ($(this).is(":checked")) {
                        $(".S").show();
                        $(".S").prop('required', true);
                    } else {
                        $(".S").hide();
                        $(".S").prop('required', false);
                    }
                });
                $("#formInputM").click(function () {
                    if ($(this).is(":checked")) {
                        $(".M").show();
                        $(".M").prop('required', true);
                    } else {
                        $(".M").hide();
                        $(".M").prop('required', false);
                    }
                });
                $("#formInputL").click(function () {
                    if ($(this).is(":checked")) {
                        $(".L").show();
                        $(".L").prop('required', true);
                    } else {
                        $(".L").hide();
                        $(".L").prop('required', false);
                    }
                });
                $("#formInputXl").click(function () {
                    if ($(this).is(":checked")) {
                        $(".Xl").show();
                        $(".Xl").prop('required', true);
                    } else {
                        $(".Xl").hide();
                        $(".Xl").prop('required', false);
                    }
                });
            });
            $('#uploadImage').change(function () {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "jfif")) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#image').attr('src', '/assets/admin/images/Question_Mark.png');
                }
            });
            $('#uploadSizeImage').change(function () {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "jfif")) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#sizeImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#sizeImage').attr('src', '/assets/admin/images/Question_Mark.png');
                }
            });
        });
    </script>
@endpush
