@extends('layouts.app.layouts')

@section('title')
    Manage User Account
@endsection

@include('layouts.app.sidebar')

@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle">
                        @include ('layouts.app.flash_message')</h6>
                    <div class="table-responsive">
                        <table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle" data-page-size="10">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Description</th>
                                    <th>Time Scheduled</th>
                                    <th>Time Created</th>
                                    <th>Task Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <div class="m-t-40">
                                <div class="d-flex">
                                    <div class="mr-auto">
                                        <div class="form-group">
                                                <h4 class="card-title">Your Todo List</h4>
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <div class="form-group">
                                            <input id="demo-input-search2" type="text" placeholder="Search" autocomplete="on">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <tbody>
                                @if(count($data) == 0)
                                    <td colspan="6" style='text-align:center'>
                                        You have no task recorded, 
                                        lets 
                                        <label class='label label-light-primary'>
                                            <a data-toggle="modal" data-target="#add-contact">create one!</a>
                                        </label>
                                    </td>
                                @else
                                    @foreach ($data as $key => $item)
                                    
                                    <tr>

                                            <td style="text-align: center">
                                                {{++$key}}
                                            </td>
                                            @if($item->is_complete == 1
                                                OR
                                                $item->is_complete == 3
                                                OR
                                                $item->is_complete == 5)

                                                <td style="text-decoration: line-through;">
                                                    {{$item->description}}
                                                </td>
                                                <td style="text-decoration: line-through;">
                                                    {{$item->scheduled}}
                                                </td>
                                                <td style="text-decoration: line-through;">
                                                    {{$item->created_at}}
                                                </td>
                                            @else
                                                <td>
                                                    {{$item->description}}
                                                </td>
                                                <td>
                                                    {{$item->scheduled}}
                                                </td>
                                                <td>
                                                    {{$item->created_at}}
                                                </td>
                                            @endif

                                            <td >
                                                @if($item->is_complete == 1)
                                                    <span class="label label-rounded label-success">complete</span>

                                                @elseif($item->is_complete == 2)
                                                    <span class="label label-rounded label-warning">notified</span>

                                                @elseif($item->is_complete == 3)
                                                    <span class="label label-rounded label-danger">expired</span>

                                                @elseif($item->is_complete == 5)
                                                    <span class="label label-rounded label-success">Completed</span>
                                                    <span class="label label-rounded label-light-danger">Delayed</span>

                                                @else
                                                    <span class="label label-rounded label-info">progress</span>
                                                @endif
                                            </td>
                        
                                            <td>
                                                <a href="" class="deleteTask" data-id ={{$item->id}}>
                                                    <i class="fa fa-times"></i>
                                                </a> &nbsp | &nbsp
                                                <a href="{{route('user.v_edit.task',['id'=>$item->id])}}">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a> &nbsp | &nbsp
                                                <a href="{{route('user.edit.task',['id'=>$item->id])}}">
                                                    <i class="fa fa-check-circle"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                    
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                            <button type="button" 
                                                    class="btn btn-info btn-rounded" 
                                                    data-toggle="modal" 
                                                    data-target="#add-contact">Add New Task
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
                                                        <h4 class="modal-title" id="myModalLabel">Create New Task</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <form class="form-horizontal form-material" method="POST" action="{{route('user.add.task')}}">

                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" name="desc" placeholder="Task Description" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" id="min-date" name='scheduled' class="form-control" placeholder="Time Scheduled" required>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-rounded btn-info waves-effect">Add Task</button>
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
        $('.deleteTask').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr("data-id")
            swal({
                    title: "Are you sure to delete?",
                    text: "You will not be able to recover this data!",
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
                        url: "{{route('user.del.task')}}",
                        data: { id : id },
                        type: "POST",
                        success: function (response) {
                            var data = response;
                            alert(response.error);
                        }         
                    });
            });
        });
        
    </script>
@endpush
@endsection