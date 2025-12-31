<aside class="bg-white rounded-2xl shadow-md w-44 flex flex-col justify-between p-4">
  <div class="flex flex-col items-center space-y-2">
    <img alt="Imagem do usuário" class="rounded-full" height="64" src="{{ asset('assets/images/user.png') }}" width="64" />
    <p class="text-[#235789] font-semibold text-center">
      @auth
        {{ Auth::user()->nome }}
      @else
        <p>Usuário não está autenticado</p>
      @endauth
    </p>
  </div>

  <div class="flex-1 flex flex-col items-center justify-center mt-4">
  <h3 class="text-xs text-[#235789] font-semibold mb-4 text-center">Escolha a equipe que deseja editar as informações e clique:</h3>
  <nav class="flex flex-col space-y-4 items-center w-full">
    @forelse($equipes as $equipe)
      <a href="{{ route('infoEquipe', ['equipe' => $equipe->id]) }}"
         class="flex flex-col items-center text-center text-[#235789] text-sm px-2 py-1 rounded hover:bg-[#F1D302] hover:text-black transition w-full
         {{ $equipeSelecionada && $equipe->id == $equipeSelecionada->id ? 'bg-[#F1D302] text-black' : '' }}">

         <span>{{ $equipe->nome }}</span>
      </a>
    @empty
      <p class="text-[#826754] text-sm text-center">Você não participa de nenhuma equipe.</p>
    @endforelse
  </nav>
  <br><br>
  <a href="{{ route('home') }}" class="hover:text-black transition rounded hover:bg-[#97AFB7] text-xs text-[#235789] font-semibold mb-4 text-center">Clique aqui para ver suas equipes</a>
</div>

<form method="POST" action="{{ route('logout') }}" class="mt-6 w-full flex justify-center">
    @csrf
    <a href="{{ route('logout') }}" type="submit" class="flex items-center space-x-2 text-[#B22222] hover:text-white hover:bg-[#B22222] px-4 py-2 rounded-lg transition">
        <img src="{{ asset('assets/images/logout.png') }}" alt="Logout" class="w-5 h-5" />
        <span>Sair</span>
  </a>
</form>


</aside>
