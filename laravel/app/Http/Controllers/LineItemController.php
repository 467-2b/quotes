<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class LineItemController extends Controller
{
    /**
     * Get a validator for an incoming newquote request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => ['required','int'],
            'description' => ['required','string'],
            'price' => ['required','numeric'],
            'quantity' => ['required','int']
        ]);
    }

    public function update(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->fails ())
            return Response::json ( array (             
                    'errors' => $validator->getMessageBag ()->toArray () 
            ) );
        else {
            $line_item = LineItem::find ( $request->id );
            $line_item->description = ($request->description);
            $line_item->price = ($request->price);
            $line_item->quantity = ($request->quantity);
            $line_item->save ();
            return response ()->json ( $line_item );
        }
    }

    public function destroy(Request $request){
        LineItem::find ( $request->id )->delete ();
        return response ()->json ();
    }
}
