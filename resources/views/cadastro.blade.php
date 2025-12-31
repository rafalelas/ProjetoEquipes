@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h1 class="text-2xl font-bold text-[#235789] mb-6">Cadastro</h1>
        <form method="POST" action="{{ route('cadastroSubmit') }}" class="space-y-4">
            @csrf
            <div>
                <label for="nome" class="block mb-1 font-semibold text-[#235789]">Nome</label>
                <input type="text" name="nome" placeholder="Nome completo" required class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F1D302]">
            </div>
            <div>
                <label for="email" class="block mb-1 font-semibold text-[#235789]">Email</label>
                <input type="email" name="email" placeholder="seuemail@exemplo.com" required class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F1D302]">
            </div>
            <div>
                <label for="password" class="block mb-1 font-semibold text-[#235789]">Senha</label>
                <input type="password" name="password" placeholder="********" required class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F1D302]">
            </div>

            <div>
                <label for="password_confirmation" class="block mb-1 font-semibold text-[#235789]">Confirmar Senha</label>
                <input type="password" name="password_confirmation" placeholder="********" required class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#F1D302]">
            </div>
            <button type="submit" class="w-full bg-[#F1D302] text-black font-semibold p-3 rounded-lg hover:bg-[#e6c800] transition">Cadastrar</button>
        </form>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        
        <p class="mt-4 text-sm text-center text-[#826754]">
            Já tem conta? <a href="{{ route('login') }}" class="text-[#235789] underline">Faça login</a>
        </p>
    </div>
</div>
@endsection