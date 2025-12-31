@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">
  @include('layouts.aside')

  <main class="flex-1 max-w-7xl mx-auto overflow-auto">
    <h2 class="text-2xl font-bold text-[#235789] mb-2">Trabalhos da equipe: {{ $equipe->nome }}</h2>
    
    <a href="{{ route('criarTrabalho', ['equipe'=>$equipe->id]) }}" class="inline-block bg-[#F1D302] hover:bg-[#e5c801] text-black text-sm font-semibold px-4 py-2 rounded mb-6 shadow">
      + Criar Trabalho
    </a>

    @if ($trabalhos->isEmpty())
      <p class="text-[#826754]">Nenhum trabalho encontrado para esta equipe.</p>
    @else
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($trabalhos as $trabalho)
          <a href="{{ route('infoTrabalho', ['id' => $trabalho->id]) }}"
          class="block bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition duration-200">

            <img src="{{ asset('assets/images/default-work.png') }}" alt="Imagem trabalho" class="w-full h-48 object-cover" />

            <div class="p-4">
              <h3 class="font-bold text-[#235789] text-lg">{{ $trabalho->titulo }}</h3>
              <p class="text-[#826754]">{{ $trabalho->descricao }}</p>
            </div>
          </a>
        @endforeach
      </div>
    @endif
  </main>
</div>
@endsection