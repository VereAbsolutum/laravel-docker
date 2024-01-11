<h1>Dúvida {{ $support->id }}</h1>

@if ($errors->any())
@foreach($errors->all() as $error)
{{ $error }}
@endforeach
@endif

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    <!-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> -->
    @csrf
    @method('PUT')
    <div>
        <input type="text" placeholder="Assunto" name="subject" value="{{ $support->subject }}">
    </div>
    <div>
        <textarea placeholder="Descrição" col="30" rows="5" name="body">{{ $support->body }}</textarea>
    </div>
    <div>
        <button type="submit">Atualizar</button>
    </div>
</form>
<hr>
<div>
    <a href="{{ route('supports.index') }}">Sair</a>
</div>