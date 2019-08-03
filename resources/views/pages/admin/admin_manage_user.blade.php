@extends('layouts.app.layouts')

@section('title')

    Manage User Accounts

@endsection

@include('layouts.app.sidebar')

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Manage User Accounts</h3>
                    <h6 class="card-subtitle">@include ('layouts.app.flash_message')</h6>
                    <div class="table-responsive">
                        <table id="demo-foo-addrow2" class="table m-t-30 table-hover contact-list" data-page-size="10">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Last Updated</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <div class="m-t-40">
                                <div class="d-flex">
                                    <div class="ml-auto">
                                        <div class="form-group">
                                            <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="on">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <tbody>
                                    @foreach ($data as $key => $item)
                                <tr>
                                    <td>
                                        {{$key+ 1}}
                                    </td>
                                    <td>
                                            {{$item->full_name}}
                                    </td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <a href="{{route('admin.reset',['id'=>$item->id])}}">
                                        <span class="label label-rounded label-primary">reset pass
                                                <i class="fa fa-refresh"></i>
                                        </span>
                                        </a>
                                        
                                    </td>
                                    <td>
                                            @if ($item->is_active == 1)
                                                <a href="{{route('admin.activate',['id'=>$item->id])}}">
                                                    <span class="label label-rounded label-success">active</span>
                                                </a>
                                            @else 
                                                <a href="{{route('admin.activate',['id'=>$item->id])}}">
                                                    <span class="label label-rounded label-danger">inactive</span>
                                                </a>
                                            @endif
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                        @if ($item->user_type_id == 1)
                                            <span class="label label-rounded label-warning">admin</span>
                                        @else 
                                            <span class="label label-rounded label-warning">user</span>
                                        @endif
                
                                    <td>
                                        
                                    
                                            <a href="{{route('admin.edit.users',['id'=>$item->id])}}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        
                                        &nbsp | &nbsp 
                                        <a href="" class="deleteAcc" data-id="{{$item->id}}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <!--<td colspan="2">
                                        <a href = '{{route('admin.add.users')}}' class='btn btn-info btn-rounded'>Add New User</a>
                                    </td>-->
                                    <td colspan="2">
                                            <button type="button" 
                                                    class="btn btn-info btn-rounded" 
                                                    data-toggle="modal" 
                                                    data-target="#add-contact">Invite New User
                                            </button>
                                    </td>
                                        <div id="add-contact" 
                                            class="modal fade in" 
                                            tabindex="-1" 
                                            role="dialog" 
                                            aria-labelledby="myModalLabel" 
                                            aria-hidden="true">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Send User Invitation</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal form-material" method="POST" action="{{route('admin.add.users')}}">

                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-rounded btn-info waves-effect">Send</button>
                                                        <button type="button" class="btn btn-rounded btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                    </div>
                                    <td colspan="7">
                                        <div class="text-right float-right">
                                            <ul class="pagination"> </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>


@push('script')
    <script>
        $(document).ready(function(){
            setTimeout(function() {
                $('.alert').slideUp(1000);
            }, 4000);
        console.log();
        });
    </script>
    <script>
        $('.deleteAcc').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr("data-id")
            swal({
                    title: "Are you sure to delete?",
                    text: "You will not be able to recover this Account!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ff354d",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: true
                }, function(){
                    // $('.loading').show()
                    $.ajax({
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        url: "{{route('admin.del.users')}}",
                        data: { id : id },
                        type: "POST",
                        success: function (data) {
                            location.reload();
                        }         
                    });
            });
        });
    </script>
@endpush
        
@endsection