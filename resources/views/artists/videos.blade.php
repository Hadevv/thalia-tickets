<x-app-layout>
    <h1>Vidéos des spectacles de {{ $artist->name }}</h1>

    @foreach ($shows as $show)
        <h2>{{ $show->title }}</h2>
        @if ($show->videos->isEmpty())
            <p>Aucune vidéo pour ce spectacle.</p>
        @else
            @foreach ($show->videos as $video)
                <div>
                    <h3>{{ $video->title }}</h3>
                    <video src="{{ $video->video_url }}" controls></video>
                </div>
            @endforeach
        @endif
    @endforeach
</x-app-layout>

