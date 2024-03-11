<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Artist') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2>Modifier un artiste</h2>

                        <form action="{{ route('artist.update' ,$artist->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="firstname">Prénom</label>
                                <input type="text" id="firstname" name="firstname"
                               @if(old('firstname'))
                                    value="{{ old('firstname') }}"
                                @else
                                    value="{{ $artist->firstname }}"
                                @endif
                                   class="@error('firstname') is-invalid @enderror">

                        @error('firstname')
                                <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                            </div>

                            <div>
                                <label for="lastname">Nom</label>
                                <input type="text" id="lastname" name="lastname"
                               @if(old('lastname'))
                                    value="{{ old('lastname') }}"
                                @else
                                    value="{{ $artist->lastname }}"
                                @endif
                                   class="@error('lastname') is-invalid @enderror">

                        @error('lastname')
                                <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                            </div>

                            <button>Modifier</button>
                       <a href="{{ route('artist.show',$artist->id) }}">Annuler</a>
                        </form>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                           <h2>Liste des erreurs de validation</h2>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <nav><a href="{{ route('artist.index') }}">Retour à l'index</a></nav>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
