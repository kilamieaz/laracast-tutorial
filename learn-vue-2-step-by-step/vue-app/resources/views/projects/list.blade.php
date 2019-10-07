<aside class="menu">
<ul class="menu-list">
    @foreach ($projects as $item)
        <li><a>{{$item->name}}</a></li>
    @endforeach
</ul>
</aside>