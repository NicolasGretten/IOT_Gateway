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

class RoleAuthorizationMiddleware
{
    use JwtTrait;

    public function handle($request, Closure $next, ...$roles)
    {
        /*
         * User logged from another API
         */
        try {
            if(sizeof(array_intersect(explode(',', strtolower($this->jwt('profile')->get('account')->role)), $roles))) {
                return $next($request);
            }
        }
        catch(TokenExpiredException | TokenInvalidException | TokenBlacklistedException | Exception $e) {
            return response($e->getMessage(), 500);
        }

        return $this->unauthorized();
    }

    private function unauthorized($message = null)
    {
        return response('You are unauthorized to access this resource.', 405);
    }
}
