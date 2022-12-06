<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('permission:user_show', ['only' => 'index']);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_delete', ['only' => 'destroy']);
        $this->middleware('permission:user_detail', ['only' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Role::all();
        $user = User::where('id', '<>', Auth::user()->id)->with('DataRole')->get();
        if ($request->ajax()) {
            $allData = DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' .
                        $row->id . '" data-original-title="Edit" class="edit text-white btn btn-info btn-sm detailUser"><i class="fas fa-eye"></i></a>&nbsp';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' .
                        $row->id . '" data-original-title="Edit" class="edit text-white btn btn-primary btn-sm editUser"><i class="fas fa-edit"></i></a>&nbsp';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' .
                        $row->id . '" data-original-title="delete" class="delete text-white btn btn-danger btn-sm deleteUser" id="deleteUser"><i class="fas fa-trash"></i></a>';
                    return  $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        $content = [
            'title' => 'User',
            'user' => $user,
            'role' => $role,
        ];
        return view('user.index', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->name),
         ]);
         //  role input
        //  Buat Role Dengan nama Percobaan
        // $user->assignRole('percobaan');
        $user->syncRoles($request->role_id);
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('roles')->find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->find($id);
        return response()->json($user);
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
        $user = User::updateOrCreate(
        [
            'id' => $request->user_id
        ],
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->name),
        ]);
            $user->syncRoles($request->role);
        // dd($request->roles);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id)->delete();
        return response()->json(['success' => 'Data delete successfully']);
    }
}
