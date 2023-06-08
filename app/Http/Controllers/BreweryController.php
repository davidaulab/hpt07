<?php

namespace App\Http\Controllers;

use App\Http\Requests\BreweryRequest;
use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use RuntimeException;

class BreweryController extends Controller
{
    //

    

    public function index () {
        $breweries = Brewery::orderBy('name')->get();
        //dd($breweries);
        return view ('breweries.index', ['breweries' => $breweries]);
    }

    public function proposals () {
      $breweries = Brewery::whereBelongsTo (Auth::user())->get();
      return view ('breweries.index', ['breweries' => $breweries]);
    }

    /* public function indexQB () {
      $breweries = DB::table('breweries')->get();
      //dd($breweries);
      return view ('breweries.index', ['breweries' => $breweries]);
 
    } */
    public function show (Brewery $brewery) {    
      return view ('breweries.show', compact('brewery'));
  }
    public function showQB ($id) {
        
        $brewery = DB::table('breweries')->find($id);
        return view ('breweries.show', compact('brewery'));
    }

    public function create() {
        $beers = Beer::orderBy('brand')->get();

        return view ('breweries.create', compact ('beers'));
    }
    public function store (BreweryRequest $request){
      /* $name= $request->name;
      $place = $request->place;
      $description = $request->description;
      $longitude = $request->longitude;
      $latitude = $request->latitude;
     */
      //dd ($request);
      $url= '';
      if ($request->hasFile('img')) {
        $path = $request->file('img')->store('public/breweries');
        $url = Storage::url($path);
        
      }
      
      try{
          /*$brewery = Brewery::create([
            'name' => $name,
            'place' => $place,
            'description' => $description,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'img' => $url
          ]); */
          

          $brewery = new Brewery ();
          $brewery->fill($request->validated());
          $brewery->img = $url;

          $brewery->user_id = Auth::id();

          //dd ($brewery);
          $brewery->saveOrFail ();


          $beers = $request->beers;
          $brewery->beers()->attach($beers);


          // ahora cargo las imágenes que no son de portada
          //dd($request);
          $url= '';
          if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
              $path = $image->store('public/breweries');
              $url = Storage::url($path);
              
              $miImagen = new Image ();
              $miImagen->img = $url;
              
              $miImagen->brewery_id = $brewery->id;

              $miImagen->saveOrFail();
              
              
            }

            
          }


      } catch (RuntimeException $e) {
        return back()->with ('message', 'Los datos indicados no son correctos')->with('code', 200);  
      }
 

      return redirect()->route ('breweries')->with ('message', 'Cervecería guardada correctamente')->with('code', 0);
  }
    public function storeQB (Request $request){
        $name= $request->name;
        $place = $request->place;
        $description = $request->description;
        $longitude = $request->longitude;
        $latitude = $request->latitude;
        
        $url= '';
        if ($request->hasFile('img')) {
          $path = $request->file('img')->store('public/breweries');
          $url = Storage::url($path);
          
        }
        
        try{
              DB::table('breweries')->insert([
                'name' => $name,
                'place' => $place,
                'description' => $description,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'img' => $url
          ]);
        } catch (RuntimeException $e) {
          return back()->with ('message', 'Los datos indicados no son correctos')->with('code', 200);  
        }


        return redirect()->route ('breweries')->with ('message', 'Cervecería guardada correctamente')->with('code', 0);
    }

    public function edit (Brewery $brewery) {
      $beers = Beer::orderBy('brand')->get ();
      return view ('breweries.edit', compact('brewery', 'beers'));

  }
    public function editQB ($id) {
        $brewery = DB::table('breweries')->find($id);
        //dd ($brewery);
        return view ('breweries.edit', compact('brewery'));

    }
    public function update (BreweryRequest $request, Brewery $brewery) {
/*
       $url= '';
       if ($request->hasFile('img')) {
         $path = $request->file('img')->store('public/breweries');
         $url = Storage::url($path);
       }   */
       //dd($request);
       $brewery->fill($request->validated()); 
       
       $brewery->user_id = Auth::user()->id;   

       if ($request->hasFile('img')) {
            $brewery->img = Storage::url($request->file('img')->store('public/breweries'));
       }
       try{
       
          
          $brewery->saveOrFail();

          $beers = $request->beers;
          $brewery->beers()->sync($beers);

       } catch (RuntimeException $e) {
         return back()->with ('message', 'Los datos indicados no son correctos')->with('code', 200);  
       }
   
       return redirect()->route ('breweries')->with ('message', 'Cervecería actualizada correctamente')->with('code', 0);
   
     }
    public function updateQB (Request $request, $id) {

     // dd($request);

      //$id = $request->id;
      $name= $request->name;
      $place = $request->place;
      $description = $request->description;
      $longitude = $request->longitude;
      $latitude = $request->latitude;
     
      $campos = [
        'name' => $name,
        'place' => $place,
        'description' => $description,
        'longitude' => $longitude,
        'latitude' => $latitude,
      ];

      $url= '';
      if ($request->hasFile('img')) {
        $path = $request->file('img')->store('public/breweries');
        $url = Storage::url($path);
        $campos['img'] = $url; 
      }   

      try{
          DB::table('breweries')->where('id', $id)->update($campos);
      } catch (RuntimeException $e) {
        return back()->with ('message', 'Los datos indicados no son correctos')->with('code', 200);  
      }
  
      return redirect()->route ('breweries')->with ('message', 'Cervecería actualizada correctamente')->with('code', 0);
  
    }
    public function delete (Brewery $brewery) {
      try{
        $brewery->beers()->detach();

        $brewery->deleteOrFail();
        
      } catch (RuntimeException $e) {
        return back()->with ('message', 'No ha sido posible borrar la cervecería')->with('code', 200);  
      }
  
      return redirect()->route ('breweries')->with ('message', 'Cervecería eliminada correctamente')->with('code', 0);
  

    }
    public function deleteQB ($id) {
      try{
        DB::table('breweries')->delete($id);
      } catch (RuntimeException $e) {
        return back()->with ('message', 'No ha sido posible borrar la cervecería')->with('code', 200);  
      }
  
      return redirect()->route ('breweries')->with ('message', 'Cervecería eliminada correctamente')->with('code', 0);
  

    }
}
