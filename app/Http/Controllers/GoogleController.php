<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class GoogleController extends Controller
{
    public function googlePieChart()
    {
    //     $data = DB::table('statuses')->select(DB::raw('status_name as status'),
    //     DB::raw('count(*) as number'))
    //    ->groupBy('status')->get();

        $data = Status::all();

        $array = [['Status', 'Number']];

        foreach($data as $status)
        {
          array_push($array, [$status->status_name, $status->projects->count()]);
        }

        return view('googleChart')->with('status', json_encode($array));
    }
}
