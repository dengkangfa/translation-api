<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Translation;
use Illuminate\Http\Request;

class TranslationController extends ApiController
{
    const TYPE = ['text', 'img', 'graphic'];

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->errors());
        }


        $type = $request->get('type');
        if(!in_array($type, self::TYPE)){
            return $this->response([
                'status' => 'error',
                'message' => '原文类型不符合要求',
                'code' => '422'
            ]);
        }

        $data = array_only($request->all(), ['type', 'translation', 'password']);
        if($request->get('type') == 'text'){
            $data['original'] = ['text' => $request->get('text')];
        } elseif ($request->get('type') == 'img') {
            $path = $this->upload($request->file('img'));
            $data['original'] = ['img' => $path];
        } else {
            $path = $this->upload($request->file('img'));
            $data['original'] = [
                    'text' => $request->get('text'),
                    'img' => $path
                ];
        }

        $model = Translation::create($data);
        $url = config('app.url') . '/api/v1/translation/' . $model->id;
        return $this->responseSuccess($url);
    }

    public function show($id)
    {
        $translation = Translation::findorFail($id);

        return view('translation', compact('translation'));
    }

    public function upload($file)
    {
        $folderName = 'uploads/images/';
        $filename = time() . '.' . $file->getClientOriginalExtension() ?: 'png';
        $file->move($folderName, $filename);
        return config('app.url') . '/' . $folderName . $filename;
    }

}
