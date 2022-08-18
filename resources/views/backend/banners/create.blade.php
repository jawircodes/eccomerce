@extends('backend.layouts.master')
@section('title', 'Banners Management')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'Add Banner')
    @section('css-module')
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/dist/summernote.css') }}"/>
    @endsection

@section('content')

<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form action="{{route('banners.store')}}" method="POST">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="title">Title <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="description">Photo</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="filepath">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="title" id="description" placeholder="Write some text.."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="condition">Condition</label>
                            <select name="condition" class="form-control show-stick">
                                <option value="">--Conditions--</option>
                                <option value="banner {{old('condition')== 'banner' ? 'selected':''}}">Banner</option>
                                <option value="promo {{old('condition')== 'promo' ? 'selected':''}}">Promo</option>
                            </select>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="condition">Status</label>
                            <select name="status" class="form-control show-stick">
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
@section('js-module')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{ asset('assets/vendor/summernote/dist/summernote.js') }}"></script>
@endsection

@section('page-script')
<script>
    $('#lfm').filemanager('image');
    $('#description').summernote();
</script>
@endsection
@endsection