@extends('cms.parent')
@section('title',__('cms.users'))
@section('main-content')




@section('page_name',__('cms.index'))
@section('main_page',__('cms.users'))
@section('small_page_name',__('cms.index'))

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.users')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width: 40px">Gender</th>
                                    <th>Permissions</th>
                                    <th>City</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user )
                                <tr>
                                    <td><img width="60" height="60" src="{{Storage::url($user->image)}}"></td>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><span
                                            class="badge @if($user->gender =='M') bg-success @else bg-warning @endif">{{$user->gender_type}}</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-app bg-info"
                                            href="{{route('user.edit-permissions',$user->id)}}">
                                            <span class="badge bg-green">{{$user->permissions_count}}</span>
                                            <i class="fas fa-users"></i> Permissions
                                        </a>
                                    </td>
                                    <td>{{$user->city->name_en}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>
                                        @canany(['Update-User', 'Delete-User'])
                                        <div class="btn-group">
                                            @can('Update-User')
                                            <a href="{{route('users.edit',[$user->id])}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-User')
                                            <a href="#" onclick="confirmDelete('{{$user->id}}',this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            @endcan

                                        </div>
                                        @endcanany
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
<script>
    function confirmDelete(id,element){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id,element);

        }
        })

    }


function performDelete(id,element){

     axios.delete('/cms/admin/users/'+id)
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        element.closest('tr').remove();

                 
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
        
        });

}

</script>



@endsection