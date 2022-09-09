@extends('backend.layouts.master')
@section('title', 'Category Management')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'Edit Category')

@section('content')

<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form action="{{route('categories.update', $category->id)}}" method="POST" id="basic-form" novalidate>
                    @csrf
                    @method('put')
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="title">Title <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title" required value="{{$category->title}}">
                            </div>
                        </div>
                       
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea class="form-control" name="summary" id="summary" placeholder="Write some text..">
                                    {{$category->summary}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="isparent">Is parent : </label>
                                <input type="checkbox" name="is_parent" value="{{$category->is_parent}}"  id="is_parent" {{$category->is_parent ? 'checked':''}}> Yes
                               
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 {{$category->is_parent?'d-none':''}}" id="parent_cat_div">
                            <label for="parent_id">Parent Category</label>
                            <select name="parent_id" class="form-control show-stick" data-parsley-required="false">
                                <option value="">--Parent Category--</option>
                              
                                @foreach($parentCategories as $pCat)
                                <option value="{{$pCat->id}}" {{$pCat->id == $category->parent_id? 'selected':''}}>{{$pCat->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <b>Photo</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" id="lfm" style="cursor:pointer;" data-input="thumbnail">
                                    <span class="input-group-text"><i class="fa fa-picture-o"></i></span>
                                </div>
                                <input type="text" class="form-control" name="photo" placeholder="Belum ada gambar yang diinput" required id="thumbnail" value="{{$category->photo}}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="condition">Status</label>
                            <select name="status" class="form-control show-stick" required>
                                <option value="">--Status--</option>
                                <option value="active" {{ $category->status == 'active' ? 'selected':''}}>Active</option>
                                <option value="inactive" {{$category->status == 'inactive' ? 'selected':''}}>Inactive</option>
                            </select>
                        </div>
                        
                        
                        
                    </div>
                    <div class="col-sm-12">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('categories.index')}}" class="btn outline-secondary">Cancel</a>
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
        
        $('#is_parent').change(function(e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            if(is_checked) {
                $('#parent_cat_div').addClass('d-none');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
            
        });

        $('#basic-form').parsley();
        $('#summary').summernote();
        $('#lfm').filemanager('image');
    });
</script>
@endsection