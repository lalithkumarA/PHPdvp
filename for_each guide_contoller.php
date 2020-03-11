<?php

namespace App\Http\Controllers\OwnerController\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BoreSizeType;
use App\ExpenseType;

class BoreSizeTypeController extends Controller
{

    public function __construct(){
        $this->ExpenseType = new ExpenseType;
        $this->BoreSizeType = new BoreSizeType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $Data['boresizetypes'] = $this->BoreSizeType::where([['company_id',auth()->user()->company_id]])->get();
        return view('owner.master.bore_size_type.view',$Data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('owner.master.bore_size_type.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate(request(),[
            'size' => 'required',
        ]);
        try {
            // return request('type');
            // $BoreSizeType = new $this->BoreSizeType;
            // $BoreSizeType->size = request('size');  
            // $BoreSizeType->type = request('type');
            // $BoreSizeType->company_id = auth()->user()->company_id;
            // $BoreSizeType->created_by = auth()->user()->id;
            // $BoreSizeType->updated_by = auth()->user()->id;
            if(request('size')){
                // return 1;
                // return request()->all();

            foreach(request('type') as $BoreSizeTypekey=>$boreSizeType){
                // $val[]=$BoreSizeType;

                // dd($boreSizeType);

                $BoreSizeType = new $this->BoreSizeType;
                $BoreSizeType->size = request('size');  
                $BoreSizeType->type =$boreSizeType;
                $BoreSizeType->company_id = auth()->user()->company_id;
                $BoreSizeType->created_by = auth()->user()->id;
                $BoreSizeType->updated_by = auth()->user()->id;
                $BoreSizeType->save();
            }
            // return $val;
        }
            return redirect(action('OwnerController\Master\BoreSizeTypeController@index'))->with('success',['Bore Size Type','Created Successfully']);
        }catch (\Exception $e){
            return back()->with('sorry','Sorry,Something went wrong!');
        }
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
    public function edit($id){
         try {
            $Data['boresizetype'] = $this->BoreSizeType::findorfail($id);
            $Data['boresizetypes'] = $this->BoreSizeType::where([['company_id',auth()->user()->company_id]])->get();
            return view('owner.master.bore_size_type.view',$Data);
        }catch (\Exception $e){
            return back()->with('sorry','Sorry,Something went wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate(request(),[
            'size' => 'required',
        ]);
        try {
            $BoreSizeType = $this->BoreSizeType::find($id);
            $BoreSizeType->size = request('size');
            $BoreSizeType->type = request('type');
            $BoreSizeType->updated_by = auth()->user()->id;
            $BoreSizeType->save();
            return redirect(action('OwnerController\Master\BoreSizeTypeController@index'))->with('success',['Bore Size Type','Updated Successfully']);
        }catch (\Exception $e){
            return back()->with('sorry','Sorry,Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try {
            $this->BoreSizeType::find($id)->delete();
            return redirect(action('OwnerController\Master\BoreSizeTypeController@index'))->with('success',['Bore Size Type','Deleted Successfully']);
        }catch (\Exception $e){
            return back()->with('sorry','Sorry,Something went wrong!');
        }
    }
}


{{Form::label('sports', 'Sports')}}
{{Form::select('sports',$aSports,null,array('multiple'=>'multiple','name'=>'sports[]'))}}
However, in my experience the 3rd parameter of the select is a string only, so for repopulating data for a multi-select I have had to do something like this:

<select multiple="multiple" name="sports[]" id="sports">
@foreach($aSports as $aKey => $aSport)
    @foreach($aItem->sports as $aItemKey => $aItemSport)
        <option value="{{$aKey}}" @if($aKey == $aItemKey)selected="selected"@endif>{{$aSport}}</option>
    @endforeach
@endforeach
</select>