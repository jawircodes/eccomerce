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
                        {data: 'title', name: 'title'},
                        {data: 'description', name: 'description'},
                        {data: 'photo', name: 'photo'},
                        {data: 'condition', name: 'condition'},
                        {data: 'status', name: 'status'},
                    ]
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