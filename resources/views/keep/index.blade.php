@extends('keep/_base')

@section('conteudo')
    <p>Bem-vindo ao Little Keep!</p>
    <p><a href="{{ @route('keep.create') }}">Adicionar nota</a></p>
    <hr>
    
    @foreach ($notas as $nota)
        <div style="border:1px solid; background-color: {{ $nota['cor'] }};padding:2px">
            {{ $nota['nota'] }}
        </div>
    @endforeach
@endsection