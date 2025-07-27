<x-filament-panels::page>
    <div class="space-y-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex justify-between items-start">
                <div class="text-center flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        🧙‍♂️ Welcome to Your Spellbook
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Your personal collection of magical knowledge
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('filament.app.resources.spells.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs dark:text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                            Create New Spell
                        </a>
                        <a href="{{ route('filament.app.resources.spells.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs dark:text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <x-heroicon-o-sparkles class="w-4 h-4 mr-2" />
                            View All Spells
                        </a>
                    </div>
                </div>
                <div class="ml-4">
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs dark:text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 mr-2" />
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-heroicon-o-sparkles class="h-8 w-8 text-purple-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Spells</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ \App\Models\Spell::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-heroicon-o-plus-circle class="h-8 w-8 text-green-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Spells Created</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ auth()->user()->createdSpells()->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-heroicon-o-document-duplicate class="h-8 w-8 text-yellow-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Spells Copied</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ auth()->user()->copiedSpells()->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-heroicon-o-eye class="h-8 w-8 text-indigo-600" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Public Spells</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ \App\Models\Spell::public()->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Recent Spells</h3>
            <div class="space-y-4">
                @php
                    $recentSpells = \App\Models\Spell::public()->latest()->take(5)->get();
                    $myRecentSpells = auth()->user()->createdSpells()->latest()->take(5)->get();
                @endphp

                @if($myRecentSpells->count() > 0)
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Your Recent Spells</h4>
                        <div class="space-y-2">
                            @foreach($myRecentSpells as $spell)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $spell->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $spell->school }} • {{ $spell->level ?? 'Cantrip' }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $spell->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($recentSpells->count() > 0)
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Latest Community Spells</h4>
                        <div class="space-y-2">
                            @foreach($recentSpells as $spell)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $spell->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">by {{ $spell->createdBy->name }} • {{ $spell->school }} • {{ $spell->level ?? 'Cantrip' }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $spell->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
