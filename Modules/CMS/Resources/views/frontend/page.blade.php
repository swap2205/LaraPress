              <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="portfolio-details-container">

        <div class="owl-carousel portfolio-details-carousel">
          <img src="{!! Theme::asset()->url('img/portfolio/portfolio-details-1.jpg') !!}" class="img-fluid" alt="">
          <img src="{!! Theme::asset()->url('img/portfolio/portfolio-details-2.jpg') !!}" class="img-fluid" alt="">
          <img src="{!! Theme::asset()->url('img/portfolio/portfolio-details-3.jpg') !!}" class="img-fluid" alt="">
        </div>



      </div>

      <div class="portfolio-description">
        <h2>{{$title}}</h2>
        <p>
            {!!$content!!}
        </p>
      </div>

    </div>
<!-- End Portfolio Details Section -->

