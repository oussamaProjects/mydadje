@if (session('success') || session('failure'))
    <div id="notification"
        class="text-bg-color px-6 pt-2 pb-3 border-0 rounded mb-4 {{ !is_null(session('success')) ? 'bg-secondary' : 'bg-amber' }} absolute top-16 right-4 z-50">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            {{ session('success') ?? session('failure') }}
        </span>
        <button
            class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-2 mr-6 outline-none focus:outline-none"
            onclick="closeAlert(event)">
            <span>×</span>
        </button>
    </div>
@endif
 