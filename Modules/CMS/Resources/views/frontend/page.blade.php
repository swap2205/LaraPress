<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
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
            {{$content}}
        </p>
      </div>

    </div>
<!-- End Portfolio Details Section -->

        </div>
        <div class="col-md-2">
            <section class="card">
            <div class="card-header">
                <h3>Latest Post</h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                    <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                    <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                    <li class="list-group-item"><a href="#">Cras justo odio</a> </li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                  </ul>
              </div>
            </section>
        </div>
    </div>
</div>
