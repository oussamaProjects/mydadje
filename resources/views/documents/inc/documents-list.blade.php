<div class="flex gap-4 mt-2 mb-4 mx-4">

    <div class="flex-initial border font-light bg-white">
        @include('inc.docs.folders-tree', ['currentFolder' => $folder ?? null])
    </div>

    <div class="flex-1 border bg-white shadow-md">
        <div class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">
            Les documents dans <span class="text-tertiary">{{ isset($folder) ? $folder->name : 'Root' }}</span>
        </div>
        <div class="flex flex-row flex-wrap p-2">
            <table class="table-auto w-full text-left bg-colorspace-no-wrap">
                <thead>
                    <tr class="border-b mb-2 pb-2">
                        <td class="px-1 py-1 text-main text-xs"> </td>
                        <td class="px-1 py-1 text-main text-xs">Nom</td>
                        <td class="px-1 py-1 text-main text-xs">Version</td>
                        <td class="px-1 py-1 text-main text-xs">Taille</td>
                        <td class="px-1 py-1 text-main text-xs">Date modification	</td>
                        <td class="px-1 py-1 text-main text-xs">Type</td>
                    </tr>

                </thead>
                <tbody>

                    @if (isset($docs) && count($docs) > 0)
                        @foreach ($docs as $doc)
                            @include('inc.docs.doc',['doc' => $doc])
                        @endforeach
                    @else
                        @include('inc.no-records.docs' )
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>