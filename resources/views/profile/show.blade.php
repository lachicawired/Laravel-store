@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-900 to-black flex justify-center items-center px-4">
    <div class="bg-gray-800/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full max-w-md text-white border border-gray-700">
        <div class="flex flex-col items-center">
           

            <h1 class="text-3xl font-extrabold mb-1 text-indigo-400">{{ $user->name }}</h1>
            <p class="text-gray-400 text-sm mb-6">Miembro desde {{ $user->created_at->format('d M Y') }}</p>
        </div>

        <div class="space-y-5 border-t border-gray-700 pt-5">
            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 mb-1">Nombre completo</p>
                <p class="text-lg font-semibold">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 mb-1">Correo electrónico</p>
                <p class="text-lg font-semibold">{{ $user->email }}</p>
            </div>

            <div>
                <p class="text-xs uppercase tracking-wider text-gray-400 mb-1">Registrado el</p>
                <p class="text-lg font-semibold">{{ $user->created_at->format('d/m/Y - H:i') }}</p>
            </div>
        </div>

        <div class="pt-6 flex justify-between">
            <a href="{{ route('products') }}"
                class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                ⬅ Volver al inicio
            </a>

          
        </div>
    </div>
</div>
@endsection
