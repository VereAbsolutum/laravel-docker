@extends('admin.layouts.app')
@section('title', 'Editar')
@section('header')

<h1 class="text-lg text-black-500">Editar Dúvida {{ $support->id }}</h1>

@endsection
@section('content')

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @method('PUT')
    @include('admin.supports.partials.form', [
    'support' => $support,
    'buttonLabel' => 'Atualizar'
    ])
</form>

@endsection