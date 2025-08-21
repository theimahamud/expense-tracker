@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-list me-2"></i>My Expenses</h2>
                    <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Add New Expense
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        @if($expenses->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th class="text-end">Amount</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expenses as $expense)
                                        <tr>
                                            <td>{{ $expense->date->format('M d, Y') }}</td>
                                            <td>{{ $expense->title }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $expense->category->name }}</span>
                                            </td>
                                            <td class="text-end">
                                                <strong>${{ number_format($expense->amount, 2) }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this expense?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{ $expenses->links() }}
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <h4>No expenses found</h4>
                                <p class="text-muted">Start tracking your expenses by adding your first entry.</p>
                                <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>Add Your First Expense
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
