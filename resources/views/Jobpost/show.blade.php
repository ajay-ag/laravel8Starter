@extends('Jobpost.master')
@section('title', 'Single Job')
@section('section')
<section class="main-section">
  <div class="container">
    <div class="Heading ">
      <h1 class="display-2 text-center">{{$jobpost->title}}</h1>
    </div>
    <div class="post-detsils my-4">
      <p><strong>Name</strong> : {{$jobpost->name}}</p>
      <p><strong>City</strong> : {{$jobpost->city}}</p>
      <p><strong>phone</strong> : {{$jobpost->phonenumber}}</p>
      {!! $jobpost->description !!}
    </div>
  </div>

</section>
@endsection

