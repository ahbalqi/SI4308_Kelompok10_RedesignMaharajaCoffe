@extends('adminlte.master')

@section('content')
<div class="ml-3 mt-2">
    <h4>{{ $post->title }}</h4>
    <p>{{  $post->body }}</p>
</div>
@endsection