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
                        {data: 'action', render:function() {
                            return 'edit, del';
                        }}
                    ]
                });
                table.on('draw', function() {

                    $('input[type=checkbox]').bootstrapToggle();
                    $('input[name=toggle]').change(function() {

                        var mode = $(this).prop('checked');
                        var id = $(this).data('id');
                        $.ajax({
                            url:"",
                            type:"POST",
                            data : {
                                _token : "{{csrf_token()}}",
                                mode:mode,
                                id:id
                            },
                            success: function(status){
                                console.log('status');
                            }
                        });
                    });
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