<h1>Nova Dúvida</h1>

<form action="{{ route('supports.store') }}" method="POST">
    <!-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> -->
    @csrf
    <div>
        <input type="text" placeholder="Assunto" name="subject">
    </div>
    <div>
        <textarea placeholder="Descrição" col="30" name="body"></textarea>
    </div>
    <div>
        <button type="submit">Enviar</button>
    </div>
</form>