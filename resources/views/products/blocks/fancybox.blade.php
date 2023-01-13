{{-- <div class="col-lg-6">
    <img class="product-img-show" src="{{str_replace('product-img', 'product-img-medium', $product->main_img)}}" alt="">
</div> --}}
<style>
    /* .product-images-block{
        background: #fff;
        padding: 10px;
    } */

    #mainCarousel {
      width: 100%;
      margin: 0 auto 1rem auto;

      --carousel-button-color: #170724;
      --carousel-button-bg: #fff;
      --carousel-button-shadow: 0 2px 1px -1px rgb(0 0 0 / 20%),
        0 1px 1px 0 rgb(0 0 0 / 14%), 0 1px 3px 0 rgb(0 0 0 / 12%);

      --carousel-button-svg-width: 20px;
      --carousel-button-svg-height: 20px;
      --carousel-button-svg-stroke-width: 2.5;
    }

    #mainCarousel .carousel__slide {
      width: 100%;
      padding: 0;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #mainCarousel .carousel__slide img{
      max-height: 100%;
    }

    #mainCarousel .carousel__button.is-prev {
      left: -1.5rem;
    }

    #mainCarousel .carousel__button.is-next {
      right: -1.5rem;
    }

    #mainCarousel .carousel__button:focus {
      outline: none;
      box-shadow: 0 0 0 4px #A78BFA;
    }

    #thumbCarousel {
        display: flex;
        justify-content: center;
    }

    #thumbCarousel .carousel__slide {
      opacity: 0.5;
      padding: 0;
      margin: 0 0.25rem;
      width: 96px;
      height: 64px;
    }

    #thumbCarousel .carousel__slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 4px;
    }

    #thumbCarousel .carousel__slide.is-nav-selected {
      opacity: 1;
    }
    </style>


<div class="product-images-block">

    <div id="mainCarousel" class="carousel w-10/12 max-w-5xl mx-auto">
      <div
        class="carousel__slide"
        data-src="{{str_replace('product-img', 'product-img-medium', $product->main_img)}}"
        data-fancybox="gallery"
        data-caption=""
      >
        <img  src="{{str_replace('product-img', 'product-img-medium', $product->main_img)}}" />
      </div>
      @foreach ( $product->gallery as $image )
        <div
          class="carousel__slide d-none"
          data-src="{{ $image->image }}"
          data-fancybox="gallery"
          data-caption=""
        >
          <img  src="{{ $image->image }}" />
        </div>
      @endforeach
    </div>

    <div id="thumbCarousel" class="carousel mx-auto">
        <div class="carousel__slide">
            <img class="panzoom__content" src="{{$product->main_img}}" />
        </div>
        @foreach ($product->gallery as $image)
          <div class="carousel__slide">
              <img class="panzoom__content" src="{{ $image->image }}" />
          </div>
        @endforeach
    </div>

  </div>{{-- product-images-block --}}


  <script>
    // Initialise Carousel
    const mainCarousel = new Carousel(document.querySelector("#mainCarousel"), {
        Dots: false,
        height   : 250,
    });

    // Thumbnails
    const thumbCarousel = new Carousel(document.querySelector("#thumbCarousel"), {
      Sync: {
        target: mainCarousel,
        friction: 0,
      },
      Dots: false,
      Navigation: false,
      center: true,
      slidesPerPage: 1,
      infinite: false,
    });

    // Customize Fancybox
    Fancybox.bind('[data-fancybox="gallery"]', {
      Carousel: {
        on: {
          change: (that) => {
              console.log(that)
            mainCarousel.slideTo(mainCarousel.findPageForSlide(that.page), {
              friction: 0,
            });
          },
        },
      },
    });
      </script>
