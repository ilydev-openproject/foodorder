<div>
    <!-- List Menu Berdasarkan Kategori -->
    <div class="mt-4">
        @foreach($menus as $menu)
        <div class="p-2 border-b">{{ $menu->name }}</div>
        @endforeach
    </div>
</div>