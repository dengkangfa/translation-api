<?php

namespace App\Http\Controllers\Api;

use Hash;
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
//            $path = $this->upload($request->file('img'));
            $base64 = $request->get('img');
            $data['original'] = ['img' => $base64];
        } else {
//            $path = $this->upload($request->file('img'));
            $base64 = $request->get('img');
            $data['original'] = [
                    'text' => $request->get('text'),
                    'img' => $base64
                ];
        }

        $data['password'] = $request->password ? bcrypt($request->password) : '';

        $model = Translation::create($data);
        $url = config('app.url') . '/translation/' . $model->id;
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

    public function checkPasswordView($id)
    {
        return view('check_password', compact('id'));
    }

    public function checkPassword(Request $request)
    {
        $id = $request->get('id');
        $translation = Translation::findOrFail($id);
        if (Hash::check($request->get('password'), $translation->password)) {
            $request->session()->push('user.translation', $id);
            return redirect()->route('translation.show', $id);
        } else {
            return redirect()->back()->withErrors(['password' => '密码错误']);
        }
    }

}
