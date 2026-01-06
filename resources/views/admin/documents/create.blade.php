@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('global.create') }} Document
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="required" for="name">নাম</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ old('name', '') }}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            {{-- <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                <label for="file">Upload File</label>
                                <input class="form-control" type="file" name="file" id="file">
                                @if ($errors->has('file'))
                                    <span class="help-block" role="alert">{{ $errors->first('file') }}</span>
                                @endif
                            </div> --}}

                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
