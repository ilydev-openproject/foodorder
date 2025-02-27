<div>
    @foreach ($menus as $menu)
    <div>
        <h3>{{ $menu->name }}</h3>
        <p>{{ $menu->description }}</p>
        <p>Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
    </div>
    @endforeach
</div>