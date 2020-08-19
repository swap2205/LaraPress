<section class="card">
    <div class="card-header">
        <h3>Latest {{ $label }}</h3>
    </div>
    <div class="card-body">
        @if (!empty($data))
        <ul class="list-group list-group-flush">
            @foreach ($data as $item)
                <li class="list-group-item"><a href="#">{{$item->title}}</a> </li>
            @endforeach
        </ul>    
        @else
            <p>No {{$label}} found</p>
        @endif
        
    </div>
</section>