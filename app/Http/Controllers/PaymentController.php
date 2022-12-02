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

    public function paymentindex()
    {
        $payments = Invoice::with('payments')->paginate(100);
        return view('payments.payment')
        ->with('payments', $payments);
    }

    public function create()
    {
        return view('payments.create');
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
      $payments = ['image' => $imageName, 'description' => $request->description, ];

      Payment::create($payments);
      return redirect('/add-payment')->with(['added successfully!']);
}


public function edit($paymentId) {
    $payment = Payment::findOrFail($paymentId);
    return view('payment.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  IlluminateHttpRequest  $request
   * @param  AppModelspayment  $payment
   * @return IlluminateHttpResponse
   */
  public function update(Request $request, $paymentId) {
    $payment = Payment::findOrFail($paymentId);
    $imageName = '';
    if ($request->hasFile('file')) {
      $imageName = time() . '.' . $request->file->extension();
      $request->file->storeAs('images', $imageName, 'public_uploads');
      if ($payment->image) {
        Storage::delete('uploads/images/' . $payment->image);
      }
    } else {
      $imageName = $payment->image;
    }

    $payments = ['title' => $request->title, 'category' => $request->category, 'content' => $request->content, 'image' => $imageName];

    $payment->update($payments);
    return redirect('/payment')->with(['message' => 'payment updated successfully!', 'status' => 'success']);
  }

public function destroy($paymentId) {
    $payment = Payment::findOrFail($paymentId);
    Storage::delete('uploads/images/' . $payment->image);
    $payment->delete();
    return redirect('/add-payment');
  }
}

