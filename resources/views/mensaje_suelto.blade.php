@extends('layouts.app')

@section('content')
<div class="container mt-2">
  @if(Auth::user()->darkMode)
    <div class="text-center text-white">
  @else
    <div class="text-center">
  @endif
      <div class="container alert alert-success">
        {{ phpinfo() }}
      </div>
    </div>
</div>
@endsection
