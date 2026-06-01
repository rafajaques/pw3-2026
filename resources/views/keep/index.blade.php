@extends('keep/_base')

@section('conteudo')
    <p>Bem-vindo ao Little Keep!</p>
    <p><a href="{{ @route('keep.create') }}">Adicionar nota</a></p>
    <hr>
    
    @if (session('mensagem'))
        <div>👍 {{ session('mensagem') }}</div>
    @endif

    @foreach ($notas as $nota)
        <div style="border:1px solid; background-color: {{ $nota['cor'] }};padding:2px">
            {{ $nota['nota'] }}
            <br><br>
            {{ \Carbon\Carbon::parse($nota['created_at'])->diffForHumans() }}
            <br>
            <a href="{{ route('keep.edit', $nota['id']) }}">📝</a>
            <a href="{{ route('keep.delete', $nota['id']) }}">❌</a>
        </div>
    @endforeach
@endsection