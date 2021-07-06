@extends('Jobpost.master')
@section('title', 'Job')
@section('section')
<section class="main-section">
<div class="container">
  <div class="Heading">
    <h1 class="display-2 text-center">Job</h1>
    <div class="row">
      <div class="col-md-6">
        <p class="small-text">
          Need a logo designed, a usability study, or an interface-facelift? Our diverse community and extended network have got you covered.
        </p>
      </div>
      <div class="col-md-6">
        <p>
          <a href="{{route('form.create')}}" class="btn btn-sm btn btn-primary">Post A Job</a>
          We'll review your posting as soon as we can! Free and paid gigs welcome.
        </p>
      </div>
    </div>
  </div>
  <hr>
  <div class="view_job py-2">
    <div class="row">
    @foreach ($jobpost as $post)
      <div class="col-md-8 offset-md-2">
      <a href="{{route('form.show',$post->id)}}"><span class="display-4">{{$post->title}}</span></a>
      <p>{{$post->name}}</p>
      </div>
    @endforeach
    </div>
  </div>
</div>
</section>
@endsection