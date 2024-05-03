@foreach($representations as $representation)
    <!-- Afficher les détails de la représentation -->

    <!-- Modal pour la revue de la représentation -->
    <x-modal name="reviewModal_{{ $representation->id }}" :show="true">
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <h3>Laisser un commentaire pour le spectacle {{ $representation->show->title }}</h3>
            <label for="review">Votre revue :</label>
            <textarea name="review" id="review" rows="4" cols="50"></textarea>
            <label for="rating">Votre note :</label>
            <select name="rating" id="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <input type="hidden" name="show_id" value="{{ $representation->show->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="representation_id" value="{{ $representation->id }}">
            <button type="submit">Envoyer</button>
        </form>
    </x-modal>
@endforeach
# Compare this snippet from resources/views/components/modal-review.blade.php:
@foreach($representations as $representation)
    <x-modal name="reviewModal_{{ $representation->id }}" :show="true">
        <!-- Formulaire pour laisser un commentaire pour le spectacle -->
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <!-- Inputs pour la revue et la note -->
            <h3>Laisser un commentaire pour le spectacle {{ $representation->show->title }}</h3>
            <label for="review">Votre revue :</label>
            <textarea name="review" id="review" rows="4" cols="50"></textarea>
            <label for="rating">Votre note :</label>
            <select name="rating" id="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <!-- Inputs cachés pour l'ID du spectacle et l'ID de l'utilisateur -->
            <input type="hidden" name="show_id" value="{{ $representation->show->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="representation_id" value="{{ $representation->id }}">
            <!-- Bouton de soumission -->
            <button type="submit">Envoyer</button>
        </form>
    </x-modal>
@endforeach
