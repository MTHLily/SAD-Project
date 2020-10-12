<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warranty;
use App\Brand;
use Illuminate\Support\Facades\Storage;

class WarrantyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view ('warranties.index', ['warranties' =>Warranty::all(), 'brands' => Brand::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warranties.create',[ 'brands'=>Brand::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'brand_id'=>'',
                'new_brand'=>'',
		        'purchase_date'=>'required',
		        'purchase_location'=>'required',
		        'receipt_url'=>['required','image'],
		        'serial_no'=>'required',
		        'warranty_life'=>'required',
		        'notes'=>'',
		        'status'=>'required', 
            ]

        );

        
        $imagePath = request('receipt_url')->store( 'public/warranties', 'local' );

        $warranty = new Warranty;
        $warranty->brand_id = $validatedData['brand_id'];
        $warranty->purchase_date = $validatedData['purchase_date'];
        $warranty->purchase_location = $validatedData['purchase_location'];
        $warranty->receipt_url = $imagePath;
        $warranty->serial_no = $validatedData['serial_no'];
        $warranty->warranty_life = $validatedData['warranty_life'];
        $warranty->notes = $validatedData['notes'];
        $warranty->status = $validatedData['status'];

        if( $validatedData['brand_id'] != 'new_brand' )
            $warranty->brand_id = $validatedData['brand_id'];
        else{
            $brand = Brand::firstOrNew( [ 'brand_name' => $validatedData['new_brand'] ]);
            $brand->save();
            $warranty->brand_id = $brand->id;
        }
        $warranty->save();
        return redirect('/warranties');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view( 'warranties.show', [ 'warranty' => Warranty::find( $id ), ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('warranties.edit',['warranty' =>Warranty::find($id),'brands'=>Brand::all()]);
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
        $validatedData = $request->validate(
            [
                'brand_id'=>'',
                'new_brand'=>'',
		        'purchase_date'=>'required',
		        'purchase_location'=>'required',
		        'receipt_url'=> 'image',
		        'serial_no'=>'required',
		        'warranty_life'=>'required',
		        'notes'=>'',
		        'status'=>'required', 
            ]
        );

        $warranty = Warranty::find($id);

        if( isset( $validatedData['receipt_url']) ){
            Storage::disk('local')->delete( $warranty->receipt_url );
            $imagePath = request('receipt_url')->store('public/warranties', 'local');
        }

        $warranty->brand_id = $validatedData['brand_id'];
        $warranty->purchase_date = $validatedData['purchase_date'];
        $warranty->purchase_location = $validatedData['purchase_location'];
        $warranty->serial_no = $validatedData['serial_no'];
        $warranty->warranty_life = $validatedData['warranty_life'];
        $warranty->notes = $validatedData['notes'];
        $warranty->status = $validatedData['status'];

        if( $validatedData['brand_id'] != 'new_brand' )
            $warranty->brand_id = $validatedData['brand_id'];
        else{
            $brand = Brand::firstOrNew( [ 'brand_name' => $validatedData['new_brand'] ]);
            $brand->save();
            $warranty->brand_id = $brand->id;
        }
        $warranty->save();
        return redirect('/warranties');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warranty::destroy($id);
        return redirect( '/warranties');
    }
}
