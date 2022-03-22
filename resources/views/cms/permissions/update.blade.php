@extends('cms.parent')
@section('title',__('cms.permissions'))
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}
@endsection


@section('page_name',__('cms.update'))
@section('main_page',__('cms.permissions'))
@section('small_page_name',__('cms.update'))

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{__('cms.update_permissions')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf
            <div class="card-body">




                <div class="form-group">
                    <label>{{__('cms.user_type')}}</label>
                    <select class="form-control user_type " style="width: 100%;" id="guard_name">
                        <option value="admin" @if ($permission->guard_name =='admin')
                            selected
                            @endif>{{__('cms.admins')}}</option>
                        <option value="user" @if ($permission->guard_name =='user')
                            selected
                            @endif>{{__('cms.users')}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>{{__('cms.permissions')}}</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="{{__('cms.permissions')}}"
                        value="{{$permission->name}}">
                </div>






            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performUpdate()" class="btn btn-primary">{{__('cms.save')}}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


</div>


@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script>
    //Initialize Select2 Elements
    // $('.select2').select2()

    //Initialize Select2 Elements
    $('.guard_name').select2({
        theme: 'bootstrap4'
    });


    function performUpdate() {
        axios.put('/cms/admin/permissions/{{$permission->id}}', {
                name: document.getElementById('name').value,
                guard_name: document.getElementById('guard_name').value,

            })
            .then(function(response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href='/cms/admin/permissions';


            })
            .catch(function(error) {
                console.log(error);
                toastr.error(error.response.data.message);

            });


    }
</script>

@endsection