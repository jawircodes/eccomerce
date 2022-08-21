@extends('backend.layouts.master')
@section('title', 'Banners Management')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'All Banners')


@section('content')

<div class="row clearfix">

    <div class="col-lg-12">
    
        <div class="card">
            <div class="header">
                <h2>Basic Table <small>Basic example without any additional modification classes</small> </h2>                            
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover  dataTable table-custom" id="data-table">
                        <thead>
                            <tr>    
                                <th>id</th>   
                                <th>Title</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Condition</th>
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
    @section('page-script')

        <script>
             $(function () {
                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('banners.index') }}",
                    columns: [
                        {data:'id'},
                        {data: 'title'},
                        {data: 'description', render:function(data) {
                            return `<div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;white-space: nowrap;">${data}</div>`;
                        }},
                        {data: 'photo', render:function(data) {
                            return `<img src=${data} alt="banner" style="height:25px; width:75px;"/>`;
                        }},
                        {data: 'condition', render:function(data) {
                            return `<span class="badge badge-${data =='banner'?'success':'warning'}">${data}</span>`;
                        } },
                        {data: 'status', render:function(data, type, row){
                            return `<input type="checkbox" ${data == 'active' ?'checked':''} data-size="xs" data-id=${row.id} name="toggle">`
                        } },
                        {data: 'action', render:function(data, type, row) {
                            return `<span>
                                        <button data-id=${row.id} type="button" class="btn btn-success btn-xs edit" title="Save"><span class="sr-only">Edit</span> <i class="fa fa-edit"></i></button>
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
                        url:`{{route('banners.index')}}/${id}?status=${mode}`,
                        type:"PUT",
                        data : {
                            _token : "{{csrf_token()}}"
                        },
                        success: function(status){
                            toastr.success(`Banner berhasil di ${mode==true?'Akifkan':'Nonaktifkan'}`);
                            
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
                                url:`{{route('banners.index')}}/${id}`,
                                type:"DELETE",
                                data : {
                                    _token : "{{csrf_token()}}"
                                },
                                success: function(data){
                                    swal("Hapus!", "Data anda telah dihapus. ", 'success');
                                    table.ajax.reload();
                                },
                                
                            });
                            
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
                   
                   // alert("DEL" + id);
                });
                table.on('click', ".edit",function() {
                   var id = $(this).data('id');
                    alert("EDIT" + id);
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