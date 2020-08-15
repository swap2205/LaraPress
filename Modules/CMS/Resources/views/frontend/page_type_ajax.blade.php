@foreach($pages as $page)
   <div class="col-md-4">
      <div class="card card-primary">
        <img class="card-img-top" src="{{Storage::url($page->featured_image)}}"/> 
        {{-- <div class="card-header">
            <h2 class="cart-title"><a href="{{url($page->slug)}}">
                {{ $page->title }}
            </a>
                </h2>
         </div> --}}
         <div class="card-body">
            <h4><a href="{{url($page->slug)}}">
                {{ $page->title }}
            </a>
                </h4>
             <p>{{\Str::words(strip_tags($page->content),20,'...')}}</p>
         </div>
      </div>
   </div>        
@endforeach
