<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function getUser(Request $request){
        $search = $request->get('search');

        $data = User::where('name', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getStatus(Request $request){
        $search = $request->get('search');

        $data = Status::where('name', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }

    public function getPriority(Request $request){
        $search = $request->get('search');

        $data = Priority::where('name', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc')
                ->get();

        return response()->json($data->toArray());
    }
    
    public function getSubject(Request $request){
        $search = $request->get('search');

        $data = Ticket::where('subject', 'like', '%' . $search . '%')
                ->orderBy('subject', 'asc')
                ->get();

        return response()->json($data->toArray());
    }
}
