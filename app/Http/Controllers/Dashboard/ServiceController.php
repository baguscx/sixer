<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;
use App\Models\AdvantageService;
use App\Models\AdvantageUser;
use App\Models\Service;
use App\Models\Tagline;
use App\Models\ThumbnailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $thumbnail = ThumbnailService::all();
        return view('sixer.pages.dashboard.service.index', compact('services', 'thumbnail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sixer.pages.dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->all();

        $data['users_id'] = Auth::user()->id;

        //add to service
        $service = Service::create($data);

        //add to advantange service
        foreach ($data['advantage-service'] as $key => $value) {
            $advantage_service = new AdvantageService;
            $advantage_service->service_id = $service->id;
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        //add to advantage user
        foreach ($data['advantage-user'] as $key => $value) {
            $advantage_user = new AdvantageUser;
            $advantage_user->service_id = $service->id;
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        //add to thumbnail service
        if($request->hasFile('thumbnail')){
            foreach($request->file('thumbnail') as $file){
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service->id;
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }
        }

        //add to tagline
        foreach ($data['tagline'] as $key => $value) {
            $tagline = new Tagline;
            $tagline->service_id = $service->id;
            $tagline->tagline = $value;
            $tagline->save();
        }

        toast()->success('Save has been success');
        return redirect()->route('member.service.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $advantage_service = AdvantageService::where('service_id', $service->id)->get();
        $advantage_user = AdvantageUser::where('service_id', $service->id)->get();
        $thumbnail_service = ThumbnailService::where('service_id', $service->id)->get();
        $tagline = Tagline::where('service_id', $service->id)->get();
        return view('sixer.pages.dashboard.service.edit', compact('service', 'advantage_service', 'advantage_user', 'thumbnail_service', 'tagline'));
        // return view('sixer.pages.dashboard.service.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->all();

        // dd($data);

        //update to service
        $service->update($data);

        //update advantage service
        foreach ($data['advantage-services'] as $key => $value) {
            $advantage_service = AdvantageService::find($key);
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        //add new advantage service
        if(isset($data['advantage-service'])){
            foreach ($data['advantage-service'] as $key => $value) {
                $advantage_service = New AdvantageService;
                $advantage_service->service_id = $service->id;
                $advantage_service->advantage = $value;
                $advantage_service->save();
            }
        }

        //update advantage user
        foreach ($data['advantage-users'] as $key => $value) {
            $advantage_user = AdvantageUser::find($key);
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        //add new advantage user
        if(isset($data['advantage-user'])){
            foreach ($data['advantage-user'] as $key => $value) {
                $advantage_user = New AdvantageUser;
                $advantage_user->service_id = $service->id;
                $advantage_user->advantage = $value;
                $advantage_user->save();
            }
        }

        //update tagline
        foreach ($data['taglines'] as $key => $value) {
            $tagline = Tagline::find($key);
            $tagline->tagline = $value;
            $tagline->save();
        }

        //add new tagline
        if(isset($data['tagline'])){
            foreach ($data['tagline'] as $key => $value) {
                $tagline = New Tagline;
                $tagline->service_id = $service->id;
                $tagline->tagline = $value;
                $tagline->save();
            }
        }

        //update thumbnail service
        if($request->hasFile('thumbnails')){
            foreach($request->file('thumbnails') as $key => $file) {
                //get old photo thumbnail
                $get_photo = ThumbnailService::where('id', $key)->first();

                //store photo
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                //update thumbnail
                $thumbnail_service = ThumbnailService::find($key);
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();

                //delete old photo
                $data = 'storage'.$get_photo->photo;
                if(File::exists($data)){
                    File::delete($data);
                } else {
                    File::delete('storage/app/public/'.$get_photo->photo);
                }
            }
        }

        //add new thumbnail service
        if($request->hasfile('thumbnail')){
            foreach($request->file('thumbnail') as $file){
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service->id;
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }

        }

        toast()->success('Update has been success');
        return redirect()->route('member.service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404);
    }
}
