@extends('backend.layouts.master')
@section('title', 'Banners Management')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'Add Banner')

@section('content')
<!-- /resources/views/post/create.blade.php -->
 
<h1>Create Post</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
<!-- Create Post Form -->
<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form action="{{route('banners.store')}}" method="POST" id="basic-form" novalidate>
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="title">Title <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title" required data-parsley-minlength="5">
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
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Write some text..">
                                    
                                </textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="condition">Condition</label>
                            <select name="condition" class="form-control show-stick" required>
                                <option value="">--Conditions--</option>
                                <option value="banner {{old('condition')== 'banner' ? 'selected':''}}">Banner</option>
                                <option value="promo {{old('condition')== 'promo' ? 'selected':''}}">Promo</option>
                            </select>

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
            $('#description').summernote();
            $('#lfm').filemanager('image');
        });
    </script>

@endsection