<?php

namespace App\Livewire\Billing;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class InvoiceManager extends Component
{
    public $invoices;
    public $status = 'pending';

    public function mount()
    {
        $this->getInvoices();
    }

    public function getInvoices()
    {
        $this->invoices = Invoice::where('clinic_id', Auth::user()->clinic_id)
            ->where('status', $this->status)
            ->orderByDesc('created_at')
            ->get();
    }

    public function markPaid($invoiceId, $method)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->status = 'paid';
        $invoice->payment_method = $method;
        $invoice->paid_at = now();
        $invoice->save();
        $this->getInvoices();
    }

    public function render()
    {
        return view('livewire.billing.invoice-manager');
    }
}
