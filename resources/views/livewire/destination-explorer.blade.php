<div class="min-h-screen bg-slate-100 px-6 py-10">
    <div class="mx-auto max-w-7xl space-y-8">

        {{-- Hero --}}
        <section class="relative overflow-hidden rounded-3xl bg-slate-900">
            <div class="px-10 pt-8 pb-10">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300">
                    Explore Destinations
                </p>

                <h1 class="mt-1 text-5xl font-extrabold text-white">
                    Project Expedition
                </h1>

                <p class="mt-6 max-w-2xl text-xl text-slate-200">
                    Search and compare travel destinations by region, budget, cost level, and activities.
                </p>
            </div>
        </section>

        {{-- Search and Sort --}}
        <section class="rounded-3xl bg-white p-6 shadow-lg ring-1 ring-slate-200">
            <div class="grid gap-4 md:grid-cols-[1fr_220px_auto] md:items-end">
                <div>
                    <label for="search" class="block text-sm font-semibold text-slate-700">
                        Search destinations
                    </label>

                    <input id="search" type="text" wire:model.live.debounce.300ms="searchTerm"
                        placeholder="Search by name, country, region, cost, or activity..."
                        class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-600 focus:ring-4 focus:ring-cyan-100">
                </div>

                <div>
                    <label for="sort" class="block text-sm font-semibold text-slate-700">
                        Sort by
                    </label>

                    <select id="sort" wire:model.live="sortField" wire:change="sort($event.target.value)"
                        class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-600 focus:ring-4 focus:ring-cyan-100">
                        <option value="name">Name</option>
                        <option value="country">Country</option>
                        <option value="region">Region</option>
                        <option value="cost_level">Cost Level</option>
                        <option value="average_daily_budget">Daily Budget</option>
                        <option value="annual_visitors">Annual Visitors</option>
                    </select>
                </div>

                <button type="button" wire:click="resetSearch"
                    class="rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-slate-700">
                    Reset
                </button>
            </div>

            <div wire:loading class="mt-4 text-sm text-slate-500">
                Updating results...
            </div>
        </section>

        {{-- Cards --}}
        <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse($filteredDestinations as $destination)
                <article
                    class="overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-slate-200 transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="h-36 bg-gradient-to-br from-cyan-700 via-sky-700 to-slate-900"></div>

                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                                    {{ $destination['name'] }}
                                </h2>

                                <p class="mt-1 text-sm font-medium text-slate-500">
                                    {{ $destination['country'] }} · {{ $destination['region'] }}
                                </p>
                            </div>

                            <span
                                class="shrink-0 rounded-full bg-cyan-50 px-3 py-1 text-xs font-bold text-cyan-700 ring-1 ring-cyan-100">
                                {{ $destination['cost_level'] }}
                            </span>
                        </div>

                        <div class="mt-6 grid grid-cols-2 divide-x divide-slate-200 rounded-2xl bg-slate-50 p-4">
                            <div class="pr-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Daily Budget
                                </p>

                                <p class="mt-1 text-2xl font-extrabold text-slate-900">
                                    ${{ number_format($destination['average_daily_budget']) }}
                                </p>
                            </div>

                            <div class="pl-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Visitors
                                </p>

                                <p class="mt-1 text-2xl font-extrabold text-slate-900">
                                    {{ number_format($destination['annual_visitors']) }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-sm font-bold text-slate-700">
                                Activities
                            </p>

                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($destination['activities'] as $activity)
                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200">
                                        {{ $activity }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl bg-white p-12 text-center shadow-lg ring-1 ring-slate-200">
                    <h2 class="text-xl font-bold text-slate-900">
                        No destinations found
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        Try adjusting your search term.
                    </p>
                </div>
            @endforelse
        </section>
    </div>
</div>
