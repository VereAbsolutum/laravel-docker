<h1>Supports</h1>

<a href="{{ route('supports.create') }}">Novo Item</a>

<table>
    <thead>
        <th>assunto</th>
        <th>status</th>
        <th>descrição</th>
        <th></th>
    </thead>
    <tbody>
        @foreach($supports as $support)
        <tr>
            <td>{{$support->subject}}</td>
            <td>{{$support->status}}</td>
            <td>{{$support->body}}</td>
            <td>
                <a href="{{ route('supports.show', $support->id) }}">ir</a>
                |
                <a href="{{ route('supports.edit', $support->id) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>