@extends('admin.layouts.app')

@section('title', 'Support')

@section('header')
@include('admin.supports.partials.header', compact('supports'))
@endsection

@section('content')

@include('admin.supports.partials.content')

<hr>
<x-pagination :paginator=$supports :appends=$filters />
@endsection
