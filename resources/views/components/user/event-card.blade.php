@props(['title', 'date', 'location', 'price', 'image', 'href' => null, 'stock' => 0])

@php
    // Format Indonesian price
    $formattedPrice = $price ? 'Rp ' . number_format($price, 0, ',', '.') : 'Harga tidak tersedia';

    $formattedDate = $date
        ? \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y, H:i')
        : 'Tanggal tidak tersedia';

    // Safe image URL: use external URL if provided, otherwise use asset (storage path)
    $imageUrl = $image
        ? (filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : asset('images/events/' . $image))
        : asset('images/konser.jpeg');

    // Check if event is expired
    $isExpired = $date ? \Carbon\Carbon::parse($date)->isPast() : false;
    $isOutOfStock = $stock <= 0;

    $locationName = is_object($location) && isset($location->name) ? $location->name : (is_array($location) && isset($location['name']) ? $location['name'] : $location);
@endphp

<a href="{{ $href ?? '#' }}" class="block group">
    <div
        class="card bg-white h-full shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-primary {{ $isExpired || $isOutOfStock ? 'opacity-75' : '' }}">
        <div class="relative h-48 overflow-hidden rounded-t-lg bg-gray-100">
            <img src="{{ $imageUrl }}" alt="{{ $title }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            @if ($isExpired)
                <div class="absolute top-2 right-2 badge badge-error gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Expired
                </div>
            @elseif($isOutOfStock)
                <div class="absolute top-2 right-2 badge badge-warning gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Sold Out
                </div>
            @endif
        </div>

        <div class="card-body p-4">
            <h2 class="card-title text-lg line-clamp-2">
                {{ $title }}
            </h2>

            <div class="flex items-center gap-2 text-sm text-gray-600 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="line-clamp-1">{{ $formattedDate }}</span>
            </div>

            <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="line-clamp-1">{{ $locationName }}</span>
            </div>

            <div class="divider my-2"></div>

            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Mulai dari</p>
                    <p class="font-bold text-primary text-lg">{{ $formattedPrice }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500">Stok Tersisa</p>
                    <p class="font-bold text-sm {{ $isOutOfStock ? 'text-error' : 'text-success' }}">
                        {{ $stock }} tiket
                    </p>
                </div>
            </div>
        </div>
    </div>
</a>
