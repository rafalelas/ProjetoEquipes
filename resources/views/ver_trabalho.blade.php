@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">
  @include('layouts.aside')

  <main class="flex-1 max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 overflow-auto">
    <h1 class="text-3xl font-bold text-[#235789] mb-4">{{ $trabalho->titulo }}</h1>
    <div class="flex justify-end mb-4">
        <a href="{{ route('editarTrabalho', ['trabalho' => $trabalho->id]) }}"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow transition">
        Editar Trabalho
      </a>
    </div>
    <p class="text-[#826754] mb-4">{{ $trabalho->descricao }}</p>

    <img src="{{ asset($trabalho->equipe->imagem ?? 'assets/images/default-work.png') }}" alt="Imagem trabalho" class="w-full max-h-64 object-cover rounded mb-6">

    <section class="mb-6">
      <h2 class="text-xl font-semibold text-[#235789] mb-2">Membros da equipe</h2>
      <ul class="list-disc list-inside text-[#826754]">
        @foreach($trabalho->equipe->usuarios as $usuario)
          <li>{{ $usuario->nome }}</li>
        @endforeach
      </ul>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold text-[#235789] mb-2">Versões e comentários</h2>
      @foreach($trabalho->versoes as $versao)
        <div class="mb-5 p-4 border rounded bg-[#f9f9f9]">
          <p><strong>Versão #{{ $versao->numero_versao }}</strong></p>
          <p>Resumo: {{ $versao->resumo_alteracoes }}</p>
          @if($versao->arquivos)
            <a href="{{ asset($versao->arquivos) }}" target="_blank" class="text-blue-600 underline">Download do arquivo</a>
          @endif
          <p class="text-xs text-gray-500 mb-3"> Criado em: {{ \Carbon\Carbon::parse($versao->criado_em)->format('d/m/Y H:i') }}</p>
          <div class="mb-3 border-t pt-3">
            <h3 class="font-semibold mb-2">Comentários</h3>
            @foreach($versao->comentarios as $comentario)
              <div class="mb-2 p-2 bg-[#eef2f7] rounded">
                <p>
                  <strong>{{ $comentario->usuario->nome ?? 'Usuário desconhecido' }}</strong>
                  comentou em {{ \Carbon\Carbon::parse($comentario->criado_em)->format('d/m/Y H:i') }}:
                </p>
                <p>{{ $comentario->comentario }}</p>
              </div>
            @endforeach

            <form action="{{ route('comentarios.salvar', ['versao' => $versao->id]) }}" method="POST" class="mt-2">
              @csrf
              <textarea name="comentario" rows="2" class="w-full p-2 border rounded" placeholder="Escreva um comentário..." required></textarea>
              <button type="submit" class="mt-1 bg-[#F1D302] hover:bg-[#e5c801] text-black font-semibold px-3 py-1 rounded shadow">Enviar</button>
            </form>
          </div>
        </div>
      @endforeach
    </section>

  </main>
</div>
@endsection