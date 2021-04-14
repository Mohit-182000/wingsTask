<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Ticket();
        $add->subject = $request->subject;
        $add->priority_id = $request->priority_id;
        $add->status_id = $request->status_id;
        $add->user_id = $request->user_id;
        $add->assign_to_user_id = Auth::user()->id;
        $add->save();

        return redirect(route('ticket.index'))->with('success','Ticket Created Succssfully');
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'subject',
            2 => 'priority_id',
            3 => 'status_id',
            4 => 'user_id',
            5 => 'action',  
        );

        $totalData = Ticket::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $priority = $request->priority;
        $status = $request->status;
        $user = $request->user;
        $subject = $request->subject;
        
        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Ticket::when($search, function ($query, $search) {
            return $query->where('subject', 'LIKE', "%{$search}%")
                         ->orWhere('id', 'LIKE', "%{$search}%");
        })
        ->when($priority,function($priority_query) use ($priority){
            $priority_query->where('priority_id',$priority); 
        }) 
        ->when($status,function($status_query) use ($status){
            $status_query->where('status_id',$status); 
        }) 
        ->when($user,function($user_query) use ($user){
            $user_query->where('assign_to_user_id',$user); 
        })
        ->when($subject,function($subject_query) use ($subject){
            $subject_query->where('subject',$subject); 
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['subject'] =  $item->subject;
            $row['priority_id'] = $item->priority->name;
            $row['status_id'] = $item->status->name;
            $row['user_id'] = $item->user->name;
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => 'Edit',
                    'id' => $item->id,
                    'action' => route('ticket.edit', $item->id),
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => 'Delete',
                    'id' => $item->id,
                    'action' => route('ticket.destroy', $item->id),
                    'icon' => 'fas fa-times text-orange-red',
                    'class' => 'delete-confrim',
                ])
            ]);

            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['ticket'] = Ticket::findOrFail($id);
        return view('admin.tickets.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $add = Ticket::findOrFail($id);
        $add->subject = $request->subject;
        $add->priority_id = $request->priority_id;
        $add->status_id = $request->status_id;
        $add->user_id = $request->user_id;
        $add->assign_to_user_id = Auth::user()->id;
        $add->save();

        return redirect(route('ticket.index'))->with('success','Ticket Updarted Succssfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Ticket::findOrFail($id);
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Ticket Deleted Successfully',
        ], 200);
    }
}
