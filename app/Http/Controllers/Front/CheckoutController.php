<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCart;
use App\Models\Bank;
use Auth;
use App\Models\Order;
use App\Models\OrderList;
use DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        return view('pages.front.checkout.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return view('pages.front.checkout.success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $datas =  count($request->id);
            for ($i=0; $i < $datas; $i++) { 
                UserCart::find($request->id[$i])->update([
                    'qty' => $request->qty[$i]
                ]);
            }

            return redirect('checkout');
        } catch (\Exception $e) {
            dd($e);   
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proccesssuccess(Request $request)
    {
       try {

            $carts = Auth::user()->carts()->get();

            DB::transaction(function () use ($request,$carts)   {
              
                $order =   Order::create([ 
                                          'date'    => now(), 
                                          'sts'     => 0, 
                                          'bank_id' => $request->bank_id,
                                          'user_id' => Auth::user()->id,
                                      ]);
                foreach ($carts as $key => $c) {

                    $sub_total      = $c->product->price * $c->qty;
                    $total_discount = $c->product->discount * $c->qty;
                   OrderList::create([ 
                        'order_id'       => $order->id,
                        'product_id'     => $c->product->id,
                        'name'           => $c->product->name,
                        'description'    => $c->product->description,
                        'price'          => $c->product->price,
                        'image'          => $c->product->image,
                        'ammount'        => $c->qty,
                        'sub_total'      => $sub_total,
                        'total_discount' => $total_discount,
                        'total_price'    => $sub_total - $total_discount
                        

                   ]);
                }
                
                Auth::user()->carts()->delete();
                
                 
            });

              
            return redirect('checkout-success');
        
       } catch (\Exception $e) {
           dd($e);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
