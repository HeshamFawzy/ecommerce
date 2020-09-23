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
                                    <div class="container" id="steps">
                                        <div id="info1">
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
                                                    <p>Description :</p>
                                                </div>
                                                <div class="col-12" data-pg-collapsed>
                                                <textarea type="text" class="form-control"
                                                          placeholder="Please Enter a Product Description"
                                                          name="description" required></textarea>
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
                                                                    <option
                                                                        value="{{$category->id}}">{{$category->name_en}}
                                                                        -{{$category->name_ar}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="info3">
                                            <div class="container" data-pg-collapsed>
                                                <div class="row">
                                                    <p>Available Colors :*</p>
                                                </div>
                                                <div id="colorImages" class="col-12" data-pg-collapsed>
                                                    @foreach ($colors as $color)
                                                        <div class="p-2 d-inline">
                                                            <input name="colors[]" type="checkbox" class="check"
                                                                   value="{{ $color->id }}">
                                                            <label for="colors[]">{{ $color->name }}</label>
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
                                                                   value="{{ $size->id }}">
                                                            <label for="white">{{ $size->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div id="info4">
                                            <div class="container pt-4" data-pg-collapsed>
                                                <div class="row">
                                                    <h4 class="text text-danger" style="color: white">Price (EGY) :</h4>
                                                </div>
                                                <div class="col-12" data-pg-collapsed>
                                                    <input type="number" step="0.01" class="form-control"
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

@push('custom-foot')
    <script>
        $(function () {
            $('#discount').hide();
            $('input[type=radio][name=discount]').change(function () {
                if (this.value == '1') {
                    $('#discount').show();
                    $('#end_date').attr('required');
                    $('#amount').attr('required');
                } else {
                    $('#discount').hide();
                }
            });
            $("input[type=checkbox][name^='color']").click(function () {
                if (this.checked) {
                    let x = '<div class="' + $(this).val() + '" class="col-6 card card-dark p-3"> <label for="colorImage[]">Image <span class="badge badge-info"></span> :</label> <input type="file" class="form-control" placeholder="Please Enter Color Image" id="colorImage" name="colorImage[]" required> <label for="colorAlterImage[]">Alter :</label> <input type="file" class="form-control" placeholder="Please Enter Color Alter Image" id="colorAlterImage" name="colorAlterImage[]" required></div>';
                    $("#colorImages").append(x);
                } else {
                    $("." + $(this).val()).remove();
                }
            });
        });
    </script>
@endpush

