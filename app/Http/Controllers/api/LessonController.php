<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lesson;
use App\Transformers\LessonTransFormer;
use Illuminate\Http\Request;


class LessonController extends ApiController
{

    /**
     * @var LessonTransFormer
     */
    private $lessonTransFormer;

    public function __construct(LessonTransFormer $lessonTransFormer)
    {
        $this->lessonTransFormer = $lessonTransFormer;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all();

        if(!$lessons) {
            $this->setStatusCode(404)->responseNotFound();
        }

        return $this->response([
            'status' => 'success',
            'status_code' => 200,
            'data' => $this->lessonTransFormer->transformCollection($lessons->toArray())
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = Lesson::create($request->all());
        $this->response($lesson);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        if(!$lesson) {
            return $this->setStatusCode(404)->responseNotFound();
        }

        return $this->lessonTransFormer->transform($lesson);
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
        $status = Lesson::find($id)->update($request->all());
        if($status) {
            return $this->responseSuccess(Lesson::find($id));
        } else {
            return $this->setStatusCode(500)->response('修改操作失败！');
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
        $lesson = Lesson::find($id)->delete();
        return $lesson;
    }
}
