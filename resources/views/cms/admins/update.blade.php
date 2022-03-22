@extends('cms.parent')
@section('title',__('cms.admins'))
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection


@section('page_name',__('cms.update_admin'))
@section('main_page',__('cms.admins'))
@section('small_page_name',__('cms.update_admin'))

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{__('cms.update_admin')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>{{__('cms.roles')}}</label>
                    <select class="form-control roles " style="width: 100%;" id="role_id">

                        @foreach ($roles as $role )
                        <option value="{{$role->id}}" @if ($adminRoles->id==$role->id)
                            selected
                            @endif >{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">{{__('cms.name_user')}}</label>
                    <input type="text" name="name_admin" class="form-control" id="name"
                        placeholder="{{__('cms.name_user')}}" value="{{$admin->name}}">
                </div>
                <div class="form-group">
                    <label for="email">{{__('cms.email')}}</label>
                    <input type="text" name="admin_email" class="form-control" id="email"
                        placeholder="{{__('cms.email')}}" value="{{$admin->email}}">
                </div>





            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="updateStore()" class="btn btn-primary">{{__('cms.save')}}</button>
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
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script>
    $('.roles').select2({
        theme: 'bootstrap4'
        });
    function updateStore(){
            axios.put('/cms/admin/admins/{{$admin->id}}', {
                role_id: document.getElementById('role_id').value,
               name: document.getElementById('name').value,
               email: document.getElementById('email').value,
            })
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);


            window.location.href='/cms/admin/admins'
            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


        }

</script>

@endsection