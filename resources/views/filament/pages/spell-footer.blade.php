<div class="text-center ">
    <div class="mb-5 flex flex-row justify-center items-center">
        @php
            $baseColor = match($rarity->value) {
                'Common' => '#9ca3af',
                'Uncommon' => '#22c55e',
                'Rare' => '#3b82f6',
                'Epic' => '#a855f7',
                'Legendary' => '#f97316',
                default => '#9ca3af'
            };
        @endphp
        <div class="flex-1" style="height: 2px; background-color: {{ $baseColor }};"></div>
        <div class="inline-flex items-center px-6 py-1 rounded-full border-2 shadow-lg backdrop-blur-sm"
             style="background: linear-gradient(135deg, {{ $baseColor }}20, {{ $baseColor }}40); border-color: {{ $baseColor }}; color: {{ $baseColor }};">
            <span class="font-semibold tracking-wide uppercase text-lg">{{ $rarity->value }}</span>
        </div>
        <div class="flex-1" style="height: 2px; background-color: {{ $baseColor }};"></div>
    </div>
    <div class="text-gray-500 dark:text-gray-400">
        Created by {{ $creatorName }}
    </div>
</div>
