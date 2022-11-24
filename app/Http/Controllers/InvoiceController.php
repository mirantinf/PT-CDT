<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Status;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
class InvoiceController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $invoices = Invoice::with('project')->paginate(100);
        return view('invoices.index')
        ->with('invoices', $invoices);

    }

    public function create()
    {
        $projects = Project::all();
        return view('invoices.create')
        ->with('projects', $projects);
    }

    public function store(Request $request)
    {
        $request->validate([

            'no_invoice' => 'required',
            'project_id' => 'required',
            'item_name' => 'required',
            'price' => 'required',

        ]);

        $invoice = new Invoice;
        $invoice->no_invoice = $request->no_invoice;
        $invoice->project_id = $request->project_id;
        $invoice->item_name = $request->item_name;
        $invoice->price = $request->price;
        $invoice->save();

        return redirect('/invoices')
                        ->with('success','Berhasil Menyimpan !');
    }

    public function edit($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $projects = Project::all();
        return view('invoices.edit', compact('invoice', 'projects'))
        ->with('projects', $projects);
    }

    public function update(Request $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->project_id = $request->project_id;
        $invoice->no_invoice = $request->no_invoice;
        $invoice->item_name = $request->item_name;
        $invoice->price = $request->price;
        $invoice->save();
        return redirect('/invoices')
            ->with('success','Berhasil Update !');
    }

    public function destroy($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->delete();

        return redirect('/invoices')
                        ->with('success','Berhasil Hapus !');
    }
    public function generateInvoice($invoiceId) {
    $invoice = Invoice::with(['project'])->findOrFail(intval($invoiceId));
    $pdf = PDF::loadView('print', ['invoice' => $invoice]);
    return $pdf->stream();
    //sreturn $pdf->download('cdt_invoice.pdf');
}
}



