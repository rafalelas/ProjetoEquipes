@extends('layouts.padrao')
@section('conteudo')
<div class="bg-[#9CAFB7] min-h-screen flex p-4 gap-6">
  @include('layouts.aside')
  
  <main class="flex-1 max-w-7xl mx-auto overflow-auto">
    <h2 class="text-2xl font-bold text-[#235789] mb-4">Criar novo Trabalho</h2>

    <form action="{{ route('criarTrabalhoSubmit') }}" method="POST">
      @csrf
      <input type="hidden" name="equipe_id" value="{{ $equipe->id }}">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Título</label>
        <input type="text" name="titulo" class="mt-1 block w-full rounded-md" required>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Descrição</label>
        <textarea name="descricao" rows="4" class="mt-1 block w-full rounded-md" required></textarea>
      </div>

      <button type="submit" class="bg-[#F1D302] hover:bg-[#e5c801] px-4 py-2 rounded text-black font-semibold shadow">
        Criar Trabalho
      </button>
    </form>
  </main>
</div>
@endsection