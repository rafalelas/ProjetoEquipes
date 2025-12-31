@extends('layouts.padrao')

@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">

  @include('layouts.aside')

  <main class="flex-1 max-w-3xl mx-auto overflow-auto">
    <h2 class="text-2xl font-bold text-[#235789] mb-6">Editar Equipe</h2>

    <form method="POST" action="{{ route('editarEquipeSubmit', $equipe) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md w-full space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-semibold text-[#235789] mb-1">Nome da Equipe</label>
        <input type="text" name="nome" required value="{{ old('nome', $equipe->nome) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#F1D302]" />
      </div>

      <div>
        <label class="block text-sm font-semibold text-[#235789] mb-1">Imagem Atual</label>
        @if($equipe->imagem)
          <img src="{{ asset($equipe->imagem) }}" alt="Imagem da equipe" class="w-32 h-32 object-cover rounded mb-2" />
        @else
          <p class="text-gray-500">Nenhuma imagem cadastrada.</p>
        @endif
        <label class="block text-sm font-semibold text-[#235789] mb-1 mt-2">Alterar Imagem (opcional)</label>
        <input type="file" name="imagem" class="w-full border border-gray-300 rounded-lg px-3 py-2" />
      </div>

      <div>
        <label class="block text-sm font-semibold text-[#235789] mb-1">Membros</label>
        <div class="grid grid-cols-2 gap-2 max-h-48 overflow-auto border border-gray-300 rounded p-2">
          @foreach($usuarios as $usuario)
            <label class="inline-flex items-center space-x-2">
              <input type="checkbox" name="membros[]" value="{{ $usuario->id }}" {{ in_array($usuario->id, $equipe->usuarios->pluck('id')->toArray()) ? 'checked' : '' }} />
              <span>{{ $usuario->nome }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <button type="submit" class="bg-[#F1D302] hover:bg-[#e5c801] text-black font-semibold w-full py-2 rounded-lg">Salvar Alterações</button>
    </form>
  </main>

</div>
@endsection

