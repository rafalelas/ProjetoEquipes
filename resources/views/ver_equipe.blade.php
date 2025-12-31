@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">
  @include('layouts.aside')

  <main class="flex-1 max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 overflow-auto">

    @if($equipe->imagem)
      <img src="{{ asset($equipe->imagem) }}" alt="Imagem da Equipe" class="w-32 h-32 object-cover rounded-full mx-auto mb-4 shadow">
    @endif

    <h1 class="text-3xl font-bold text-[#235789] mb-4 text-center">{{ $equipe->nome }}</h1>

    <section class="mb-6">
      <h2 class="text-xl font-semibold text-[#235789] mb-2">Membros da equipe</h2>
      <ul class="list-disc list-inside text-[#826754]">
        @foreach($equipe->usuarios as $usuario)
          <li>{{ $usuario->nome }} ({{ $usuario->email }})</li>
        @endforeach
      </ul>
    </section>

    <a href="{{ route('editarEquipe', ['equipe' => $equipe->id]) }}" class="inline-block bg-[#F1D302] hover:bg-[#e5c801] text-black font-semibold px-4 py-2 rounded shadow">
      Editar Equipe
    </a>

  </main>
</div>
@endsection
