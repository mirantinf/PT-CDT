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
    return view('payments.edit', ['payment' => $payment]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  IlluminateHttpRequest  $request
   * @param  AppModelspayment  $payment
   * @return IlluminateHttpResponse
   */
  public function update(Request $request, payment $payment) {
    $imageName = '';
    if ($request->hasFile('file')) {
      $imageName = time() . '.' . $request->file->extension();
      $request->file->storeAs('images', $imageName, 'public_uploads');
      if ($payment->image) {
        Storage::delete('public/images/' . $payment->image);
      }
    } else {
      $imageName = $payment->image;
    }

    $paymentData = ['title' => $request->title, 'category' => $request->category, 'content' => $request->content, 'image' => $imageName];

    $payment->update($paymentData);
    return redirect('/payment')->with(['message' => 'payment updated successfully!', 'status' => 'success']);
  }

public function destroy(payment $payment) {
    Storage::delete('public/image/' . $payment->image);
    $payment->delete();
    return redirect('/add-payment');
  }
}

