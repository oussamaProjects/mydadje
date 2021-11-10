<div id="modalCategorie"
    class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
    <!-- Modal content -->
    <div class="bg-white w-1/2 h-1/4 p-12">
        <!--Close modal button-->
        <button id="closebuttonCategorie" type="button" class="focus:outline-none float-right">
            <!-- Hero icon - close button -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

        <div>
            <h2 class="text-gray-900 text-xl mb-2 font-medium title-font">Ajouter une categorie</h2>

            <?php echo Form::open(['action' => 'CategoriesController@store', 'method' => 'POST', 'class' => '']); ?>

            <div class="mr-4 relative flex-1">
                <label for="name" class="text-xs opacity-75 scale-75">
                    Nom de dossier
                </label>
                {{ Form::text('name', '', ['id' => 'name', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                @if ($errors->has('name'))
                    <span class="text-red-600 text-xs">{{ $errors->first('name') }}</span>
                @endif
            </div>

        </div>

        <div class="flex">

            {{ Form::submit('Sauvegarder', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}

            <?php echo Form::close(); ?>

        </div>

    </div>
</div>
