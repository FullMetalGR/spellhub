<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SpellHub') }} - Your Magical Library</title>
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Henny+Penny:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>

        /* Rarity-specific styles */
        .rarity-common {
            --rarity-color-1: #9ca3af;
            --rarity-color-2: #6b7280;
        }
        .rarity-uncommon {
            --rarity-color-1: #10b981;
            --rarity-color-2: #059669;
        }
        .rarity-rare {
            --rarity-color-1: #3b82f6;
            --rarity-color-2: #2563eb;
        }
        .rarity-epic {
            --rarity-color-1: #a855f7;
            --rarity-color-2: #7c3aed;
        }
        .rarity-legendary {
            --rarity-color-1: #f97316;
            --rarity-color-2: #ea580c;
        }

        .rarity-badge-common {
            background: linear-gradient(135deg, #9ca3af, #6b7280);
            color: white;
        }
        .rarity-badge-uncommon {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        .rarity-badge-rare {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }
        .rarity-badge-epic {
            background: linear-gradient(135deg, #a855f7, #7c3aed);
            color: white;
        }
        .rarity-badge-legendary {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
        }

        body {
            font-family: "MedievalSharp", cursive !important;
        }

        .font-henny-penny {
            font-family: 'Henny Penny', cursive;
        }

        .spell-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .spell-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .rarity-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--rarity-color-1), var(--rarity-color-2));
        }

        .rarity-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .school-badge {
            @apply px-2 py-1 text-xs font-semibold rounded-full;
        }

        .school-evocation { @apply bg-red-100 text-red-800; }
        .school-abjuration { @apply bg-blue-100 text-blue-800; }
        .school-conjuration { @apply bg-green-100 text-green-800; }
        .school-divination { @apply bg-purple-100 text-purple-800; }
        .school-enchantment { @apply bg-pink-100 text-pink-800; }
        .school-illusion { @apply bg-yellow-100 text-yellow-800; }
        .school-necromancy { @apply bg-gray-100 text-gray-800; }
        .school-transmutation { @apply bg-indigo-100 text-indigo-800; }

        .level-badge {
            @apply px-2 py-1 text-xs font-bold rounded-full bg-gray-800 text-white;
        }

        .components-badge {
            @apply text-xs bg-gray-100 px-2 py-1 rounded border border-gray-200;
        }

        nav[aria-label="Pagination Navigation"] > .flex {
            display: none;
        }
        nav[aria-label="Pagination Navigation"] > .hidden {
            width: 100%;
        }

        .copy-button {
            transition: all 0.2s ease;
        }

        .copy-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .copy-button.copied {
            background-color: #10b981 !important;
            border-color: #10b981 !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-purple-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-purple-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-henny-penny text-purple-600">🧙‍♂️ SpellHub</h1>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('filament.app.pages.dashboard') }}"
                           class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">
                            My Spellbook
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('filament.app.auth.login') }}"
                           class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">
                            Login
                        </a>
                        <a href="{{ route('filament.app.auth.register') }}"
                           class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-henny-penny mb-6">
                    Discover the Magic Within
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-purple-100">
                    Explore thousands of spells and create your own magical collection
                </p>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto" x-data="{ search: '{{ request('search') }}', school: '{{ request('school', 'all') }}', rarity: '{{ request('rarity', 'all') }}', level: '{{ request('level', 'all') }}' }">
                    <form method="GET" action="{{ route('home') }}" class="flex flex-col gap-4">
                        <div class="flex-1">
                            <input type="text"
                                   name="search"
                                   x-model="search"
                                   placeholder="Search spells by name, description, school, or rarity..."
                                   class="w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-300">
                        </div>

                        <div class="flex justify-end gap-2">
                            <select name="school" x-model="school" class="px-3 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-300">
                                <option value="all">All Schools</option>
                                @foreach($schools as $schoolOption)
                                    <option value="{{ $schoolOption }}">{{ $schoolOption }}</option>
                                @endforeach
                            </select>

                            <select name="rarity" x-model="rarity" class="px-3 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-300">
                                <option value="all">All Rarities</option>
                                @foreach($rarities as $rarityOption)
                                    <option value="{{ $rarityOption }}">{{ $rarityOption }}</option>
                                @endforeach
                            </select>

                            <select name="level" x-model="level" class="px-3 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-300">
                                <option value="all">All Levels</option>
                                @foreach($levels as $levelOption)
                                    <option value="{{ $levelOption }}">{{ $levelOption }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="bg-purple-800 hover:bg-purple-900 px-6 py-3 rounded-lg font-medium transition-colors">
                                🔍 Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Spells Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-henny-penny text-gray-900">📚 Magical Spells</h2>
            <div class="text-sm text-gray-600">
                Showing {{ $spells->firstItem() ?? 0 }} - {{ $spells->lastItem() ?? 0 }} of {{ $spells->total() }} spells
            </div>
        </div>

        @if($spells->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($spells as $spell)
                    <div class="spell-card bg-white rounded-lg shadow-md overflow-hidden rarity-{{ strtolower($spell->rarity) }}">
                        <!-- Rarity border -->
                        <div class="rarity-border"></div>

                        <!-- Rarity badge -->
                        <div class="rarity-badge rarity-badge-{{ strtolower($spell->rarity) }}">
                            {{ $spell->rarity }}
                        </div>

                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3 mt-6">
                                <h3 class="text-lg font-semibold text-gray-900 pr-8">{{ $spell->name }}</h3>
                                <span class="school-badge school-{{ strtolower($spell->school) }}">
                                    {{ $spell->school }}
                                </span>
                            </div>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($spell->description, 120) }}
                            </p>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center justify-between">
                                    <span class="level-badge">{{ $spell->level ?? 'Cantrip' }}</span>
                                    @if($spell->components)
                                        <span class="components-badge">{{ $spell->getComponentsString() }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                <span class="text-xs text-gray-400">by {{ $spell->createdBy->name }}</span>
                                @auth
                                    @if(isset($spell->is_copied) && $spell->is_copied)
                                        <button class="copy-button copied bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm transition-colors" disabled>
                                            ✓ Copied
                                        </button>
                                    @elseif(isset($spell->can_copy) && $spell->can_copy)
                                        <button
                                            class="copy-button bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-sm transition-colors"
                                            onclick="copySpell({{ $spell->id }}, this)"
                                            data-spell-id="{{ $spell->id }}">
                                            Copy to Spellbook
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-500">Your spell</span>
                                    @endif
                                @else
                                    <a href="{{ route('filament.app.auth.login') }}"
                                       class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm transition-colors">
                                        Login to Copy
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $spells->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔮</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No spells found</h3>
                <p class="text-gray-600">Try adjusting your search criteria or filters.</p>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; {{ date('Y') }} SpellHub. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function copySpell(spellId, button) {
            // Disable button and show loading state
            button.disabled = true;
            button.textContent = 'Copying...';
            button.classList.add('opacity-50');

            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Make AJAX request
            fetch(`/spells/${spellId}/copy`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success state
                    button.textContent = '✓ Copied';
                    button.classList.remove('bg-purple-600', 'hover:bg-purple-700');
                    button.classList.add('bg-green-600', 'hover:bg-green-700', 'copied');
                    button.disabled = true;

                    // Show success message
                    showNotification(data.message, 'success');
                } else {
                    // Show error state
                    button.disabled = false;
                    button.textContent = 'Copy to Spellbook';
                    button.classList.remove('opacity-50');

                    // Show error message
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.disabled = false;
                button.textContent = 'Copy to Spellbook';
                button.classList.remove('opacity-50');
                showNotification('An error occurred while copying the spell.', 'error');
            });
        }

        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-600' : 'bg-red-600'
            }`;
            notification.textContent = message;

            // Add to page
            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>
</html>
