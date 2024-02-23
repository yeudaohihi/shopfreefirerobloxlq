<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->get();

        return view('admin.invoices.index', compact('invoices'));
    }

    public function update(Request $request)
    {
        $payload = $request->validate([
            'id' => 'required|exists:invoices,id',
            'type' => 'required|in:paid,cancelled',
        ]);

        $invoice = Invoice::find($payload['id']);

        if ($invoice->status !== 'Processing') {
            return response()->json([
                'status' => 400,
                'message' => 'Hoá đơn đã được thanh toán hoặc đã bị hủy',
            ], 400);
        }

        if ($payload['type'] === 'paid') {
            $invoice->status = 'Paid';
            $invoice->paid_at = now();
            $invoice->save();

            $client = User::find($invoice->user_id);

            if ($client) {
                $client->increment('balance', $invoice->amount);
                $client->increment('total_deposit', $invoice->amount);

                $client->transactions()->create([
                    'code' => $invoice->code,
                    'amount' => $invoice->amount,
                    'b_before' => $client->balance - $invoice->amount,
                    'b_after' => $client->balance,
                    'type' => 'deposit-banking',
                    'extras' => [],
                    'status' => 'paid',
                    'content' => 'Admin đã cập nhật hoá đơn',
                    'user_id' => $client->id,
                    'username' => $client->username,
                ]);
            }
        } else {
            $invoice->status = 'cancelled';
            $invoice->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật hoá đơn thành công',
        ]);
    }
}
