<x-app-layout>
    <!-- partie de l'examen pur -->
    <h1>{{ $show->title }} - Videos</h1>

    @if ($show->videos->isEmpty())
        <p>Aucune vidéo pour ce spectacle.</p>
    @else
        @foreach ($show->videos as $video)
            <div>
                <h2>{{ $video->title }}</h2>
                <video src="{{ $video->video_url }}" controls></video>
            </div>
        @endforeach
    @endif

    @can('admin')
        <form action="{{ route('video.store', $show->id) }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Title" required>
            <input type="url" name="video_url" placeholder="Video URL" required>
            <button type="submit">Add Video</button>
        </form>
    @endcan
</x-app-layout>

