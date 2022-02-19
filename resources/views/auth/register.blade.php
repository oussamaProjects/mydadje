@extends('layouts.app')

@section('content')



    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-800"
            style="background-image: url(./assets/img/register_bg_2.png); background-size: 100%; background-repeat: no-repeat;">
        </div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-md rounded-lg bg-bg-color border-0">
                        <div class="flex-auto px-4 lg:px-10 py-8 pt-8">
                            <div class="text-bg-color0 text-center mb-6 font-bold">
                                <small>S'inscrire</small>
                            </div>


                            <form action="{{ route('register') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2"
                                        for="name">Nom</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" autofocus
                                        class="border-0 px-3 py-3 placeholder-bg-color text-gray-800 bg-bg-color rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        placeholder="Nom" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('name'))
                                        <span class="text-amber text-xs">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2" for="email">Adresse
                                        e-mail</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autofocus
                                        class="border-0 px-3 py-3 placeholder-bg-color text-gray-800 bg-bg-color rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        placeholder="Email" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('email'))
                                        <span class="text-amber text-xs">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                {{-- <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2"
                                        for="subsidiary_id">subsidiaries</label>

                                    <select name="subsidiary_id" id="subsidiary_id"
                                        class="border-0 px-3 py-3 placeholder-bg-color text-gray-800 bg-bg-color rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        style="transition: all 0.15s ease 0s;">
                                        <option value="" disabled selected>Choisissez le subsidiaries</option>
                                        @if (count($subsidiaries) > 0)
                                            @foreach ($subsidiaries as $subsidiary)
                                                <option value="{{ $subsidiary->id }}">{{ $subsidiary->subsName }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('subsidiary'))
                                        <span class="text-amber text-xs">{{ $errors->first('subsidiary') }}</span>
                                    @endif
                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2"
                                        for="department_id">Départements</label>

                                    <select name="department_id" id="department_id"
                                        class="border-0 px-3 py-3 placeholder-bg-color text-gray-800 bg-bg-color rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        style="transition: all 0.15s ease 0s;">
                                        <option value="" disabled selected>Choisissez le département</option>
                                    </select>

                                    @if ($errors->has('department'))
                                        <span class="text-amber text-xs">{{ $errors->first('department') }}</span>
                                    @endif
                                </div> --}}


                                @if (count($subsidiaries) > 0)
                                    <div class="mb-2 relative">

                                        <h3 class="text-gray-800 text-md mt-4 mb-4 font-medium title-font uppercase">
                                            Filials
                                        </h3>
                                        <div class="grid sm:grid-cols-1 lg:grid-cols-1">

                                            @foreach ($subsidiaries as $sub)
                                                <div class="font-bold mt-2">{{ $sub->subsName }}</div>

                                                @foreach ($sub->departments()->get() as $dept)
                                                    <label class="text-gray-800 mb-2 font-medium title-font"
                                                        for="{{ $dept['id'] }}_dept">
                                                        <input type="checkbox" name="dept[]" id="{{ $dept['id'] }}_dept"
                                                            value="{{ $dept['id'] }}">
                                                        {{ $dept['dptName'] }}
                                                    </label>
                                                @endforeach
                                            @endforeach

                                        </div>
 

                                    </div>
                                @endif


                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2" for="password">
                                        Mot de passe
                                    </label>
                                    <input id="password" type="password" name="password" required
                                        class="border-0 px-3 py-3 placeholder-bg-color text-gray-800 bg-bg-color rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        placeholder="Mot de passe" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('password'))
                                        <span class="text-amber text-xs">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-800 text-xs font-bold mb-2"
                                        for="password-confirm">Confirmez le mot de passe</label>
                                    <input type="password" name="password_confirmation" id="password-confirm" required
                                        class="border-0 px-3 py-3 placeholder-bg-color text-gray-800 bg-bg-color rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        placeholder="Mot de passe" style="transition: all 0.15s ease 0s;">
                                </div>

                                <div class="text-center mt-6">
                                    <button name="register"
                                        class="bg-gray-800 text-bg-color active:bg-gray-800 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 w-full"
                                        type="submit" style="transition: all 0.15s ease 0s;">
                                        S'inscrire
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="absolute w-full bottom-0 bg-gray-800 pb-4">
            <div class="container mx-auto px-4">
                <hr class="mb-4 border-b-1 border-gray-800">
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full md:w-4/12 px-4">
                        <div class="text-sm text-bg-color font-semibold py-1">
                            Copyright © 2022
                            <a href="https://www.creative-tim.com"
                                class="text-bg-color hover:text-bg-color text-sm font-semibold py-1"> </a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </section>

    <script>
        $(function() {

            $(document).on("click", ".getDepartement", function(e) {
                e.preventDefault();
                $('#ajaxShadow').show();
                $('#ajaxloader').show();

                var subs = $(this).data('subs_id');

                var url = "{{ URL('getDepartements') }}";
                var url = url + "/" + subs;

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        _token: '{{ csrf_token() }}',
                        subs: subs,
                    },
                    success: function(dataResult) {

                        $('#folder_dept_list').empty();
                        var dept_html = '';
                        dept_html +=
                            '<h3 class="text-gray-800 text-md mt-4 mb-4 font-medium title-font uppercase">Departments</h3>';
                        dept_html += '<div class="grid sm:grid-cols-3 lg:grid-cols-5 gap-4">';

                        $.map(dataResult.data.departments, function(departement) {

                            dept_html += '<div class="">';
                            dept_html +=
                                `<input type="checkbox" name="dept[]" id="${departement.id}_dept" value="${departement.id}" >`;
                            dept_html +=
                                `<label class="text-gray-800 mb-2 font-medium title-font" for="${departement.id}_dept">` +
                                departement.dptName + `</label>`;
                            dept_html += '</div>';

                        });

                        dept_html += '</div>';
                        $('#folder_dept_list').html(dept_html);

                        $('#ajaxShadow').hide();
                        $('#ajaxloader').hide();
                    },
                    error: function(error) {
                        console.log(error);
                        // location.reload(true);
                        $('#ajaxShadow').hide();
                        $('#ajaxloader').hide();
                    }
                });

            });
        });
    </script>

@endsection
