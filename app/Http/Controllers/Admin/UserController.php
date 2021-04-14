<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $add = new User();
        $add->name = $request->name;
        $add->email = $request->email;
        $add->password = Hash::make($request->password);
        $add->save();

        return redirect(route('user.index'))->with('success','User Created Successfully');
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'action',
        );

        $totalData = User::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('id', 'LIKE', "%{$search}%");
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['name'] =  $item->name;
            $row['email'] = $item->email;
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => 'Edit',
                    'id' => $item->id,
                    'action' => route('user.edit', $item->id),
                    'icon' => 'fas fa-cogs text-dark-pastel-green',
                ]),
                collect([
                    'text' => 'Delete',
                    'id' => $item->id,
                    'action' => route('user.destroy', $item->id),
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
        $this->data['user'] = User::findOrFail($id);
        return view('admin.user.edit',$this->data);
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
        $add = User::findOrFail($id);
        $add->name = $request->name;
        $add->email = $request->email;
        if($request->password != ""){
            $add->password = Hash::make($request->password);
        }
        $add->save();

        return redirect(route('user.index'))->with('success','User Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User Deleted Successfully',
        ], 200);
    }
}
