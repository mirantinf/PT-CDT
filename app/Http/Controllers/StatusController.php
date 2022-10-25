<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::latest()->paginate(100);

        return view('statuses.index',compact('statuses'))
            ->with('statuses', $statuses);
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'status_name' => 'required',
        ]);

        $status = new Status;
        $status->status_name = $request->status_name;
        $status->save();

        return redirect('/statuses')
            ->with('success','Berhasil Menyimpan !');
    }

    public function edit($statusId)
    {
        $status = Status::findOrFail($statusId);
        return view('statuses.edit', compact('status'));
    }

    public function update(Request $request, $statusId)
    {
        $status = Status::findOrFail($statusId);
        $status->status_name = $request->status_name;
        $status->save();
        return redirect('/statuses') 
            ->with('success','Berhasil Update !');
    }

    public function destroy($statusId)
    {
    
        $status = Status::findOrFail($statusId);
        $status->projects()->update(['status_id' => null]);
        $status->delete();

        return redirect('/statuses')
                        ->with('success','Berhasil Hapus !');
    }
}
