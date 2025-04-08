<div class="grid grid-cols-4 gap-8 w-full my-12">
    @foreach ($menus as $menu)
    <div class="bg-gray-200 rounded-xl col-span-2 w-full">
        <div class="h-40">
            <img src="{{ $menu->getMedia('foto_menu')->first()->getUrl() }}" class="h-32 w-32 rounded-full object-cover mx-auto -translate-y-4" />
        </div>
        <h3>{{ $menu->name }}</h3>
        <p>Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
    </div>
    @endforeach
</div>