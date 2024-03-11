<x-app-layout>
@section('title', 'Fiche d\'un artiste')

@section('content')
    <h1>{{ $artist->firstname }} {{ $artist->lastname }}</h1>
    <nav><a href="{{ route('artist.index') }}">Retour à l'index</a></nav>
@endsection
</x-app-layout>
