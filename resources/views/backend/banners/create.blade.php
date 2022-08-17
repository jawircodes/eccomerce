@extends('backend.layouts.master')
@section('title', 'Banners Management')
@section('parentPageTitle', 'Admin')
@section('childPageTitle', 'Add Banner')

@section('content')

<div class="row clearfix">

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="title">Title <span>*</span></label>
                            <input type="text" class="form-control" name="title" id="title">
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
                    
                    <div class="col-sm-12">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="submit" class="btn outline-secondary">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
 

</div>

@endsection