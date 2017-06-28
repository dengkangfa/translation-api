<?php

namespace App\Http\Middleware;

use App\Translation;
use Closure;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->id;
        $translation = Translation::findorFail($id);
        $idArr = !is_null($request->session()->get('user.translation')) ?: [];
        if( empty($translation->password) || in_array($id, $idArr)) {
                return $next($request);
        }
        return redirect()->route('translation.checkPasswordView', $id);
    }
}
