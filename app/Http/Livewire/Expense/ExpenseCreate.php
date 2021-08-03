<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\Expense;

class ExpenseCreate extends Component
{

    public $amount, $description, $type;

    protected $rules = [
        'amount' => 'required',
        'type' => 'required',
        'description' => 'required'
    ];

    public function render()
    {
        return view('livewire.expense.expense-create');
    }

    public function createExpense()
    {
        $this->validate();

        auth()->user()->expenses()->create([
            'amount' => $this->amount,
            'description' => $this->description,
            'type' => $this->type
        ]);

        session()->flash('message', 'Registro criado com sucesso');

        $this->description = $this->amount = $this->type = null;

    }
}
