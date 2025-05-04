{{-- <x-app-layout> --}}

{{-- 'totalPosts',
            'publishedPosts',
            'unpublishedPosts',
            'categoryNames',
            'categoryCounts',
            'postMonths',
            'postCountsPerMonth' --}}

{{-- @dd(
                'Total Posts: '. $totalPosts,
                'Published Posts: '. $publishedPosts,
                'Unpublished Posts '. $unpublishedPosts,
                'Category Names: '. $categoryNames,
                'Category Counts: '. $categoryCounts,
                'Post Months: '. $postMonths,
                'Post Counts Per Month: '. $postCountsPerMonth
            ) --}}

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-6">

                    
                    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                        
                        <div class="p-6 bg-white rounded-2xl shadow">
                            <h3 class="text-lg font-semibold text-gray-700">Total Sales Value</h3>
                            <p class="text-3xl font-bold text-green-600">
                                ₱{{ number_format($totalSalesValue, 2) }}
                            </p>
                        </div>

                        
                        <div class="p-6 bg-white rounded-2xl shadow">
                            <h3 class="text-lg font-semibold text-gray-700">Total Products Sold : <span class="font-bold text-blue-600"> {{ $totalSalesUnits }}</span></h3>
                            <hr class="my-6 h-px border-t-0 bg-gray-300 opacity-25" />
                                <ul>
                                    <h3 class="text-lg font-semibold">Products Sold Per Region</h3>
                                    @foreach($salesPerRegion as $region)
                                        <li class="text-xl font-semibold text-blue-600">{{ $region->region }}: {{ $region->total_units }} units</li>
                                    @endforeach
                                </ul>
                        </div>

                        {{-- <div class="p-6 bg-white rounded-2xl shadow">
                            <h3 class="text-lg font-semibold text-gray-700">Product Count Per Region</h3>
                            <ul>
                                @foreach ($productsPerRegion as $region)
                                    <li>{{ $region->region }}: {{ $region->product_count }} products</li>
                                @endforeach
                            </ul>
                        </div> --}}

                        
                        <div class="p-6 bg-white rounded-2xl shadow">
                            <h3 class="text-lg font-semibold text-gray-700">Number of Sales Records</h3>
                            <p class="text-3xl font-bold text-purple-600">
                                {{ $numberOfSales }}
                            </p>
                        </div>
                    </div>

                    
                    <div class="p-6 bg-white rounded-2xl shadow mb-6">
                        <h3 class="mb-4 text-xl font-semibold">Products Sold Per Month</h3>
                        <canvas id="salesPerMonthChart" width="auto" height="70"></canvas>
                    </div>

                    
                    <div class="p-6 bg-white rounded-2xl shadow">
                        <h3 class="mb-4 text-xl font-semibold">Products Sold Per Region</h3>
                        <canvas id="salesPerRegionChart" width="auto" height="70"></canvas>
                    </div>



                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart
        const salesPerMonthCtx = document.getElementById('salesPerMonthChart').getContext('2d');
        new Chart(salesPerMonthCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($salesPerMonth->pluck('month')) !!},
                datasets: [{
                    label: 'Units Sold',
                    data: {!! json_encode($salesPerMonth->pluck('units_sold')) !!},
                    borderColor: 'rgba(73, 222, 107, 0.8)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Bar Chart
        const salesPerRegionCtx = document.getElementById('salesPerRegionChart').getContext('2d');
        new Chart(salesPerRegionCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($salesPerRegion->pluck('region')) !!},
                datasets: [{
                    label: 'Units Sold',
                    data: {!! json_encode($salesPerRegion->pluck('total_units')) !!},
                    backgroundColor: 'rgba(255, 205, 86, 0.5)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
