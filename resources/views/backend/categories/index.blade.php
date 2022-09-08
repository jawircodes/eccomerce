@extends('backend.layouts.master')
@section('title', 'All Category')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'Category Management')


@section('content')

<div class="row clearfix">

    <div class="col-lg-12">
    
        <div class="card">
            
            <div class="body">
               <div class="row">
                    <div class="col">
                    <div class="float-right">
                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-plus-square"></i> <span>ADD</span></button>
                            <div class="row clearfix"></div>
                            <br>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover  dataTable table-custom" id="data-table">
                            <thead>
                                <tr>    
                                    <th>id</th>   
                                    <th>Title</th>
                                    <th>Photo</th>
                                    <th>Is Parent</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
@section('page-script')

<script>
     $(function () {
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: "{{ route('categories.index') }}",
            columns: [
                {data:'id'},
                {data: 'title'},
                
                {data: 'photo', render:function(data) {
                    return `<img src=${data} alt="banner" style="height:25px; width:75px;"/>`;
                }},
                {data: 'is_parent', render:function(data) {
                    return `<span class="badge badge-${data ==1?'danger':'success'}">${data ==1 ?'Yes':'No'}</span>`;
                } },
                {data: 'parent_id', render:function(data, type, row){
                    return `${data}`
                } },
                {data: 'status', render:function(data, type, row){
                    return `<input type="checkbox" ${data == 'active' ?'checked':''} data-size="xs" data-id=${row.id} name="toggle">`
                } },
                {data: 'action', render:function(data, type, row) {
                    return `<span>
                                <button data-id=${row.id} type="button" class="btn btn-success btn-xs edit" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-edit"></i></button>
                                <button data-id=${row.id} type="button" class="btn btn-danger btn-xs delete" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>
                            </span>`;
                }}
            ],
            
        });
        
        table.on('draw', function() {

            $('input[type=checkbox]').bootstrapToggle();
            
        });
        table.on('change','input[name=toggle]', function() {
            var mode = $(this).prop('checked');
            var id = $(this).data('id');
            $.ajax({
                url:`{{route('categories.index')}}/${id}?status=${mode}`,
                type:"PUT",
                data : {
                    _token : "{{csrf_token()}}"
                },
                success: function(status){
                   location.reload();
                    
                },
                error : function(err) {
                    toastr.error(err.status);
                }
            });
        });
        table.on('click', ".delete",function() {
           var id = $(this).data('id');
           swal({
                title: "Apakah anda yakin?",
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Ya, hapus ini!",
                cancelButtonText: "Tidak, batal!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url:`{{route('categories.index')}}/${id}`,
                        type:"DELETE",
                        
                        data : {
                            _token : "{{csrf_token()}}"
                        }
                        
                    });
                    swal("Hapus!", "Data anda telah dihapus. ", 'success');
                    location.reload();
                    
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
           
           // alert("DEL" + id);
        });
        table.on('click', ".edit",function() {
           var id = $(this).data('id');
           window.location.href= `{{route('categories.index')}}/${id}/edit`;
        });
        $('button[type=button]').click(function() {
            window.location.href = "{{route('categories.create')}}";
        });
       
    });
    
</script>
@if(Session::has('success'))

    <script>
        $(document).ready(function(){
            toastr.options = {closeButton:true};
            toastr.success("{{session('success')}}");
        });
    </script>

@endif

@endsection
    
@endsection