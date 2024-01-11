<h1>Nova Dúvida</h1>

@if ($errors->any())
@foreach($errors->all() as $error)
{{ $error }}
@endforeach
@endif

<form action="{{ route('supports.store') }}" method="POST">
    <!-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> -->
    @csrf
    <div>
        <input type="text" placeholder="Assunto" name="subject" value="{{ old('subject') }}">
    </div>
    <div>
        <textarea placeholder="Descrição" col="30" name="body">{{ old('body') }}</textarea>
    </div>
    <div>
        <button type="submit">Enviar</button>
    </div>
</form>
<hr>
<div>
    <a href="{{ route('supports.index') }}">Sair</a>
</div>