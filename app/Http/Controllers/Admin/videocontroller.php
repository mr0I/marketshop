<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use Validator;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class videocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();

        return view('admin.videos.list', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    public function uploadpage($video_id)
    {
        session()->forget('videoID');
        session()->put('videoID', $video_id);

        return view('admin.videos.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100|unique:videos',
            'status' => 'required'
        ]);

        $res = Video::create($request->all());
        if ($res){
            Toastr::success("ویدئو تعریف شد.");
            return redirect('/admin/videos');
        }

    }


    public function upload(Request $request){
        if(! empty($_FILES['video']['name'])){
            $file = $request->video;
            $filename = $_FILES['video']['name'];
            $filetype = $_FILES['video']['type'];
            $filetemp = $_FILES['video']['tmp_name'];

            $filename = microtime() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path().'\uploads\videos', $filename);
            if($file){
                if (session()->has('videoID')){
                    $id = session()->get('videoID');
                    $video = Video::find($id);
                    $array = [];
                    $video->update(array_merge($array, ['video'=>$filename]));
                }
                return 'آپلود موفق';
            }else{
                return 'خطا در آپلود';
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }


    public function AjaxUpdate(Request $request){
        $video = Video::find($request->video_id);

        $old_name = $video->name;
        if ($request->name != $old_name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:videos'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100'
            ]);
        }

        if ($validator->fails()) {
            echo $validator->errors();
        }else{
            if ($request->status == 1){
                $all_videos = Video::all();
                foreach ($all_videos as $vid){
                    $vid->status = 2;
                    $vid->save();
                }
            }
            $res = $video->update(array_merge($request->all(), [
                'name' => $request->name,
                'status' => $request->status,
                'video' => $video->video
            ]));

            if ($res){
                echo 1;
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        $res = $video->delete();
        // delete video file
        if ($res){
            Toastr::success("ویدئو پاک شد.");
            return redirect()->back();
        }
    }
}
