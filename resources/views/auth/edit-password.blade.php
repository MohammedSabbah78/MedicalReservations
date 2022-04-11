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
        <form>
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
                    <label for="nameEnCity">Current Password</label>
                    <input type="text" name="current_password" class="form-control" id="current_password"
                        placeholder="Current Password" value="{{old('current_password')}}">
                </div>
                <div class="form-group">
                    <label for="nameEnCity">New Password</label>
                    <input type="text" name="new_password" class="form-control" id="new_password"
                        placeholder="New Password" value="{{old('new_password')}}">
                </div>
                <div class="form-group">
                    <label for="nameEnCity">New Password Confirmation</label>
                    <input type="text" name="new_password_confirmation" class="form-control"
                        id="new_password_confirmation" placeholder="New Password"
                        value="{{old('new_password_confirmation')}}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performUpdate()" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


</div>


@endsection
@section('styles')
@endsection
@section('scripts')
<script>
    // mohammed@123M
    function performUpdate(){
            axios.post('/cms/admin/update-password', {
               password: document.getElementById('current_password').value,
               new_password: document.getElementById('new_password').value,
               new_password_confirmation: document.getElementById('new_password_confirmation').value,

            })
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);


            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


        }

</script>
@endsection