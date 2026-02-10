<x-app-layout>
    <x-slot name="header">
        <h1 class="m-0 text-dark font-weight-bold">
            Dashboard {{ ucfirst(Auth::user()->role) }}
        </h1>
    </x-slot>

    <div class="container-fluid py-3">
        @if(Auth::user()->role == 'admin')
            @include('dashboards.admin')
        @elseif(Auth::user()->role == 'petugas')
            @include('dashboards.petugas')
        @else
            @include('dashboards.peminjam')
        @endif
    </div>
</x-app-layout>