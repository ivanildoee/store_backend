<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sale::latest()->with('client')->paginate(10);
        return view('pages.sales.index',compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $user = Sale::with('sale_line')->first();
        return response()->json($user);
    }

    public function getCart($id)
    {
        $sale = Sale::with('sale_line')->where('id',$id)->first();
        $html = '';
        $productControler = new ProductMapIntegrationController;
        if($sale && $sale->sale_line){            
            foreach ($sale->sale_line as $item) {
                $product = $productControler->get_product($item->integration_id,$item->product_id);
                $product = $product->getData();
                $html .= '
                    <tr>
                        <td><img style="max-width: 50px"  src="'.(($product->images && is_array($product->images) ) ? $product->images[0] : $product->images).'" alt="Product" /></td>
                        <td><strong>'.$product->name.'</strong></td>
                        <td>'.$item->quantity.'</td>
                        <td><span>$'.$item->price_unit.'</span></td>
                        <td><span>$'.$item->price_discount.'</span></td>
                        <td><span>$'.$item->price_total.'</span></td>
                    </tr>
                ';
            }
        }
        //return $html;
        return response()->json(['html'=>$html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('notification',['type'=>'success','message'=>'Venda eliminado com sucesso','title'=>'Venda do cliente '.$sale['client']['name']]);
    }
}
