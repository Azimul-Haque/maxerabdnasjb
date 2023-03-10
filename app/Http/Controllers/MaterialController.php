<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;

use Carbon\Carbon;
use DB;
// use Hash;
use Auth;
// use Image;
// use File;
// use Session;
// use Artisan;
use Redirect;
// use OneSignal;
// use Cache;

class MaterialController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(['admin'])->only('storeMaterial', 'updateMaterial', 'deleteMaterial');
        // $this->middleware(['manager'])->only();
    }

    public function getMaterials()
    {
        if(!(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
            abort(403, 'Access Denied');
        }
        
        $totalmaterials = Material::count();
        $materials = Material::orderBy('id', 'desc')->paginate(10);

        return view('dashboard.materials.index')
                    ->withMaterials($materials)
                    ->withTotalmaterials($totalmaterials);
    }

    public function storeMaterial(Request $request)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'type'    => 'required|integer',
            'title'    => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'author_desc'    => 'required|string|max:255',
            'content'    => 'required',
            'url'     => 'required|string|max:255',
            'status'     => 'required|integer',
        ));

        $material             = new Material;
        $material->type   = $request->type;
        $material->title   = $request->title;
        $material->author    = $request->author;
        $material->author_desc    = $request->author_desc;
        $material->content    = $request->content;
        $material->url    = $request->url;
        $material->status     = $request->status;
        $material->save();


        Session::flash('success', 'Material added successfully!');
        return redirect()->back();
        // if(request()->routeIs('dashboard.questionstopicbased')) {
        //     return redirect()->route('dashboard.questionstopicbased', $request->topic_id);
        // } else {
        //     return redirect()->route('dashboard.questions');
        // }
        
    }

    public function updateMaterial(Request $request, $id)
    {
        // dd($request->file('image'));
        $this->validate($request,array(
            'topic_id'    => 'required|string|max:191',
            'question'    => 'required|string|max:255',
            'option1'     => 'required|string|max:191',
            'option2'     => 'required|string|max:191',
            'option3'     => 'required|string|max:191',
            'option4'     => 'required|string|max:191',
            'answer'      => 'required',
            'difficulty'  => 'required|string|max:191',
            'image'       => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3000',
            'explanation' => 'sometimes|max:2048',
        ));

        // dd($request->tags_ids);

        $question             = Question::findOrFail($id);
        $question->topic_id   = $request->topic_id;
        $question->question   = $request->question;
        $question->option1    = $request->option1;
        $question->option2    = $request->option2;
        $question->option3    = $request->option3;
        $question->option4    = $request->option4;
        $question->answer     = $request->answer;
        $question->difficulty = $request->difficulty;
        $question->save();

        if(isset($request->tags_ids)){
            $question->tags()->sync($request->tags_ids, true);
        }

        // image upload
        if($request->hasFile('image')) {
            if($question->questionimage) {
                $image_path = public_path('images/questions/'. $question->questionimage->image);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $question->questionimage->delete();
            }
            $image      = $request->file('image');
            $filename   = random_string(5) . time() .'.' . "webp";
            $location   = public_path('images/questions/'. $filename);
            Image::make($image)->resize(350, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $questionimage = new Questionimage;
            $questionimage->question_id = $question->id;
            $questionimage->image = $filename;
            $questionimage->save();
        }

        if($request->explanation) {
            if($question->questionexplanation) {
                $question->questionexplanation->explanation = $request->explanation;
                $question->questionexplanation->save();
            } else {
                $questionexplanation = new Questionexplanation;
                $questionexplanation->question_id = $question->id;
                $questionexplanation->explanation = $request->explanation;
                $questionexplanation->save();
            }
        }

        Session::flash('success', 'Question updated successfully!');
        // return redirect()->route('dashboard.questions');
        return redirect()->back();
        // dd(url()->previous());
        // if(request()->routeIs('dashboard.questionstopicbased')) {
        //     return redirect()->route('dashboard.questionstopicbased', $request->topic_id);
        // } else {
        //     return redirect()->route('dashboard.questions');
        // }
    }

    public function deleteMaterial($id)
    {
        $question = Question::find($id);
        if($question->questionimage) {
            $image_path = public_path('images/questions/'. $question->questionimage->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $question->questionimage->delete();
        }
        if($question->questionexplanation) {
            $question->questionexplanation->delete();
        }
        $question->delete();

        Session::flash('success', 'Question deleted successfully!');
        return redirect()->route('dashboard.questions');
    }
}
