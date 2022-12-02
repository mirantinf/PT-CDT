<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
class PaymentController extends Controller
{
    public function index()
    {

        $payments = Invoice::with('payments')->paginate(100);
        return view('payments.index')
        ->with('payments', $payments);
    }

    public function paymentindex($invoiceId)
    {
        $payments = Payment::with('invoices')
            ->where('invoice_id', $invoiceId)
            ->paginate(20);

        return view('payments.payment')
        ->with('invoiceId', $invoiceId)
        ->with('payments', $payments);
    }

    public function create($invoiceId)
    {
        return view('payments.create')
            ->with('invoiceId', $invoiceId);
    }

    public function store(Request $request)
{
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'required',
      ]);

      $imageName = time() . '.' . $request->file->extension();
      // $request->image->move(public_path('images'), $imageName);
    //   $request->file->storeAs('public/image', $imageName);
      $request->file->storeAs('images', $imageName, 'public_uploads');

      $payment = new Payment;

      $payment->image = $imageName;
      $payment->description = $request->description;
      $payment->invoice_id = $request->invoiceId;

      $payment->save();

      return redirect('/add-payment/'.$request->invoiceId)->with(['added successfully!']);
}


public function edit($paymentId) {
    $payment = Payment::findOrFail($paymentId);
    return view('payments.edit')
    ->with('payment', $payment)
    ->with('paymentId', $paymentId);
  }


  public function update(Request $request, $paymentId) {
    $payment = Payment::findOrFail($paymentId);

    $imageName = '';
    if ($request->hasFile('file')) {
      $imageName = time() . '.' . $request->file->extension();
      $request->file->storeAs('images', $imageName, 'public_uploads');
      if ($payment->image) {
        Storage::delete('upload/images/' . $payment->image);
      }
    } else {
      $imageName = $payment->image;
    }
    $payment->image = $imageName;
    $payment->description = $request->description;
    $payment->update();
    return redirect('/add-payment/'.$payment->invoice_id);
  }

    public function destroy($paymentId) {
        $payment = Payment::findOrFail($paymentId);
        $invoiceId = $payment->invoice_id;
        Storage::delete('uploads/images/' . $payment->image);
        $payment->delete();
        return redirect('/add-payment/'.$invoiceId);
    }

}

