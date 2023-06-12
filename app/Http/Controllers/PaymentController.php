<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index($id)
    {
        $data = Transaction::where('id', $id)->get();
        $transactionID = $id;
        return view('customer.profile.riwayat.upload-payment', compact('transactionID', 'data'));
    }

    public function upload(PaymentRequest $request, $id)
    {
        $data = $request->all();
        $data['transactions_id'] = $id;
        
        $existingPayment = Payment::where('transactions_id', $id)->first();

        if ($existingPayment) {
            Storage::delete('public/' . $existingPayment->image);
        }

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = substr($data['transactions_id'], 24) . '-' . now()->timestamp . '.' . $extension;

            $data['image'] = $request->file('image')->storeAs('assets/payment', $newName, 'public');
        }

        Payment::updateOrCreate(['transactions_id' => $id], $data);

        return redirect('/history')->with('toast_success', 'Data Berhasil Disimpan!');
    }
}
