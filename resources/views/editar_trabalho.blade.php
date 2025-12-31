@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">
  @include('layouts.aside')

  <main class="flex-1 max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-2xl font-bold text-[#235789] mb-4">Editar Trabalho</h2>


  @if($trabalho->equipe && $trabalho->equipe->imagem)
    <div class="mb-6 text-center">
      <p class="text-sm font-medium text-[#235789] mb-1">Imagem da Equipe</p>
      <img src="{{ asset($trabalho->equipe->imagem) }}" alt="Imagem da equipe" class="w-32 h-32 object-cover rounded-full mx-auto shadow">
    </div>
  @endif


    <form action="{{ route('editarTrabalhoSubmit', ['trabalho'=>$trabalho->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-4">
        <label for="titulo" class="block font-semibold text-sm text-[#235789]">Título</label>
        <input type="text" id="titulo" name="titulo" value="{{ $trabalho->titulo }}" class="w-full p-2 rounded border shadow-sm" required>
      </div>

      <div class="mb-4">
        <label for="descricao" class="block font-semibold text-sm text-[#235789]">Descrição</label>
        <textarea id="descricao" name="descricao" class="w-full p-2 rounded border shadow-sm" rows="4" required>{{ $trabalho->descricao }}</textarea>
      </div>

      <div class="mb-4">
        <label for="resumo_alteracoes" class="block font-semibold text-sm text-[#235789]">Resumo das Alterações</label>
        <textarea id="resumo_alteracoes" name="resumo_alteracoes" class="w-full p-2 rounded border shadow-sm" rows="3" required></textarea>
      </div>

      <div class="mb-4">
        <label for="arquivo" class="block font-semibold text-sm text-[#235789]">Anexar Arquivo (opcional)</label>
        <input type="file" name="arquivo" class="block mt-1">
      </div>

      <button type="submit" class="bg-[#F1D302] hover:bg-[#e5c801] text-black font-semibold px-4 py-2 rounded shadow">
        Salvar Alterações
      </button>
    </form>
  </main>
</div>
@endsection