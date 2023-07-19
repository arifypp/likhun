<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Checkout;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class PaymentController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    /**
     * Public constructor
     */
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Payments';

        // module name
        $this->module_name = 'payments';

        // directory path of the module
        $this->module_path = 'backend.payments';

        // module icon
        $this->module_icon = 'payments';

        // module model
        $this->module_model = new Checkout();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        
        $module_action = 'List';

        if (request()->ajax()) {
            $data = Checkout::with('user', 'package')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($module_name) {
                    $btn = '<a href="' . route('backend.' . $module_name . '.show', $row->id) . '" class="view btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" data-id="'.$row->id.'">V</a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<a href="' . route('backend.' . $module_name . '.destroy', $row->id) . '" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'">D</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view($module_path . '.index', compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_model', 'module_name_singular', 'module_action'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pending()
    {
        //
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        
        $module_action = 'List';

        if (request()->ajax()) {
            $data = Checkout::with('user', 'package')->where('payment_status', 'pending')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($module_name) {
                    $btn = '<a href="' . route('backend.' . $module_name . '.show', $row->id) . '" class="view btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" data-id="'.$row->id.'">V</a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<a href="' . route('backend.' . $module_name . '.destroy', $row->id) . '" class="delete btn btn-danger btn-sm" data-id="'.$row->id.'">D</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view($module_path . '.pending', compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_model', 'module_name_singular', 'module_action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $checkout = Checkout::with('user', 'package')->find($id);
        return response()->json($checkout);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $checkout = Checkout::with('user', 'package')->findOrfail($id);
        if ($checkout->payment_status == 'approved') {
            return response()->json(['error' => 'Payment already approved.']);
        }
        else{
            $checkout->payment_status = 'approved';
            $checkout->save();
    
            $user = User::findOrfail($checkout->user_id);
            $user->connects = ($user->connects + $checkout->package->connection);
            $user->save();
        }
        
        return response()->json(['success' => 'Payment approved successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $checkout = Checkout::findOrfail($id);
        $checkout->delete();
        
        if ($checkout) {
            return response()->json(['success' => 'Artist deleted successfully']);
        } else {
            return response()->json(['error' => 'Artist deletion failed']);
        }
    }
}
