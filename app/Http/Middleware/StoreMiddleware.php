<?php
namespace App\Http\Middleware;

use App\Traits\JwtTrait;
use Closure;

use Exception;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Crypt;
use TheSeer\Tokenizer\TokenCollectionException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class StoreMiddleware
{
    use JwtTrait;

    public function handle($request, Closure $next)
    {
        try {
           if(env('app_env') == "production"){
               if($this->jwt('profile')->get('account')->store_id !== $request->headers('x_store_header')) {
                   return $this->error();
               }
               if(!$request->headers('x_store_header')){
                   return $this->error();
               }

               if($request->store_id && $request->headers('x_store_header') !== $request->store_id){
                   return $this->error();
               }

               if(str_contains($request->id, 'store_') && $request->headers('x_store_header') !== $request->id){
                   return $this->error();
               }
           }
            return $request;
        }
        catch(Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    private function error($message = null)
    {
        return response('Something went wrong with yout request.', 405);
    }
}
