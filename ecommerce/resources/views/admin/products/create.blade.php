@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create Product</h1>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
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
                                <form action="{{ route('products.store') }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="container">
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Name (En) :</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a Product Name in English"
                                                       name="name_en" required>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Name (Ar) :</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input type="text" class="form-control"
                                                       placeholder="Please Enter a Product Name in Arabic"
                                                       name="name_ar" required>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Category :</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <div class="p-2 d-inline">
                                                    <select id="category" class="form-control" name="category"
                                                            required>
                                                        <option value="" disabled="disabled" selected="true">Select
                                                            Caregory
                                                        </option>
                                                        @if($categories ?? '')
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name_en}}
                                                                    -{{$category->name_ar}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Product Image :</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6" data-pg-collapsed>
                                                    <input type="file" class="form-control"
                                                           placeholder="Please Enter a Product Image" id="uploadImage"
                                                           name="image">
                                                </div>
                                                <div class="col-3 border">
                                                    <img id="image" src="#" alt="Uploaded Image" width="100%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Product AlterImage :</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-6" data-pg-collapsed>
                                                    <input type="file" class="form-control"
                                                           placeholder="Please Enter a Product Alter Image"
                                                           id="uploadAlterImage" name="alterImage">
                                                </div>
                                                <div class="col-3 border">
                                                    <img id="alterImage" src="#" alt="Uploaded Image" width="100%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Available Colors :*</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                @foreach ($colors as $color)
                                                    <div class="p-2 d-inline">
                                                        <input name="colors[]" type="checkbox"
                                                               value="{{ $color->name }}">
                                                        <label for="white">{{ $color->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Available Sizes :*</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                @foreach ($sizes as $size)
                                                    <div class="p-2 d-inline">
                                                        <input name="sizes[]" type="checkbox"
                                                               value="{{ $size->name }}">
                                                        <label for="white">{{ $size->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="container pt-4" data-pg-collapsed>
                                            <div class="row">
                                                <h4 class="text text-danger" style="color: white">Price (EGY) :</h4>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input type="number" class="form-control"
                                                       placeholder="Please Enter a Product Price in Egyption Pound"
                                                       name="price" required>
                                            </div>
                                        </div>
                                        <div class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>Discount :</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input id="trueDiscount" type="radio" name="discount" value="1">
                                                <label for="trueDiscount">True</label>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input id="falseDiscount" type="radio" name="discount" value="0"
                                                       checked>
                                                <label for="falseDiscount">False</label>
                                            </div>
                                        </div>
                                        <div id="discount" class="container" data-pg-collapsed>
                                            <div class="row">
                                                <p>End Date Of Discount :</p>
                                            </div>
                                            <div class="col-12" data-pg-collapsed>
                                                <input id="end_date" type="date" class="form-control"
                                                       name="end_date">
                                            </div>
                                            <div class="container" data-pg-collapsed>
                                                <div class="row">
                                                    <p>Discount Amount :</p>
                                                </div>
                                                <input type="number" class="form-control" id="amount"
                                                       placeholder="Please Enter a Product Price in Egyption Pound"
                                                       name="amount">
                                                <div class="col-12" data-pg-collapsed>
                                                    <input id="amount" type="radio" name="discountType"
                                                           value="amount" checked>
                                                    <label for="amount">Pound(EGY)</label>
                                                </div>
                                                <div class="col-12" data-pg-collapsed>
                                                    <input id="percentage" type="radio" name="discountType"
                                                           value="percentage">
                                                    <label for="percentage">Percentage</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success mt-5 float-right">Create</button>
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

@push('custom-script')
    <script>
        $(function () {
            $('#discount').hide();
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
            $('#uploadAlterImage').change(function () {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "jfif")) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#alterImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#alterImage').attr('src', '/assets/admin/images/Question_Mark.png');
                }
            });
            $('input[type=radio][name=discount]').change(function () {
                if (this.value == '1') {
                    $('#discount').show();
                    $('#end_date').attr('required');
                    $('#amount').attr('required');
                } else {
                    $('#discount').hide();
                }
            });
        });
    </script>
@endpush
