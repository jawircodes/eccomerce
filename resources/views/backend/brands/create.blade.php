@extends('backend.layouts.master')
@section('title', 'Add Brand')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'Brand Management')

@section('content')

<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form action="{{route('brands.store')}}" method="POST" id="basic-form" novalidate>
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="title">Title <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <b>Photo</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" id="lfm" style="cursor:pointer;" data-input="thumbnail">
                                    <span class="input-group-text"><i class="fa fa-picture-o"></i></span>
                                </div>
                                <input type="text" class="form-control" name="photo" placeholder="Belum ada gambar yang diinput" required id="thumbnail">
                            </div>
                        </div>
                       
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="condition">Status</label>
                            <select name="status" class="form-control show-stick" required>
                                <option value="">--Status--</option>
                                <option value="active {{old('status')== 'active' ? 'selected':''}}">Active</option>
                                <option value="inactive {{old('status')== 'inactive' ? 'selected':''}}">Inactive</option>
                            </select>
                        </div>
                        
                        
                        
                    </div>
                    <div class="col-sm-12">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" class="btn outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 

</div>
@endsection

@section('page-script')

<script>
    $(document).ready(function(){
        $('#basic-form').parsley();
       
        $('#lfm').filemanager('image');
    });
</script>
@endsection