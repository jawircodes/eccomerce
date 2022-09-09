@extends('backend.layouts.master')
@section('title', 'Edit Banner')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'Banner Management')

@section('content')

<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form action="{{route('brands.update', $brand->id)}}" method="POST" id="basic-form" novalidate>
                    @csrf
                    @method('put')
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="title">Title <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title" required value="{{$brand->title}}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="photo">Photo</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chose
                                    </a>
                                </span>
                                <input id="thumbnail"  class="form-control" type="text" name="photo" required value="{{$brand->photo}}">
                                
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                       
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="condition">Status</label>
                            <select name="status" class="form-control show-stick" required>
                                <option value="">--Status--</option>
                                <option value="active" {{$brand->status == 'active' ? 'selected':''}}>Active</option>
                                <option value="inactive" {{$brand->status == 'inactive' ? 'selected':''}}>Inactive</option>
                            </select>
                        </div>
                        
                        
                        
                    </div>
                    <div class="col-sm-12">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('brands.index')}}" class="btn outline-secondary">Cancel</a>
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