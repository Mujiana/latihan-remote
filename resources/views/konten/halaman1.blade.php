@extends('layout.index')

@section('title', $title)

@section('sidebar')
   @parent
   <li>PHP</li>
@endsection

@section('content')
	<p>{{ $content }}</p>
@stop