<?php
  
namespace App\Http\Controllers;
   
use App\Models\Vacancy;
use Illuminate\Http\Request;
  
class VacancyCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vacancies'] = Vacancy::orderBy('id','desc')->paginate(5);
    
        return view('index', $data);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required'
        ]);

        $imageName = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images', $imageName);

        $Vacancy = new Vacancy;
        $Vacancy->title = $request->title;
        $Vacancy->description = $request->description;
        $Vacancy->image = $imageName;
        $Vacancy->save();
     
        return redirect('vacancies')
               ->with('success','Vacancy has been created successfully.');
    }
     
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacancy  $Vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
        $data['vacancy'] = Vacancy::find($id);
    
        return view('edit', $data);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacancy  $Vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $id = $request->id;

        $Vacancy = Vacancy::find($id);

        // Check if a new image file was uploaded
        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($Vacancy->image) {
                \Storage::delete('public/images/' . $Vacancy->image);
            }
            // Store the new image file
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $imageName);
            $Vacancy->image = $imageName;
        }

        $Vacancy->title = $request->title;
        $Vacancy->description = $request->description;
        $Vacancy->save();
    
              return redirect('vacancies')
               ->with('success','Vacancy has been updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacancy  $Vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $Vacancy = Vacancy::where('id',$id)->delete();
    
         return redirect('vacancies')
               ->with('success','Vacancy has been deleted successfully.');
    }
}