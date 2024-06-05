@props(['show'])

@php
    $user = auth()->user();
    $isFavorited = $user && $user->favoriteShows->contains($show->id);
    $isLiked = $user && $user->likedShows->contains($show->id);
@endphp

@if (auth()->check())
    <div x-data="{
        favoriteStatus: '{{ $isFavorited ? 'favorited' : 'unfavorited' }}',
        likeStatus: '{{ $isLiked ? 'liked' : 'unliked' }}'
    }">
        <button @click="toggleFavorite($el)">
            <svg :class="favoriteStatus === 'favorited' ? 'text-green-500' : 'text-gray-500'"
                xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-width="2" d="M22,10.1c0.1-0.5-0.3-1.1-0.8-1.1l-5.7-0.8L12.9,3c-0.1-0.2-0.2-0.3-0.4-0.4C12,2.3,11.4,2.5,11.1,3L8.6,8.2L2.9,9C2.6,9,2.4,9.1,2.3,9.3c-0.4,0.4-0.4,1,0,1.4l4.1,4l-1,5.7c0,0.2,0,0.4,0.1,0.6c0.3,0.5,0.9,0.7,1.4,0.4l5.1-2.7l5.1,2.7c0.1,0.1,0.3,0.1,0.5,0.1l0,0c0.1,0,0.1,0,0.2,0c0.5-0.1,0.9-0.6,0.8-1.2l-1-5.7l4.1-4C21.9,10.5,22,10.3,22,10.1z"/>
            </svg>
        </button>
        <button @click="toggleLike($el)">
            <svg :class="likeStatus === 'liked' ? 'text-red-500' : 'text-gray-500'" xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path
                    d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z"
                     stroke-width="2" />
            </svg>
        </button>
    </div>
@else
    <p>Vous devez être connecté pour utiliser ces fonctionnalités.</p>
@endif

@push('scripts')
    <script>
        function toggleFavorite(el) {
            fetch('{{ route('show.favorite', $show) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json()).then(data => {
                el.querySelector('svg').classList.toggle('text-green-500', data.status === 'favorited');
                el.querySelector('svg').classList.toggle('text-gray-500', data.status !== 'favorited');
                el.__x.$data.favoriteStatus = data.status;
            });
        }

        function toggleLike(el) {
            fetch('{{ route('show.like', $show) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json()).then(data => {
                el.querySelector('svg').classList.toggle('text-red-500', data.status === 'liked');
                el.querySelector('svg').classList.toggle('text-gray-500', data.status !== 'liked');
                el.__x.$data.likeStatus = data.status;
            });
        }
    </script>
@endpush


