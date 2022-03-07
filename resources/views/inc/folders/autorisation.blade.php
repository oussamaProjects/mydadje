@hasanyrole('Root|Admin')
    @if (count($subs) > 0)
        <div class="mb-2 relative">
            <h3 class="mb-2 text-xl font-medium uppercase">Autorisation</h3>
            <div class="flex flex-row gap-4 flex-wrap">

                @foreach ($subs as $sub)
                    <div>
                        <div class="mb-2"> <span class="text-main font-medium">{{ $sub->subsName }}</span></div>
                        @foreach ($sub->departments()->get() as $dept)
                            @php
                                $dept_permission = null;
                                if (isset($doc)) {
                                    $dept_permission = $doc
                                        ->department()
                                        ->where('id', $dept['id'])
                                        ->first();
                                } elseif (isset($folder)) {
                                    $dept_permission = $folder
                                        ->department()
                                        ->where('id', $dept['id'])
                                        ->first();
                                }
                                $permission = $dept_permission != null ? $dept_permission->pivot->permission_for : -1;
                                // echo $permission;
                            @endphp

                            <div class="mb-">
                                <div class="mb-2 text-sm">Département <span
                                        class="font-bold">{{ $dept['dptName'] }}</span></div>
                                <div class="mb-2">

                                    <div>
                                        <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                            class="opacity-0 absolute"
                                            id="folder_sub_{{ $sub['id'] }}_{{ $dept['id'] }}_none"
                                            value="{{ $dept['id'] }}_none" checked>
                                        <label
                                            class="select-none inline-block text-xs font-light text-bg-color bg-secondary hover:text-main hover:bg-tertiary transition text-center px-2 py-1 rounded-sm w-32 cursor-pointer w-full"
                                            for="folder_sub_{{ $sub['id'] }}_{{ $dept['id'] }}_none">Aucun
                                            utilisateur</label>
                                    </div>

                                    <div>
                                        <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                            class="opacity-0 absolute" value="{{ $dept['id'] }}_all"
                                            id="folder_sub_{{ $sub['id'] }}_{{ $dept['id'] }}_all">
                                        <label
                                            class="select-none inline-block text-xs font-light text-bg-color bg-secondary hover:text-main hover:bg-tertiary transition text-center px-2 py-1 rounded-sm w-32 cursor-pointer w-full"
                                            for="folder_sub_{{ $sub['id'] }}_{{ $dept['id'] }}_all">Tous les
                                            utilisateurs</label>
                                    </div>

                                    <div class="mb-2">
                                        <input type="radio" name="permissions_{{ $dept['id'] }}[]"
                                            class="opacity-0 absolute"
                                            id="folder_sub_{{ $sub['id'] }}_{{ $dept['id'] }}_admins"
                                            value="{{ $dept['id'] }}_admins">
                                        <label
                                            class="select-none inline-block text-xs font-light text-bg-color bg-secondary hover:text-main hover:bg-tertiary transition text-center px-2 py-1 rounded-sm w-32 cursor-pointer w-full"
                                            for="folder_sub_{{ $sub['id'] }}_{{ $dept['id'] }}_admins">Les
                                            administrateurs</label>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>
    @endif
@endhasanyrole
