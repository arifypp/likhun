<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use Illuminate\Http\Request;
use App\Models\Backend\OurPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageController extends Controller
{
    // use Authorizable;

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
        $this->module_title = 'Packages';

        // module name
        $this->module_name = 'packages';

        // directory path of the module
        $this->module_path = 'backend.packages';

        // module icon
        $this->module_icon = 'packages';

    }
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request )
    {
        //
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        // $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        if ( $request->ajax() ) {
            $packages = OurPackage::with('features')->orderBy('id', 'desc')->get();
            return Datatables::of($packages)
                ->addIndexColumn()
                ->addColumn('action', function($row) use ($module_name, $module_path) {
                    $btn = '<a href="javascript:void(0)" class="view btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" data-id="'.$row->id.'">V</a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" data-id="'.$row->id.'">E</a>';
                    return $btn;
                })
                ->editColumn('updated_at', function ($data) {
                    $module_name = $this->module_name;
    
                    $diff = Carbon::now()->diffInHours($data->updated_at);
    
                    if ($diff < 25) {
                        return $data->updated_at->diffForHumans();
                    } else {
                        return $data->updated_at->isoFormat('LLLL');
                    }
                })
                ->rawColumns(['action'])
                // features
                ->addColumn('features', function($row) use ($module_name, $module_path) {
                    $html = '<ul>';
                    foreach ($row->features as $key => $feature) {
                        $html .= '<li>'.$feature->name.'</li>';
                    }
                    $html .= '</ul>';
                    return $html;
                })
                ->make(true);
        }

        return view($module_path.'.index', compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_name_singular', 'module_action'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:our_packages',
            'price' => 'required,numeric',
            'features' => 'required|array',
        ]);

        $package = new OurPackage();
        $package->name = $request->name;
        $package->slug = Str::slug($request->name);
        $package->price = $request->amount;
        $package->discount_price = $request->discount_amount ?? null;
        $package->save();

        foreach ($request->features as $key => $feature) {
            $package->features()->create([
                'name' => $feature['features_list'],
                'our_package_id' => $package->id,
            ]);
        }

        return response()->json(['success' => 'Package created successfully.']);
    }

    /**
     * featurestore a newly created resource in storage.
     */
    public function featurestore(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $package = OurPackage::with('features', 'createdBy', 'updatedBy')->find($id);
        return response()->json($package);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $package = OurPackage::with('features')->find($id);
        return response()->json($package);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|unique:our_packages,name,'.$id,
            'price' => 'required,numeric',
            'features' => 'required|array',
        ]);

        $package = OurPackage::find($id);
        $package->name = $request->name;
        $package->slug = Str::slug($request->name);
        $package->price = $request->amount;
        $package->discount_price = $request->discount_amount ?? null;
        $package->save();

        $package->features()->delete();

        foreach ($request->features as $key => $feature) {
            $package->features()->create([
                'name' => $feature['features_list'],
                'our_package_id' => $package->id,
            ]);
        }

        return response()->json(['success' => 'Package updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // soft delete matched id and feature_list
        $package = find($id);
        $package->features()->delete();

        if ($package) {
            return response()->json(['success' => 'Package deleted successfully']);
        } else {
            return response()->json(['error' => 'Package deletion failed']);
        }
    }
}
