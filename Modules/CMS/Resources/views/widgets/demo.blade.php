<h1> {{ $label }}</h1>
<ul>
@foreach ($data as $item)
    <li class="">{{$item->title}}</li>
@endforeach
</ul>