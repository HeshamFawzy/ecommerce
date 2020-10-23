@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ __('categories.title') }}</h1>
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
                                <table class="table table-striped" id="Table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('categories.name_en') }}</th>
                                        <th>{{ __('categories.name_ar') }}</th>
                                        <th>{{ __('categories.image') }}</th>
                                        <th>{{ __('categories.size-image') }}</th>
                                        <th>{{ __('categories.actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <div>{{ $category->name_en }}</div>
                                            </td>
                                            <td>
                                                <div>{{ $category->name_ar }}</div>
                                            </td>
                                            <td>
                                                @if ($category->image_filename == null)
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("assets/admin/images/Question_Mark.png") }}">
                                                    </div>
                                                @else
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("categories/images/{$category->image_filename}") }}">
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($category->size_filename == null)
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("assets/admin/images/Question_Mark.png") }}">
                                                    </div>
                                                @else
                                                    <div class="col-3"><img width="100%"
                                                                            src="{{ url("categories/sizeImages/{$category->size_filename}") }}">
                                                    </div>
                                            @endif
                                            <td>
                                                <div>
                                                    <a class="btn btn-warning"
                                                       href="{{ route('categories.edit' , $category) }}"><span
                                                            class="fas fa-pen"></span> </a>
                                                    <form method="POST"
                                                          action="{{ route('categories.destroy' , $category->id) }}"
                                                          enctype="multipart/form-data>">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><span
                                                                class="fas fa-trash"></span>
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $categories->render() !!}
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
        $('#Table').DataTable({
            "language": {
                "search": "ابحث",
                "lengthMenu": "_MENU_ اظهر",
            }
        });
    </script>
@endpush
