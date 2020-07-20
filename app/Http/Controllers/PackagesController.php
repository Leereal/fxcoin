<?php

namespace App\Http\Controllers;

use App\Packages;
use Illuminate\Http\Request;
use App\Http\Resources\PackageResource;
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {        
        $packages = Packages::paginate();
        return PackageResource::collection($packages);
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|max:255|unique:packages,name',
            'minimum'        => 'required|max:10|between:0,99.99',
            'interest'       => 'required|max:10|between:0,99.99',
            'daily_interest' => 'required|max:10|between:0,99.99',
            'period'         => 'required|max:1000|integer',
        ]);
        $package = new Packages;
        $package->id             = $request->input('id');
        $package->name           = $request->input('name');
        $package->minimum        = $request->input('minimum');
        $package->interest       = $request->input('interest');
        $package->daily_interest = $request->input('daily_interest');
        $package->period         = $request->input('period');    
        if($package->save()){
            return new PackageResource($package);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
       $package = Packages::findOrFail($id);

       //Return single package as a resource
       return new PackageResource($package);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Packages $packages)
    {
        $request->validate([
            'name'           => 'required|max:255|unique:packages,name'.$packages->id,
            'minimum'        => 'required|max:255|between:0,99.99',
            'interest'       => 'required|max:20|between:0,99.99',
            'daily_interest' => 'required|max:10|between:0,99.99',
            'period'         => 'required|max:1000|integer',
        ]);
        $package                 = Packages::findOrFail($request->id);
        $package->id             = $request->input('id');
        $package->name           = $request->input('name');
        $package->minimum        = $request->input('minimum');
        $package->interest       = $request->input('interest');
        $package->daily_interest = $request->input('daily_interest');
        $package->period         = $request->input('period');      
        if($package->save()){
            return new PackageResource($package);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Packages::findOrFail($id);

       if($package->delete()){
            return new PackageResource($package);   
       }

       
    }
}
