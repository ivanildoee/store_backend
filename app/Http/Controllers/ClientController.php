<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\Sale;
use App\Models\SaleLine;
use App\Models\RelSaleToSaleLine;
use Hash;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function index(Request $request)
    {
        $data = client::latest()
            ->orwhere('name','LIKE','%'.$request->search.'%')
            ->orwhere('country','LIKE','%'.$request->search.'%')
            ->orwhere('city','LIKE','%'.$request->search.'%')
            ->orwhere('state','LIKE','%'.$request->search.'%')
            ->orwhere('address','LIKE','%'.$request->search.'%')
            ->paginate(10);
        return view('pages.clients.index',compact('data'));
    }

    public function create()
    {
        //
        $data = ['view_is'=>'create'];
        $title = 'Registar';
        return view('pages.clients.form',compact('data','title'));
    }

    public function store(Request $request)
    {
        $client = $request->except(['_token']);
        client::create($client);
        return redirect()->route('clients.index')->with('notification',['type'=>'success','message'=>'Cliente registado com sucesso','title'=>'Cliente '.$client['name']]);
    }

    public function register(Request $request) //for api
    {
        $client = $request->except(['_token','sale','sale_lines']);
        $sale = $request->input(['sale']);
        $sale_line = $request->input(['sale_lines']);
        $check_client = client::where('email',$client['email'])->first();
        if( $check_client){
            $check_client->update($client);
        }else{
            $check_client=client::create($client);
        }

        if($sale && $check_client && sizeof($sale_line)){
            $sale['client_id']=$check_client->id;
            $sale_save = Sale::create($sale);
            foreach ($sale_line as $item) {
                unset($item->product);
                $saleLineResult = SaleLine::create($item);
                RelSaleToSaleLine::create(["sale_id"=>$sale_save->id,"sale_line_id"=>$saleLineResult->id]);
            }
        }
        return response()->json(['type'=>'success','message'=>'Cliente registado com sucesso','title'=>'Cliente '.$client['name']]);
    }

    public function show(client $client)
    {
        //$client = client::with('user')->where('id',1)->first();
        
        $data = ['view_is'=>'view'];
        $title = 'Ver ficha '.$client->name;
        return view('pages.clients.form',compact('data','title','client'));
    }

    
    public function edit(client $client)
    {
        $data = ['view_is'=>'update'];
        $title = 'Editar ficha '.$client->name;
        return view('pages.clients.form',compact('data','title','client'));
    }

    
    public function update(Request $request, client $client)
    {
        //
        $client_data = $request->except(['_token']);        
        $client->update($client_data);
        return redirect()->route('clients.index')->with('notification',['type'=>'success','message'=>'Cliente editado com sucesso','title'=>'Cliente '.$client_data['name']]);
    }

    
    public function destroy(client $client)
    {
        //
        $client->delete();
        return redirect()->route('clients.index')->with('notification',['type'=>'success','message'=>'Cliente eliminado com sucesso','title'=>'Cliente '.$client['name']]);
    }
}
