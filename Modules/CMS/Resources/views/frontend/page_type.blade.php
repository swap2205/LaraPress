<style>
   .card-img-top {
     width: 100%;
     height: 15vw !important;
     object-fit: cover !important;
 }
   </style>
<!-- ======= Portfolio Details Section ======= -->
              <section id="portfolio-details" class="portfolio-details">
               <div class="container">
           <div class="row" id="page-content">
               @include('cms::frontend.page_type_ajax')
            
            </div>
            <div class="row">
               <div class="col-md-12" id="pagination-links">
                  {!! $pages->links() !!}
               </div>
            </div>
   </div>
</section>