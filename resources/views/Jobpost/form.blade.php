@extends('Jobpost.master')
@section('title', 'Create Job')
@section('section')
<section class="main-section">
  <div class="container">
    <div class="Heading ">
      <h1 class="display-2 text-center">Submit a Job</h1>
      <div class="row">
        <div class="col-md-12">
          <p class="small-text">
            Need a logo designed, a usability study, or an interface-facelift? Our diverse community and extended network have got you covered.
          </p>
        </div>
      </div>
      <p>About Your Job</p>
    </div>
  <hr>
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{route('form.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title"  value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name"  value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <hr>
          <div class="form-group">
            <label><strong>Description</strong></label>
            <textarea class="ckeditor form-control" name="description" placeholder="Description">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
          </div>
          <hr>
          <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="city" value="{{ old('city') }}">
            @if ($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="price" value="{{ old('price') }}">
            @if ($errors->has('price'))
                <span class="text-danger">{{ $errors->first('price') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="Phone number">Phone number</label>
            <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Phone number" value="{{ old('phonenumber') }}">
            @if ($errors->has('phonenumber'))
                <span class="text-danger">{{ $errors->first('phonenumber') }}</span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit Your Job</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection