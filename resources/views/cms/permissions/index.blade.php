@extends('cms.parent')
@section('title',__('cms.permissions'))
@section('main-content')




@section('page_name',__('cms.index'))
@section('main_page',__('cms.permissions'))
@section('small_page_name',__('cms.index'))

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.permissions')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Guard</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($permissions as $permission )
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td><span class="badge  bg-info  ">{{$permission->guard_name}}</span>
                                    </td>
                                    <td>{{$permission->updated_at}}</td>
                                    <td>{{$permission->updated_at}}</td>
                                    <td>
                                        @canany(['Update-Permissions', 'Delete-Permissions'])
                                        <div class="btn-group">
                                            @can('Update-Permissions')
                                            <a href="{{route('permissions.edit',[$permission->id])}}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-Permissions')
                                            <a href="#" onclick="confirmDelete('{{$permission->id}}',this)"
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

     axios.delete('/cms/admin/permissions/'+id)
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