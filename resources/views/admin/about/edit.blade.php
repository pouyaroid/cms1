@extends('layouts.app')

@section('title', 'ویرایش درباره ما')

@section('content')
<div class="container mt-5">
    <h2>ویرایش درباره ما</h2>
    @include('about.form', ['about' => $about])
</div>
@endsection
