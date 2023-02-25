{{-- <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">© 2022 Company, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
    </ul>
  </footer> --}}
<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted mt-4">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      {{-- <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div> --}}
      <!-- Left -->

      <!-- Right -->
      {{-- <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div> --}}
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <a href="{{ route('home.index') }}" class="footer-link-logo">
                <img style="width: 50%" src="/logo/logoimgblack.png" alt="">
                <h6 class="text-uppercase fw-bold mb-4 mt-2">
                    {{-- <i class="fas fa-gem me-3"></i> --}}
                    Wildfarm.com.ua
                </h6>
            </a>
            {{-- <p>
              Here you can use rows and columns to organize your footer content. Lorem ipsum
              dolor sit amet, consectetur adipisicing elit.
            </p> --}}
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Навігація
            </h6>
            <p>
              <a href="{{ route('products.index') }}" class="text-reset">Крамниця</a>
            </p>
            {{-- <p>
              <a href="#!" class="text-reset">React</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Laravel</a>
            </p> --}}
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Довідка
            </h6>
            <p>
              <a href="{{ route('contacts.index') }}" class="text-reset">Контакти</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Доставка та оплата</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Поверення товару</a>
            </p>
            {{-- <p>
              <a href="#!" class="text-reset">Help</a>
            </p> --}}
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Контакт</h6>
            <p><i class="fas fa-home me-3"></i>с. Соколово, вул. Гагаріна 18, Новомосковьский район, Дніпропетровська область.</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              info@wildfarm.com.ua
            </p>
            <p><i class="fas fa-phone me-3"></i> +380 111 222 333</p>
            {{-- <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p> --}}
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      {{-- © 2021 Copyright: --}}
      {{-- <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a> --}}
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
