@extends('cms.parent')
@section('title',__('cms.cities'))
@section('main-content')

@section('page_name',__('cms.create'))
@section('main_page',__('cms.cities'))
@section('small_page_name',__('cms.create'))

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{__('cms.create_city')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('cities.store')}}">
            @csrf
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                        @endforeach

                    </ul>
                </div>

                @endif

                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{session('message')}}
                </div>
                @endif

                <div class="form-group">
                    <label for="nameEnCity">{{__('cms.name_en')}}</label>
                    <input type="text" name="name_en" class="form-control" id="nameEnCity"
                        placeholder="{{__('cms.name_en')}}" value="{{old('name_en')}}">
                </div>
                <div class="form-group">
                    <label for="nameArCity">{{__('cms.name_ar')}}</label>
                    <input type="text" name="name_ar" class="form-control" id="nameArCity"
                        placeholder="{{__('cms.name_ar')}}" value="{{old('name_ar')}}">
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="active" id="activeSwitch">
                        <label class="custom-control-label" for="activeSwitch">{{__('cms.active')}}</label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{__('cms.save')}}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


</div>


@endsection
@section('styles')
@endsection
@section('scripts')
@endsection