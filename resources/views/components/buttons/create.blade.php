@props(["route"=>"", "icon"=>"plus", "title", "small"=>"", "class"=>""])

@if($route)
<a href='{{$route}}'
    class='btn btn-primary {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    data-toggle="tooltip"
    title="{{ $title }}">
    <i data-feather="{{$icon}}" width="16" height="16"></i>
    {{ $slot }}
</a>
@else
<button type="submit"
    class='btn btn-primary {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    data-toggle="tooltip"
    title="{{ $title }}">
    <i data-feather="{{$icon}}"></i>
    {{ $slot }}
</button>
@endif
