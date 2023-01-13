<?php

namespace App\Http\Controllers;

use App\Models\ProductMapIntegration;
use App\Models\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductMapIntegrationController extends Controller
{
    
    public function index(Request $request)
    {
        $data = ProductMapIntegration::latest()
            ->orwhere('field_name','LIKE','%'.$request->search.'%')
            ->orwhere('field_description','LIKE','%'.$request->search.'%')
            ->orwhere('field_price','LIKE','%'.$request->search.'%')
            ->orwhere('field_discountValue','LIKE','%'.$request->search.'%')
            ->orwhere('field_hasDiscount','LIKE','%'.$request->search.'%')
            ->orwhere('field_material','LIKE','%'.$request->search.'%')
            ->orwhere('field_category','LIKE','%'.$request->search.'%')
            ->orwhere('field_images','LIKE','%'.$request->search.'%')
            ->orwhere('field_departaments','LIKE','%'.$request->search.'%')
            ->orwhere('api_url','LIKE','%'.$request->search.'%')
            ->orwhere('api_token','LIKE','%'.$request->search.'%')
            ->orwhere('api_username','LIKE','%'.$request->search.'%')
            ->orwhere('api_password','LIKE','%'.$request->search.'%')
            ->paginate(10);
        return view('pages.product_integration.index',compact('data'));
    }

    
    public function create()
    {
        $data = ['view_is'=>'create'];
        $title = 'Registar';
        $providers = Providers::all();
        return view('pages.product_integration.form',compact('data','title','providers'));
    }

    
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        ProductMapIntegration::create($data);
        return redirect()->route('product_integrations.index')->with('notification',['type'=>'success','message'=>'Integração registado com sucesso','title'=>'Integração de Produto']);
    }

    
    public function show($id)
    {
        $data = ['view_is'=>'view'];
        $title = 'Ver integração';
        $productMapIntegration = ProductMapIntegration::find($id);
        $providers = Providers::all();
        return view('pages.product_integration.form',compact('data','title','productMapIntegration','providers'));
    }

    public function integrate($id)
    {
        $data = ['view_is'=>'view'];
        $title = 'Ver integração';
        $productMapIntegration = ProductMapIntegration::find($id);
        $API = Http::get($productMapIntegration->api_url,[
            'page' => 1,
            'limit' => 100,
            'search' => ''
        ]);
        $data = json_decode($API->body(),true);
        $MapedField = json_decode($productMapIntegration,true);
        echo json_encode($this->getProductIntragtion($data,$MapedField));
    }

    public function allProduct(Request $request)
    {
        $productMapIntegration = ProductMapIntegration::all();

        $limit = $request->query('limit', 50);
        $page = $request->query('page', 1);
        $search = $request->query('search', '');

        $Product= [];
        foreach($productMapIntegration as $integration){
            $API = Http::get($integration->api_url,[
                'page' => $page,
                'limit' => $limit,
                'search' => $search
            ]);
            $data = json_decode($API->body(),true);
            $MapedField = json_decode($integration,true);
            $Product = array_merge($Product,$this->getProductIntragtion($data,$MapedField));
            if(sizeof($Product)==$limit){
                break;
            }else{
                $limit = $limit - sizeof($Product);
                $page =1;
            }
        }
        
        return response()->json($Product);
        
    }

    public function get_product($integrate_id,$id)
    {
        $productMapIntegration = ProductMapIntegration::find($integrate_id);
        $API = Http::get($productMapIntegration->api_url.'/'.$id);
        $data[] = json_decode($API->body(),true);
        $MapedField = json_decode($productMapIntegration,true);
        $Product = $this->getProductIntragtion($data,$MapedField);
        return response()->json($Product[0]);
        
    }


    public function getProductIntragtion($Product_Provider,$productMapIntegration){
        $Product = []; //empty list product
        $fields = array_keys($productMapIntegration); //name field
        foreach($Product_Provider as $item){
            $item_line = [];
            $item_line['provider_id']=$productMapIntegration['providers_id'];
            $item_line['integrate_id']=$productMapIntegration['id'];
            foreach($fields as $field){
                $field_map = $productMapIntegration[$field];
                $field_map = explode('.',$field_map);
                $field_name = substr($field,6);
                
                $value = $item;
                if(str_contains($field,'field') && sizeof($field_map)>0){
                    foreach ($field_map as $fieldValue) {
                        if(isset($value[$fieldValue])){
                            $value = $value[$fieldValue];
                        }else{
                            $value = null;
                        } 
                    }
                    $item_line[$field_name] = $value;
                }
                
            }
            $Product[] = $item_line;
        }

        return $Product;
    }

    
    public function edit($id)
    {
        $data = ['view_is'=>'update'];
        $title = 'Editar integração';
        $productMapIntegration = ProductMapIntegration::find($id);
        $providers = Providers::all();
        return view('pages.product_integration.form',compact('data','title','productMapIntegration','providers'));
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token']);
        $productMapIntegration = ProductMapIntegration::find($id);       
        $productMapIntegration->update($data);
        return redirect()->route('product_integrations.index')->with('notification',['type'=>'success','message'=>'Integração editado com sucesso','title'=>'Integração de Produto']);
    }

    
    public function destroy($id)
    {
        $productMapIntegration = ProductMapIntegration::find($id); 
        $productMapIntegration->delete();
        return redirect()->route('product_integrations.index')->with('notification',['type'=>'success','message'=>'Integração eleminado com sucesso','title'=>'Integração de Produto']);
    }
}
