@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-chart-bar me-2"></i>Monthly Report - {{ date('F Y') }}</h2>
                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Expenses
                    </a>
                </div>

                @if($groupedExpenses->count() > 0)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5><i class="fas fa-table me-2"></i>Expenses by Category</h5>
                                </div>
                                <div class="card-body">
                                    @foreach($groupedExpenses as $category => $amount)
                                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                            <span class="fw-semibold">{{ $category }}:</span>
                                            <span class="badge bg-secondary fs-6">৳{{ number_format($amount, 2) }}</span>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-between align-items-center py-3 border-top border-2 mt-3">
                                        <span class="fw-bold fs-5">Total:</span>
                                        <span class="badge bg-primary fs-5">৳{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5><i class="fas fa-chart-pie me-2"></i>Visual Chart</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="expenseChart" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5><i class="fas fa-chart-line me-2"></i>Category Breakdown</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="barChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                            <h4>No expenses found for this month</h4>
                            <p class="text-muted">Add some expenses to see your monthly report.</p>
                            <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Add Expense
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if($groupedExpenses->count() > 0)
        <script>
            // Pie Chart
            const ctx = document.getElementById('expenseChart').getContext('2d');
            const expenseChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        data: @json($chartData['data']),
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                            '#4BC0C0',
                            '#9966FF',
                            '#FF9F40'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ৳' + context.parsed.toFixed(2);
                                }
                            }
                        }
                    }
                }
            });

            // Bar Chart
            const ctx2 = document.getElementById('barChart').getContext('2d');
            const barChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Amount (৳)',
                        data: @json($chartData['data']),
                        backgroundColor: '#36A2EB',
                        borderColor: '#36A2EB',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '৳' + value.toFixed(2);
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endif
@endsection
