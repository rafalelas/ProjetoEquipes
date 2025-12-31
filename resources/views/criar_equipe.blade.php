@extends('layouts.padrao')

@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">

  @include('layouts.aside')

  <main class="flex-1 max-w-3xl mx-auto overflow-auto">
    <h2 class="text-2xl font-bold text-[#235789] mb-6">Criar Nova Equipe</h2>

    <form method="POST" action="{{ route('criarEquipeSubmit') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md w-full space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-semibold text-[#235789] mb-1">Nome da Equipe</label>
        <input type="text" name="nome" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#F1D302]" />
      </div>

      <div>
        <label class="block text-sm font-semibold text-[#235789] mb-1">Imagem (opcional)</label>
        <input type="file" name="imagem" class="w-full border border-gray-300 rounded-lg px-3 py-2" />
      </div>

      <div>
        <label class="block text-sm font-semibold text-[#235789] mb-1">Adicionar Membros</label>
        <select name="membros[]" multiple class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#F1D302]">
          @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id }}">{{ $usuario->nome }}</option>
          @endforeach
        </select>
        <p class="text-xs text-[#826754] mt-1">Segure Ctrl (ou Cmd) para selecionar múltiplos</p>
      </div>

      <button type="submit" class="bg-[#F1D302] hover:bg-[#e5c801] text-black font-semibold w-full py-2 rounded-lg">Criar Equipe</button>
    </form>
  </main>

</div>
@endsection
