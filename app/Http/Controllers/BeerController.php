<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*
    public function index2()
    {
        //
        Paginator::useBootstrapFive();

        $beers = Beer::orderBy('brand')->paginate(6);

        return view ('beers.index', compact ('beers'));
        
    } */
    public function index (Request $request) {
        Paginator::useBootstrapFive();
        $beers = Beer::orderBy('brand')->paginate(3);
        if ($request->ajax()) {
            $ret = '';
            if (count($beers) > 0) {
                foreach ($beers as $beer) {
                    $stars = view ('components.stars', ['valor' => $beer->vol, 'step' => "2" ])->render();
                    
                    $atts = [
                        'name' => $beer->brand,
                        'description' => $beer->description,
                        'urlView' => route('beers.show', $beer),
                        'claseCard' => "col-sm-4",
                        'urlImg' => ( ( isset($beer->img) && ($beer->img != '')) ? $beer->img : asset('img/default.jpg')),
                        'place' => $stars,
                        
                    ];
    
                    $ret .= view ('components.card', $atts)->render();
                }
            }
          
            return response()->json(['beers' => $ret]);

        }
        
        
        return view ('beers.index', compact ('beers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (Auth::check()) {
            $breweries = Brewery::orderBy('name')->get();
            return view ('beers.create', compact ('breweries'));    
        }
        else {
            return redirect ()
                    -> route ('beers.index')
                    -> with ('message', 'Error: solamente los usuarios registrados pueden crear cervezas')
                    -> with('code', '501');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (Auth::check()) {
            $beer = new Beer ();
            $beer->brand = $request->brand;
            $beer->description = $request->description;
            $beer->vol = $request->vol;
            $beer->price = $request->price;
            
            if ($request->hasFile('img')) {
                $beer->img = Storage::url( $request->file('img')->store('public/beers'));
            }
            $beer->saveOrFail();

            $breweries = $request->breweries;
            $beer->breweries()->attach($breweries);

            return redirect ()->route('beers.index')->with ('message', 'Cerveza guardada correctamente')->with ('code', '0');
        }
        else {
            return redirect ()
                    -> route ('beers.index')
                    -> with ('message', 'Error: solamente los usuarios registrados pueden crear cervezas')
                    -> with('code', '501');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Beer $beer)
    {
        //
        $endpoint = 'https://api.frankfurter.app/';
        $operation = 'latest';
        $params = [
            'amount' => $beer->price,
            'from' => 'EUR',
            'to' => 'JPY,GBP,USD,MXN'
        ];

        $response = Http::withoutVerifying()->get($endpoint . $operation, $params);
        $responseJson = $response->json();
        //dd($responseJson);
        $exchanges = $responseJson['rates'];
        //dd($exchanges);
        return view ('beers.show', compact ('beer', 'exchanges'));
    }

    /**
     * Display the specified resource by friendly url.
     */
    public function friendly (string $name)
    {
        //
        $beers = Beer::where('brand', $name)->get();
        if (!isset ($beers) || (count($beers) == 0)) {
            return redirect()->route ('beers.index')
                    ->with('message', 'No hemos encontrado la cerveza')
                    ->with ('code', '500');
        }
        else {
            if (count ($beers) == 1) {
                $beer = $beers -> first();
                //dd($beer);
                return view ('beers.show', compact ('beer'));
            }
            else {
                return view ('beers.index', compact ('beers'))
                    ->with('message', 'Hay mas de una cerveza con el nombre indicado')
                    ->with ('code', '0');
            }
        }

        
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beer $beer)
    {
        //
        if (Auth::check()) {

            $breweries = Brewery::orderBy('name')->get();
            return view ('beers.edit', compact('beer', 'breweries'));
        }
        else {
            return redirect ()
            -> route ('beers.index')
            -> with ('message', 'Error: solamente los usuarios registrados pueden modificar cervezas')
            -> with('code', '501');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beer $beer)
    {
        //
        if (Auth::check()) {
            $beer->brand = $request->brand;
            $beer->description = $request->input('description');
            $beer->vol = $request->vol;
            $beer->price = $request->price;
            if ($request->hasFile('img')) {
                $beer->img = Storage::url( $request->file('img')->store('public/beers'));
            }
            $beer->saveOrFail();

            $breweries = $request->breweries;
            $beer->breweries()->sync($breweries);

            return redirect()->route('beers.index')->with ('message', 'Cerveza modificada correctamente')->with ('code', '0');
        }
        else {
            return redirect ()
            -> route ('beers.index')
            -> with ('message', 'Error: solamente los usuarios registrados pueden modificar cervezas')
            -> with('code', '501');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beer $beer)
    {
        //
        if (Auth::check()) {
            $beer->breweries()->detach();
            $beer->deleteOrFail();
            return redirect()->route('beers.index')->with ('message', 'Cerveza eliminada correctamente')->with ('code', '0');
        }
        else {
            return redirect ()
            -> route ('beers.index')
            -> with ('message', 'Error: solamente los usuarios registrados pueden borrar cervezas')
            -> with('code', '501');
        }
        

    }
}
