<section class="banner">
    @foreach ($listaBanner as $linha)
        <img
            src="{{ asset('barista/assets/' . $linha->imagem_banner) }}"
            alt="{{ $linha->titulo_banner }}"
        >
    @endforeach
</section>