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
                                        <h3 class="text-lg font-semibold text-gray-700">Total Doctors</h3>
                                        <p class="text-3xl font-bold text-green-600">{{ $totalDoctors }}</p>
                                    </div>
            
                                    <div class="p-6 bg-white rounded-2xl shadow">
                                        <h3 class="text-lg font-semibold text-gray-700">Total Patients</h3>
                                        <p class="text-3xl font-bold text-blue-600">{{ $totalPatients }}</p>
                                    </div>
            
                                    <div class="p-6 bg-white rounded-2xl shadow">
                                        <h3 class="text-lg font-semibold text-gray-700">Prescriptions</h3>
                                        <p class="text-3xl font-bold text-red-600">{{ $totalPrescriptions }}</p>
                                    </div>
                                </div>
            
                                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                                    <div class="p-6 bg-white rounded-2xl shadow mb-6">
                                        <h3 class="mb-4 text-xl font-semibold">Appointments Status</h3>
                                        <div style="width: 100%; height: 200px;"> {{-- Adjust height as needed --}}
                                            <canvas id="appointmentChart"></canvas>
                                        </div>
                                    </div>
            
                                    <div class="p-6 bg-white rounded-2xl shadow mb-6">
                                        <h3 class="mb-4 text-xl font-semibold">Medicines Used (Total Quantity)</h3>
                                        <div style="width: 100%; height: 200px;"> {{-- Adjust height as needed --}}
                                            <canvas id="medicineQuantityChart"></canvas>
                                        </div>
                                    </div>
                                </div>
            
            
                            </div>
                        </div>
                    </div>
                </div>
            
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Doughnut Chart for Appointment Status
                    var appointmentCtx = document.getElementById('appointmentChart').getContext('2d');
                    new Chart(appointmentCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Scheduled', 'Completed', 'Cancelled'],
                            datasets: [{
                                data: [
                                    {!! json_encode($appointmentStatusCounts['Scheduled'] ?? 0) !!},
                                    {!! json_encode($appointmentStatusCounts['Completed'] ?? 0) !!},
                                    {!! json_encode($appointmentStatusCounts['Cancelled'] ?? 0) !!}
                                ],
                                backgroundColor: ['#36A2EB', '#4BC0C0', '#FF6384']
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // Important to allow height to be controlled by the container
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });
            
                    // Bar Chart for Medicines Used (Total Quantity)
                    var medicineQuantityCtx = document.getElementById('medicineQuantityChart').getContext('2d');
                    new Chart(medicineQuantityCtx, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode(array_keys($treatmentQuantities)) !!},
                            datasets: [{
                                label: 'Total Quantity Used',
                                data: {!! json_encode(array_values($treatmentQuantities)) !!},
                                backgroundColor: 'rgba(153, 102, 255, 0.7)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // Important to allow height to be controlled by the container
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total Quantity'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Medicine'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false // Hide the label since there's only one dataset
                                }
                            }
                        }
                    });
            
                </script>
            </x-app-layout>