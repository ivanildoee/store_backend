<?php

namespace App\Http\Controllers;

use App\Models\Providers;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    
    public function index(Request $request)
    {
        $data = Providers::latest()
            ->orwhere('name','LIKE','%'.$request->search.'%')
            ->orwhere('country','LIKE','%'.$request->search.'%')
            ->orwhere('city','LIKE','%'.$request->search.'%')
            ->orwhere('state','LIKE','%'.$request->search.'%')
            ->orwhere('address','LIKE','%'.$request->search.'%')
            ->orwhere('email','LIKE','%'.$request->search.'%')
            ->orwhere('phone_number','LIKE','%'.$request->search.'%')
            ->paginate(10);
        return view('pages.providers.index',compact('data'));
    }

    
    public function create()
    {
        //
        $data = ['view_is'=>'create'];
        $title = 'Registar';
        return view('pages.providers.form',compact('data','title'));
    }

    
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        Providers::create($data);
        return redirect()->route('providers.index')->with('notification',['type'=>'success','message'=>'Fornecedor registado com sucesso','title'=>'Fornecedor '.$data['name']]);
    }

    
    public function show(Providers $provider)
    {
        $data = ['view_is'=>'view'];
        $title = 'Ver ficha '.$provider->name;
        return view('pages.providers.form',compact('data','title','provider'));
    }

    
    public function edit(Providers $provider)
    {
        $data = ['view_is'=>'update'];
        $title = 'Editar ficha '.$provider->name;
        return view('pages.providers.form',compact('data','title','provider'));
    }

    
    public function update(Request $request, Providers $provider)
    {
        $data = $request->except(['_token']);        
        $provider->update($data);
        return redirect()->route('providers.index')->with('notification',['type'=>'success','message'=>'Fornecedor editado com sucesso','title'=>'Fornecedor '.$data['name']]);
    }

    
    public function destroy(Providers $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')->with('notification',['type'=>'success','message'=>'Fornecedor eleminado com sucesso','title'=>'Fornecedor '.$provider['name']]);
    }
}
