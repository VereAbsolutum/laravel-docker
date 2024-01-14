@extends('admin.layouts.app')
@section('title', "Detalhe da dúvida {{ $support->id }}")
@section('header')

<h1 class="text-lg text-black-500">Detalhe Dúvida {{ $support->id }}</h1>

@endsection
@section('content')

<ul>
    <li>Assunto: {{ $support->subject }}</li>
    <li>Status: {{ $support->status }}</li>
    <li>Descrição: {{ $support->body }}</li>
    <div>
    </div>
</ul>

<form action="{{ route('supports.destroy', $support->id) }}" method="POST">
    @csrf()
    @method("DELETE")
    <button class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="deletar">Excluir</button>
    <a class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" href="{{ route('supports.index') }}">Sair</a>
</form>

@endsection