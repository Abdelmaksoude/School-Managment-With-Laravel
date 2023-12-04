@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('all_trans.Grade_List') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="mb-2">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('all_trans.Grade') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('all_trans.Grade') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
        <div class="card-body">
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('all_trans.add_Grade') }}
            </button>
            <br><br>
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('all_trans.Name') }}</th>
                    <th>{{ trans('all_trans.Notes') }}</th>
                    <th>{{ trans('all_trans.Processes') }}</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                @foreach ($grades as $grade)
                <?php $i++; ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $grade->Name }}</td>
                        <td>{{ $grade->Notes }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $grade->id }}"
                                    title="{{ trans('all_trans.Edit') }}"><i
                                    class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $grade->id }}"
                                    title="{{ trans('all_trans.Delete') }}"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- edit_modal_Grade -->
                    <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('all_trans.edit_Grade') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{route('grade.update', $grade->id)}}" method="post">
                                        {{method_field('patch')}}
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name"
                                                        class="mr-sm-2">{{ trans('all_trans.stage_name_ar') }}
                                                    :</label>
                                                <input id="Name" type="text" name="Name"
                                                        class="form-control"
                                                        value="{{$grade->getTranslation('Name', 'ar')}}"
                                                        required>
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $grade->id }}">
                                            </div>
                                            <div class="col">
                                                <label for="Name_en"
                                                        class="mr-sm-2">{{ trans('all_trans.stage_name_en') }}
                                                    :</label>
                                                <input type="text" class="form-control"
                                                        value="{{$grade->getTranslation('Name', 'en')}}"
                                                        name="Name_en" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="exampleFormControlTextarea1">{{ trans('all_trans.Notes_ar') }}
                                                :</label>
                                            <textarea class="form-control" name="Notes"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{$grade->getTranslation('Notes', 'ar')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="exampleFormControlTextarea1">{{ trans('all_trans.Notes_en') }}
                                                :</label>
                                            <textarea class="form-control" name="Notes_en"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{$grade->getTranslation('Notes', 'en')}}</textarea>
                                        </div>
                                        <br><br>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('all_trans.Close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-success">{{ trans('all_trans.update') }}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- delete_modal_Grade -->
                    <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('all_trans.delete_Grade') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('grade.destroy', $grade->id)}}" method="post">
                                        {{method_field('Delete')}}
                                        @csrf
                                        {{ trans('all_trans.Warning_Grade') }}
                                        <input id="id" type="hidden" name="id" class="form-control"
                                                value="{{ $grade->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('all_trans.Close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-danger">{{ trans('all_trans.delete') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    {{ trans('all_trans.add_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('grade.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name"
                                    class="mr-sm-2">{{ trans('all_trans.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="Name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Name_en"
                                    class="mr-sm-2">{{ trans('all_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="Name_en" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            for="exampleFormControlTextarea1">{{ trans('all_trans.Notes_ar') }}
                            :</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label
                            for="exampleFormControlTextarea1">{{ trans('all_trans.Notes_en') }}
                            :</label>
                        <textarea class="form-control" name="Notes_en" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('all_trans.Close') }}</button>
                <button type="submit"
                        class="btn btn-success">{{ trans('all_trans.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>

</div>
<!-- row closed -->
@endsection
@section('js')
    {{-- <script>
        @if(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
    </script> --}}
@endsection
