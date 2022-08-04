@if ($item['submenu'] == [])
<li><a class="nav-link" data-bs-toggle="dropdown" href="{{ url($item['name']) }}">{{ $item['name'] }}</a></li>
@else
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{{ $item['name'] }} <span class="caret"></span></a>
    <ul class="dropdown-menu">
        @foreach ($item['submenu'] as $submenu)
            @if ($submenu['submenu'] == [])
                <li>
                    <a class="dropdown-item" href="{{ url('menu',['id' => $submenu['id'], 'slug' => $submenu['slug']]) }}">{{ $submenu['name'] }} <span class="caret"></span></a>
                </li>
            @else
                @include('shared.navbar', [ 'item' => $submenu ])
            @endif
        @endforeach
    </ul>
</li>
@endif