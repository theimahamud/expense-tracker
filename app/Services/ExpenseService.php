<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ExpenseService
{
    public function getExpenseList(): LengthAwarePaginator
    {
        return Expense::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getCurrentMonthExpense(): Collection
    {
        return Expense::with('category')
            ->where('user_id', Auth::id())
            ->whereYear('date', Carbon::now()->year)
            ->whereMonth('date', Carbon::now()->month)
            ->get();
    }

    public function create(array $data): void
    {
        $data['user_id'] = Auth::id();

        Expense::create($data);
    }

    public function update(Expense $expense, array $data): void
    {
        $expense->update($data);
    }
}
