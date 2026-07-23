$('.banner').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1500,
});

$('.slideEventos').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1500,
  arrows: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.itens-galeria').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 500,
    arrows: false,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('.Itens-Depoimento').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1500,
  arrows: false,
});

// script para animação wow
if (typeof WOW !== 'undefined') {
  new WOW().init();
}
              
/* MEU MOBILE */
document.querySelector(".abrir-menu").onclick = function(){
   document.documentElement.classList.add("menu-mobile")
}

document.querySelector(".fechar-menu").onclick = function(){
  console.log("teste")
   document.documentElement.classList.remove("menu-mobile")
}

// ANALISAR A POSIÇÃO: On Scroll  DO MAOUSE (para o menu ficar fixo)
window.onscroll = function(){
    var top = window.scrollY;
    var topoFixo = document.getElementById('topoFixo');
 
    if(top >= 1100){ // SE top >= 1100 faça:
        //console.log(top);
        topoFixo.classList.remove('saindo');
        topoFixo.classList.add('menu-fixo');
    }else{ // Senão for faça:
        //console.log("Estou abaixo de: " + top);
        if (topoFixo.classList.contains('menu-fixo') && !topoFixo.classList.contains('saindo')) {
            topoFixo.classList.add('saindo');
            topoFixo.addEventListener('animationend', function onMenuFixoOut(e) {
                if (e.animationName === 'menuFixoOut') {
                    topoFixo.classList.remove('menu-fixo', 'saindo');
                    topoFixo.removeEventListener('animationend', onMenuFixoOut);
                }
            });
        }
    }
   
}