@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">
  @include('layouts.aside')

  <main class="flex-1 max-w-7xl mx-auto overflow-auto">
    <h2 class="text-2xl font-bold text-[#235789] mb-2">Equipes - Clique para ver os trabalhos da equipe desejada</h2>

    
    <a href="{{ route('criarEquipe') }}" class="inline-block bg-[#F1D302] hover:bg-[#e5c801] text-black text-sm font-semibold px-4 py-2 rounded mb-6 shadow">
      + Criar Equipe
    </a>

    @if($equipes->isEmpty())
      <p class="text-[#826754]">Nenhuma equipe encontrada.</p>
      @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach ($equipes as $equipe)
            <a href="{{ route('trabalhos',['equipe'=>$equipe->id]) }}" class="bg-white rounded-2xl shadow-xl overflow-hidden hover:bg-[#F1D302] hover:text-black transition w-full">
    
              @if($equipe->imagem)
                <img src="{{ asset($equipe->imagem) }}" alt="Imagem da equipe" class="w-full h-40 object-cover" />
              @else
                <img src="{{ asset('assets/images/default-work.png') }}" alt="Imagem padrão da equipe" class="w-full h-40 object-cover" />
              @endif

            <div class="p-4">
            <h3 class="font-bold text-[#235789] text-lg">{{ $equipe->nome }}</h3>

            <p class="text-[#826754] mb-2">
              Membros:
              @foreach ($equipe->usuarios as $usuario)
                <span>{{ $usuario->nome }}</span>@if (!$loop->last), @endif
              @endforeach
            </p>
          </div>
          </a>
          @endforeach

        </div>
    @endif
  </main>
</div>
@endsection