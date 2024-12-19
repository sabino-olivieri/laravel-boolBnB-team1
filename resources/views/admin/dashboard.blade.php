@extends('layouts.admin')
@section('content')
    {{-- Welcome --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="text-center">
                    @if (session('status'))
                        <div class="" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="letter-spacing">
                        @php
                            $username = ucfirst(strtolower(Auth::user()->name));
                        @endphp
                        {{ __('Benvenuto') }} {{ $username }} {{ __('!') }}<br>
                        {{ __('Ecco il tuo pannello di controllo:') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    {{-- / Welcome --}}

    {{-- CARD --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Card Appartamenti -->
            @php
                use App\Models\Flat;
            @endphp
            @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 180px; width: 200px">
                    <a href="{{ route('admin.flats.index') }}"
                        class="card text-center h-100 text-decoration-none text-dark">
                        <div
                            class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                            <i class="fa-solid fa-house-user fa-2x mb-3"></i>
                            <h5 class="card-title">I tuoi appartamenti</h5>
                        </div>
                    </a>
                </div>
            @endif
            <!-- Card Aggiungi Appartamento -->
            <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 180px; width: 200px">
                <a href="{{ route('admin.flats.create') }}"
                    class="card text-center h-100 text-decoration-none text-dark">
                    <div
                        class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                        <i class="fa-solid fa-house-medical fa-2x mb-3"></i>
                        <h5 class="card-title">Aggiungi appartamento</h5>
                    </div>
                </a>
            </div>
            <!-- Card Messaggi -->
            @if (count(Flat::where('user_id', Auth::id())->get()) >= 1)
                <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 180px; width: 200px">
                    <a href="{{ route('admin.messages.index') }}"
                        class="card text-center h-100 text-decoration-none text-dark">
                        <div
                            class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                            <i class="fa-solid fa-envelope fa-2x mb-3"></i>
                            <h5 class="card-title">Messaggi</h5>
                        </div>
                    </a>
                </div>
            @endif
            <!-- Card Logout -->
            <div class="col-12 col-md-6 col-lg-4 mb-4" style="height: 180px; width: 200px">
                <a href="{{ route('logout') }}" class="card text-center h-100 text-decoration-none text-dark"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div
                        class="card-body d-flex flex-column justify-content-center align-items-center ms_color-dashboard hover-effect">
                        <i class="fa-solid fa-arrow-right-from-bracket fa-2x mb-3"></i>
                        <h5 class="card-title">Logout</h5>
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        {{-- /CARD --}}

        @php
            use App\Models\Message;
            use Carbon\Carbon;
            // Id degli appartamenti dell'utente loggato
            $flatIds = Flat::where('user_id', Auth::id())->pluck('id');

            // I messaggi solo dell'ultimo anno
            $hasMessages = Message::whereIn('flat_id', $flatIds)
                ->where('created_at', '>=', Carbon::now()->subYear())
                ->exists();
        @endphp

        @if ($flatIds->count() > 0)
            <div class="row mt-3 justify-content-center align-items-center">
                @if ($hasMessages)
                    <h5 class="text-center">L'andamento dei tuoi appartamenti : <br></h5>
                    @include('admin.partials.graph_flats')
                @endif
            </div>
        @endif
    </div>
@endsection
