<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Utility;
use App\Models\Admin\Language;
use App\Models\Admin\Country;
use App\Models\Admin\CountryContent;
use App\Models\Admin\Property;
use App\Models\Admin\Service;

use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AdminCountryController extends Controller
{
    protected $languages;
    public function __construct(){
        $this->languages = Language::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('order', 'asc')->paginate(10);
        return view('admin.taxonomy.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = $this->languages;
        return view('admin.taxonomy.country.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $languages = $this->languages;
        foreach($languages as $language) {
            // Validation
            $this->validateCat($request, $language->id);
        }

        $data = [];

        $default_language = Language::where('default', 1)->first();
        $data['alias'] = Utility::alias($request->name[$default_language->id], [], 'location');
        $data['featured'] = $request->featured ? $request->featured : 0;
        $data['order'] = $request->order ? $request->order : 0;
        $location = Country::create($data);

        unset($data);
        foreach($languages as $language) {
            // Getting name
            $data['location'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['location_id'] = $location->id;
            $data['language_id']  = $language->id;
            CountryContent::create($data);

        }

        return redirect('admin/taxonomy/country');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Why do we need to show this? You will see it in the front-end.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $languages = $this->languages;
        return view('admin.taxonomy.country.edit', compact('country', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $languages = $this->languages;
        foreach($languages as $language) {
            // Validation
            $this->validateCatUpdate($request, $id, $language->id);
        }

        // We get the location
        $location = Country::findOrFail($id);

        $data = [];


        // Updating the location
        $default_language = Language::where('default', 1)->first();
        
        // Update Alias
        if($request->alias){
            if($request->alias == ''){
                $data['alias'] = $location->alias;
            }else{
                $alias = Utility::fixAlias($request->alias);
                $c = count(Country::where('alias', 'LIKE', '%'. $alias .'%')->where('id', '<>', $location->id)->get());
                if($c){
                    $data['alias'] = $alias .'-'. $c;
                }else{
                    $data['alias'] = $alias;
                }
            }
        }

        $data['order'] = $request->order ? $request->order : $location->order;
        $data['featured'] = $request->featured ? $request->featured : 0;
        $location->update($data);

        // Updating the Content
        foreach($languages as $language) {

            unset($data);
            // Getting name
            $data['location'] = $request->name[$language->id];

            // Getting content from textarea
            $data['description'] = $request->description[$language->id];
            $data['location_id'] = $location->id;
            $data['language_id']  = $language->id;

            // Update the Location Content
            $location_content = CountryContent::where(['language_id' => $language->id, 'location_id' => $id])->first();
            $location_content->update($data);
        }

        return redirect('admin/taxonomy/country');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            if(Property::where('country_id', $id)->first()){
                return response()->json(get_string('connected_item'), 400);
            }else {
                $this->delete($id);
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Handling mass deletion
    public function massDestroy(Request $request){
        if($request->ajax() && isset($request->id)){
            $ids = $request->id;
            foreach ($ids as $id){
                if(Property::where('location_id', $id)->first() || Service::where('location_id', $id)->first()){
                    return response()->json(get_string('connected_item'), 400);
                }else {
                    $this->delete($id);
                }
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Validating the location on craete
    public function validateCat(Request $request, $lang_id){
        $this->validate($request, [
            'name.'.$lang_id.'' => 'required',
            'description.'.$lang_id.'' => 'max:300',
        ],[
            'name.'.$lang_id.'.required'    => get_string('required_field'),
            'description.'.$lang_id.'.max'  => get_string('description_max_300')
        ]);
    }

    // Validating the location on update
    public function validateCatUpdate(Request $request, $id, $lang_id){
        $this->validate($request, [
            'name.'.$lang_id.'' => 'required',
            'description.'.$lang_id.'' => 'max:500',
        ],[
            // 'name.'.$lang_id.'.required'    => get_string('required_field'),
            'name.'.$lang_id.'.unique'      => get_string('not_unique_field'),
            'description.'.$lang_id.'.max'  => get_string('description_max_300')
        ]);
    }

    // Autocomplete
    public function autocomplete(Request $request){

        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];
            $default = Language::where('default', 1)->first();

            $locations = LocationContent::where([['location', 'LIKE', '%' . $term . '%'],['language_id', '=', $default->id]])->take(5)->get();
            foreach ($locations as $location) {
                $results[] = ['id' => $location->location_id, 'name' => $location->location];
            }

            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching locations
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';

        $location_ids = LocationContent::where('location', 'LIKE', '%'.$term.'%')->get()->pluck('location_id');

        $locations = Location::whereIn('id', $location_ids)->orderBy('order', 'asc')->paginate(10);

        return view('admin.taxonomy.location.search', compact('locations'));
    }

    // Helper function for delete
    public function delete($id){

        // Getting the Location
        $location = Country::findOrFail($id);

        // Deleting the Content
        $languages = $this->languages;
        foreach($languages as $language){
            $location->content($language->id)->delete();
        }

        // Deleting the Location
        $location->delete();
    }

    // Delete Home Image
    public function deleteHomeImage(Request $request, $id)
    {
        if($request->ajax()){
            $location = Country::findOrFail($id);
            if(strpos($location->home_image, 'no_image.jpg') === FALSE && File::exists(public_path() . $location->home_image)){
                File::delete((public_path() . $location->home_image));
            };
            $location->home_image = null;
            $location->save();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Delete Featured Image
    public function deleteFeatured(Request $request, $id)
    {
        if($request->ajax()){
            $location = Country::findOrFail($id);
            if(strpos($location->featured_image, 'no_image.jpg') === FALSE && File::exists(public_path() . $location->featured_image)){
                File::delete((public_path() . $location->featured_image));
            };
            $location->featured_image = null;
            $location->save();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
