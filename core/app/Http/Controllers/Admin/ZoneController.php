<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller {
    public function index() {
        $pageTitle = 'All Zone';
        $zones     = Zone::orderBy('id', 'desc')->searchable(['name'])->paginate(getPaginate());
        return view('admin.zone.index', compact('pageTitle', 'zones'));
    }

    public function add($id = 0) {
        $pageTitle = 'Add New Zone';
        $zone      = null;

        $initLat  = gs('init_lat') ?? 39.95757568696546;
        $initLong = gs('init_long') ?? -82.98534977048033;

        if ($id) {
            $pageTitle = 'Update Zone';
            $zone        = Zone::findOrFail($id);
            $coordinates = explode(',', $zone->coordinates);

            $initLat  = $coordinates[0];
            $initLong = $coordinates[1];
        }

        return view('admin.zone.add', compact('pageTitle', 'zone', 'initLat', 'initLong'));
    }

    public function store(Request $request, $id = 0) {

        $validationRules = [
            'name' => 'required|string|max:40|unique:zones,name,' . $id,
        ];

        if (!$id || $request->has('coordinates')) {
            $validationRules['coordinates'] = 'required';
        }

        $request->validate($validationRules);

        if ($id) {
            $zone = Zone::findOrFail($id);
            $notification = 'Zone updated successfully';
        } else {
            $zone = new Zone();
            $notification = 'Zone added successfully';
        }

        $zone->name = $request->name;

        if ($request->has('zoom')) {
            $zone->zoom = $request->zoom;
        }

        if ($request->has('coordinates')) {
            $zone->coordinates = $request->coordinates;
        }

        $zone->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        return Zone::changeStatus($id);
    }
}
