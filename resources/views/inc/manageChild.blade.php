<ul class="nested mt-1 -mb-1">
    @foreach ($children as $child)
        <li>
            <a href="\folders\{{ $child->id }}">
                <i class="fa fa-folder"></i>
                {{ $child->name }}
                {{-- <small>- 15kb</small> --}}
            </a>
            @if (count($child->children))
                <svg xmlns="http://www.w3.org/2000/svg" class="open-folder h-4 w-4 absolute right-0 top-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="close-folder h-4 w-4 absolute right-0 top-1 hidden"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                @include('inc.manageChild',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
