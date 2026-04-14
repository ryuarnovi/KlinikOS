<div>
    <h2>Invoices ({{ $status }})</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Method</th>
                <th>Due</th>
                <th>Paid At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->patient->name ?? '-' }}</td>
                <td>{{ $invoice->amount }}</td>
                <td>{{ $invoice->status }}</td>
                <td>{{ $invoice->payment_method }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ $invoice->paid_at }}</td>
                <td>
                    @if($invoice->status == 'pending')
                        <button wire:click="markPaid({{ $invoice->id }}, 'cash')">Mark Paid (Cash)</button>
                        <button wire:click="markPaid({{ $invoice->id }}, 'midtrans')">Mark Paid (Midtrans)</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
