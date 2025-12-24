@if(session('toast'))
<div 
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition
    class="fixed top-6 right-6 z-50 px-5 py-3 rounded-lg shadow-lg text-sm font-semibold
        @if(session('toast.type') === 'success') bg-green-600 text-white
        @elseif(session('toast.type') === 'error') bg-red-600 text-white
        @elseif(session('toast.type') === 'warning') bg-yellow-500 text-black
        @else bg-blue-600 text-white
        @endif
    "
>
    {{ session('toast.message') }}
</div>
@endif
