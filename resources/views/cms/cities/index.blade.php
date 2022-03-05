@extends('cms.parent')
@section('title',__('cms.cities'))
@section('main-content')




@section('page_name',__('cms.index'))
@section('main_page',__('cms.cities'))
@section('small_page_name',__('cms.index'))

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.cities')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name (En)</th>
                                    <th>Name (Ar)</th>
                                    <th style="width: 40px">Active</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cities as $city )
                                <tr>
                                    <td>{{$city->id}}</td>
                                    <td>{{$city->name_en}}</td>
                                    <td>{{$city->name_ar}}</td>
                                    <td><span
                                            class="badge @if($city->active) bg-success @else bg-danger @endif">{{$city->active_status}}</span>
                                    </td>
                                    <td>{{$city->created_at}}</td>
                                    <td>{{$city->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('cities.edit',[$city->id])}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{route('cities.destroy',[$city->id])}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> 
                                                </button>

                                            </form>


                                        </div>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->







</section>


@endsection
@section('styles')
@endsection
@section('scripts')
@endsection