@extends('cms.parent')
@section('title',__('cms.admins'))
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> --}}
@endsection


@section('page_name',__('cms.create'))
@section('main_page',__('cms.admins'))
@section('small_page_name',__('cms.create'))

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{__('cms.create_admin')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">



                <div class="form-group">
                    <label for="name">{{__('cms.name_user')}}</label>
                    <input type="text" name="name_user" class="form-control" id="name"
                        placeholder="{{__('cms.name_user')}}" value="{{old('name_user')}}">
                </div>
                <div class="form-group">
                    <label for="email">{{__('cms.email')}}</label>
                    <input type="text" name="user_email" class="form-control" id="email"
                        placeholder="{{__('cms.email')}}" value="{{old('user_email')}}">
                </div>





            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">{{__('cms.save')}}</button>
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
    function performStore(){
            axios.post('/cms/admin/admins', {
               name: document.getElementById('name').value,
               email: document.getElementById('email').value,
            })
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);

            document.getElementById('create-form').reset();

            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


        }

</script>

@endsection