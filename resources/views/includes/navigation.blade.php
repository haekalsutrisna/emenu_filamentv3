<div class="fixed inset-x-0 bottom-0 max-w-[640px] z-50 bg-white shadow-sm mx-auto">
    <div class="flex items-center justify-between px-8 py-4">

        {{-- Link Home (Index) --}}
        <a href="{{ route('index', ['username' => $store->username]) }}" class="flex flex-col items-center gap-2">
            @if (Route::current()->getName() == 'index')
                <img src="{{ asset('assets/images/icons/Home.svg') }}" class="w-[24px] h-[24px]" alt="icon">
            @else
                <img src="{{ asset('assets/images/icons/Home_Default.svg') }}" class="w-[24px] h-[24px]" alt="icon">
            @endif
            <p class="{{ (Route::current()->getName() == 'index') ? 'text-[#FF801A]' : 'text-[#606060]' }} font-bold text-[12px]">
                Home
            </p>
        </a>

        {{-- Link Cart --}}
        <a href="{{ route('cart', ['username' => $store->username]) }}" class="flex flex-col items-center gap-2">
            <div class="relative">
                <img src="{{ asset('assets/images/icons/Buy.svg') }}" class="w-[24px] h-[24px]" alt="icon">
                {{-- Badge Notifikasi Cart --}}
                <div class="absolute top-[-4px] right-[-8px] flex items-center justify-center w-[16px] h-[16px] rounded-full bg-[#FF801A]">
                    <p class="text-white font-bold text-[10px]" id="cart-count">
                        0 
                    </p>
                </div>
            </div>
            <p class="text-[#606060] font-bold text-[12px]">
                Cart
            </p>
        </a>

        {{-- Link Find (Pencarian Produk) --}}
        <a href="{{ route('product.find', ['username' => $store->username]) }}" class="flex flex-col items-center gap-2">
            @if (Route::current()->getName() == 'product.find')
                <img src="{{ asset('assets/images/icons/Search.svg') }}" class="w-[24px] h-[24px]" alt="icon">
            @else
                <img src="{{ asset('assets/images/icons/Search_Default.svg') }}" class="w-[24px] h-[24px]" alt="icon">
            @endif
            <p class="{{ (Route::current()->getName() == 'product.find') ? 'text-[#FF801A]' : 'text-[#606060]' }} font-bold text-[12px]">
                Find
            </p>
        </a>

        {{-- Link Profile --}}
        <a href="index.html" class="flex flex-col items-center gap-2">
            <img src="assets/images/icons/Profile.svg" class="w-[24px] h-[24px]" alt="icon">
            <p class="text-[#606060] font-bold text-[12px]">
                Profile
            </p>
        </a>
    </div>
</div>