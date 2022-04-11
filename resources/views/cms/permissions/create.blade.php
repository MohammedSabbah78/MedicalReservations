@extends('cms.parent')
@section('title',__('cms.permissions'))
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection


@section('page_name',__('cms.create'))
@section('main_page',__('cms.permissions'))
@section('small_page_name',__('cms.create'))

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{__('cms.create_permissions')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">




                <div class="form-group">
                    <label>{{__('cms.user_type')}}</label>
                    <select class="form-control user_type " style="width: 100%;" id="guard_name">
                        <option value="admin">{{__('cms.admins')}}</option>
                        <option value="user">{{__('cms.users')}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">{{__('cms.permissions')}}</label>
                    <input type="text" name="name_permission" class="form-control" id="name" placeholder="{{__('cms.permissions')}}"
                        value="{{old('name_permission')}}">
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
    //Initialize Select2 Elements
    // $('.select2').select2()
    
    //Initialize Select2 Elements
$('.guard_name').select2({
    theme: 'bootstrap4'
    });


        function performStore(){
            axios.post('/cms/admin/permissions', {
               name: document.getElementById('name').value,
               guard_name: document.getElementById('guard_name').value,

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