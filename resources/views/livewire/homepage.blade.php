<section class="hero">
    <div class="hero-content bg-[#F7D158] rounded-2xl p-8 flex flex-row justify-between items-center overflow-visible">
        <div class="text">
            <h1 class="font-bold text-xl mb-4">Promo Pelajar, Untung Banyak!!</h1>
            <span class="font-semibold text-white bg-red-600 p-2 rounded-2xl"><b class="text-[#F7D158]">20%</b> Potongan</span>
        </div>
        <div class="image relative h-auto w-full">
            <img src="images/shoppingcart.png" class="w-[550px] absolute top-1/2 -translate-y-1/2 -right-12 z-10" alt="">
        </div>
    </div>
    <form class="flex items-center max-w-sm mx-auto my-4">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-[#F7D158] focus:border-[#F7D158] block w-full pe-10 p-2.5  " placeholder="Cari menu disini ..." required />
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                </svg>
            </div>
        </div>
    </form>
    <livewire:category />
    <livewire:menu/>
</section>