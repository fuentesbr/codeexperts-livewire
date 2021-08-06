<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Expense;

class ExpenseCreate extends Component
{
    use WithFileUploads;
    public $amount, $description, $type, $photo, $expenseDate;

    protected $rules = [
        'amount' => 'required',
        'type' => 'required',
        'description' => 'required',
        'photo' => 'image|nullable'
    ];

    public function render()
    {
        return view('livewire.expense.expense-create');
    }

    public function createExpense()
    {
        $this->validate();

        if($this->photo)
        {
            $this->photo = $this->photo->store('expenses-photos', 'public');
        }

        auth()->user()->expenses()->create([
            'amount' => $this->amount,
            'description' => $this->description,
            'type' => $this->type,
            'photo' => $this->photo,
            'expanse_date' => $this->expenseDate
        ]);

        session()->flash('message', 'Registro criado com sucesso');

        $this->description = $this->amount = $this->type = null;

    }
}
