@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>
    <form action="/" method="GET">
        <input type="text" name="search" id="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<br>
<div id="events-container" class="cold-md-12">
    @if ($search)
        <h2>Buscando por: {{$search}}</h2>
    @else
        <h2>Proximos Eventos</h2>
        <p class="subtitle">Veja os Eventos dos Proximos Dias</p>
    @endif


    <div id="cards-container" class="row">
        @foreach ($events as $event)
            <div class="card col-md-3">
                <img src="/image/events/{{$event->image}}" alt="{{$event->title}}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h5 class="card-title">{{$event->title}}</h5>
                    <p class="card-participants">X Participantes</p>
                    <a href="/events/{{$event->id}}" class="btn btn-primary">Saiba Mais</a>
                </div>
            </div>
        @endforeach
        @if (count($events) == 0 && $search)
            <p>Não foi possivel encontrar nenhum evento com titulo {{$search}}! <a href="/">Ver todos</a></p>
        @elseif (count($events) == 0)
            <p>Não ha eventos disponíveis... <a href="/">Ver todos</a></p>
        @endif
    </div>
</div>


@endsection

