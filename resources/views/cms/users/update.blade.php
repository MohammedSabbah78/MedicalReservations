@extends('cms.parent')
@section('title',__('cms.users'))
@section('main-content')

@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection


@section('page_name',__('cms.update_user'))
@section('main_page',__('cms.users'))
@section('small_page_name',__('cms.update_user'))

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{__('cms.update_user')}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="create-form">
            @csrf
            <div class="card-body">

                <div class="form-group">
                    <label>{{__('cms.cities')}}</label>
                    <select class="form-control cities " style="width: 100%;" id="city_id">

                        @foreach ($cities as $city )
                        <option value="{{$city->id}}" @if ($user->city_id ==$city->id)
                            selected
                            @endif

                            >{{$city->name_en}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group">
                    <label>{{__('cms.gender')}}</label>
                    <select class="form-control gender " style="width: 100%;" id="gender">
                        <option value="M" @if ($user->gender =='M')
                            selected
                            @endif>

                            {{__('cms.male')}}</option>
                        <option value="F" @if ($user->gender =='F')
                            selected
                            @endif>
                            {{__('cms.female')}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">{{__('cms.name_user')}}</label>
                    <input type="text" name="name_user" class="form-control" id="name"
                        placeholder="{{__('cms.name_user')}}" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">{{__('cms.email')}}</label>
                    <input type="text" name="user_email" class="form-control" id="email"
                        placeholder="{{__('cms.email')}}" value="{{$user->email}}">
                </div>





            </div>

            <div class="form-group">
                <label for="image_file">Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image_file">
                        <label class="custom-file-label" for="image_file">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" onclick="updateStore()" class="btn btn-primary">{{__('cms.save')}}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->


</div>


@endsection

@section('scripts')


<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function () {bsCustomFileInput.init();});
</script>

<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script>
    //Initialize Select2 Elements
    // $('.select2').select2()
    
    //Initialize Select2 Elements
$('.gender').select2({
    theme: 'bootstrap4'
    });

    $('.cities').select2({
        theme: 'bootstrap4'
        });


        function updateStore(){

        let formData=new FormData();
        formData.append('_method','PUT');
        formData.append('name',document.getElementById('name').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('city_id',document.getElementById('city_id').value);
        formData.append('gender',document.getElementById('gender').value);
        formData.append('image',document.getElementById('image_file').files[0]);




            axios.post('/cms/admin/users/{{$user->id}}', formData)
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);


            window.location.href='/cms/admin/users'
            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data.message);
            
            });


        }

</script>

@endsection