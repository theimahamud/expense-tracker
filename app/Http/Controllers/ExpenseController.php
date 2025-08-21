<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Services\ExpenseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function __construct(protected ExpenseService $expenseService) {}

    public function index(): View
    {
        $expenses = $this->expenseService->getExpenseList();

        return view('expenses.index', compact('expenses'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('expenses.create', compact('categories'));
    }

    public function store(ExpenseRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->expenseService->create($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    public function edit(Expense $expense): View
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(ExpenseRequest $request, Expense $expense): RedirectResponse
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validated();

        $this->expenseService->update($expense, $validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

    public function monthlyReport(): View
    {
        $expenses = $this->expenseService->getCurrentMonthExpense();

        $groupedExpenses = $expenses->groupBy('category.name')->map(function ($group) {
            return $group->sum('amount');
        });

        $total = $groupedExpenses->sum();

        $chartData = [
            'labels' => $groupedExpenses->keys()->toArray(),
            'data' => $groupedExpenses->values()->toArray(),
        ];

        return view('expenses.monthly-report', compact('groupedExpenses', 'total', 'chartData'));
    }
}
