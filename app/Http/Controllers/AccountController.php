<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Traits\FiltersTrait;
use App\Traits\IdTrait;
use App\Traits\JwtTrait;
use App\Traits\PaginationTrait;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;
use PDOException;
use Exception;
use RobThree\Auth\TwoFactorAuthException;

/**
 * @OA\Info(title="API Collect&Verything", version="0.1")
 */
class AccountController extends Controller
{
    use JwtTrait, FiltersTrait, PaginationTrait, IdTrait;

    /**
     * @OA\Get(
     *      path="/api/accounts/{id}",
     *      operationId="retrieve",
     *      tags={"Accounts"},
     *      summary="Get account information",
     *      description="Returns account data",
     *      @OA\Parameter(name="id",description="Account id",required=true,in="path"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Account not found."),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function retrieve(Request $request): JsonResponse
    {
        try {
            $resultSet = Account::select('*')
                ->where('id', $request->id);

            $this->filter($resultSet, ['deleted']);

            $account = $resultSet->first();

            if (empty($account)) {
                throw new ModelNotFoundException('Account not found.', 404);
            }

            return response()->json($account, 200);
        }
        catch (ValidationException | ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        } catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/accounts",
     *      operationId="list",
     *      tags={"Accounts"},
     *      summary="Get all account information",
     *      description="Returns accounts data",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'limit' => 'int|required_with:page',
                'page' => 'int|required_with:limit',
            ]);

            $resultSet = Account::select('*');

            $this->filter($resultSet, ['date', 'itemsId']);
            $this->paginate($resultSet);

            return response()->json($resultSet->get(), 200, ['pagination' => $this->pagination]);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ValidationException | ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        } catch (AuthenticationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 403);
        }
        catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/accounts",
     *      operationId="create",
     *      tags={"Accounts"},
     *      summary="Post a new account",
     *      description="Create a new account",
     *      @OA\Parameter(name="first_name", description="First name", required=true, in="query"),
     *      @OA\Parameter(name="last_name", description="Last name", required=true, in="query"),
     *      @OA\Parameter(name="gender", description="gender", required=true, in="query"),
     *      @OA\Parameter(name="phone", description="Phone number", required=true, in="query"),
     *      @OA\Parameter(name="birthday", description="Birthday date", required=true, in="query", @OA\Schema(type="Date")),
     *      @OA\Parameter(name="email", description="Email", required=true, in="query"),
     *      @OA\Parameter(name="password", description="Password", required=true, in="query"),
     *      @OA\Parameter(name="password_confirmation", description="Password confirmation", required=true, in="query"),
     *      @OA\Parameter(name="locale", description="Locale needed for the account translations", required=true, in="query"),
     *      @OA\Parameter(name="keep_logging", description="If the account stay logging", required=true, in="query", @OA\Schema(type="Boolean")),
     *      @OA\Response(response=201,description="Account created"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found")
     * )
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $request->merge([
                'email' => Str::lower($request->input('email'))
            ]);

            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'gender' => 'required|in:female,male,other',
                'phone' => 'string',
                'birthday' => 'required|date_format:Y-m-d',
                'email' => 'required|email|unique:accounts,email',
                'password' => 'required|between:8,255|confirmed',
                'locale' => 'required|string|in:' . env('LOCALES_ALLOWED'),
                'keep_logging' => 'required|boolean',
            ]);

            DB::beginTransaction();

            $account = new Account;

            $account->id = $this->generateId('account', $account);
            $account->gender = $request->input('gender');
            $account->accountNumber = $account->generateAccountNumber();
            $account->first_name = $request->input('first_name');
            $account->last_name = $request->input('last_name');
            $account->birthday = $request->input('birthday');
            $account->email = Str::lower($request->input('email'));
            $account->phone = $request->input('phone');
            $account->locale = $request->input('locale');
            $account->password = app('hash')->make($request->input('password'));
            $account->keep_logging = $request->input('keep_logging');

            $account->save();

            DB::commit();

            return response()->json($account->fresh(), 201);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
        catch (JsonEncodingException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), $e->getCode());
        } catch (DecryptException | Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Patch (
     *      path="/api/accounts/{id}",
     *      operationId="update",
     *      tags={"Accounts"},
     *      summary="Patch an account",
     *      description="Update an account",
     *      @OA\Parameter(name="first_name", description="First name", in="query"),
     *      @OA\Parameter(name="last_name", description="Last name", in="query"),
     *      @OA\Parameter(name="gender", description="gender", in="query"),
     *      @OA\Parameter(name="phone", description="Phone number", in="query"),
     *      @OA\Parameter(name="birthday", description="Birthday date", in="query"),
     *      @OA\Parameter(name="email", description="Email", in="query"),
     *      @OA\Parameter(name="locale", description="Locale needed for the account translations", in="query"),
     *      @OA\Parameter(name="keep_logging", description="If the account stay logging", in="query"),
     *      @OA\Response(
     *          response=200,
     *          description="Account updated"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'first_name' => 'string',
                'last_name' => 'string',
                'gender' => 'in:female,male,other',
                'birthday' => 'date_format:Y-m-d',
                'phone' => 'string',
                'email' => 'email|unique:accounts,email,' . $request->id,
                'locale' => 'string|in:' . env('LOCALES_ALLOWED'),
                'keep_logging' => 'boolean',
            ]);

            DB::beginTransaction();

            $resultSet = Account::select('*')
                ->where('id', $request->id);

            $account = $resultSet->first();

            if (empty($account)) {
                throw new ModelNotFoundException('Account not found.', 404);
            }

            $account->first_name = $request->input('first_name', $account->getOriginal('first_name'));
            $account->last_name = $request->input('last_name', $account->getOriginal('last_name'));
            $account->gender = $request->input('gender', $account->getOriginal('gender'));
            $account->birthday = $request->input('birthday', $account->getOriginal('birthday'));
            $account->phone = $request->input('phone', $account->getOriginal('phone'));
            $account->email = Str::lower($request->input('email', $account->getOriginal('email')));
            $account->locale = $request->input('locale', $account->getOriginal('locale'));
            $account->keep_logging = $request->input('keep_logging', $account->getOriginal('keep_logging'));

            $account->save();

            DB::commit();

            return response()->json($account->fresh(), 200);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ModelNotFoundException | JsonEncodingException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), $e->getCode());
        }
        catch (ValidationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
        catch (AuthenticationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 403);
        }
        catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete  (
     *      path="/api/accounts/{id}",
     *      operationId="delete",
     *      tags={"Accounts"},
     *      summary="Delete an account",
     *      description="Soft delete an account",
     *      @OA\Parameter(
     *          name="id",
     *          description="Account id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="String"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Account deleted"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $resultSet = Account::select('*')
                ->where('id', $request->id);

            $account = $resultSet->first();

            if (empty($account)) {
                throw new ModelNotFoundException('Account not found.', 404);
            }

            $account->delete();

            DB::commit();

            return response()->json($account->fresh(), 200);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), $e->getCode());
        }
        catch (ValidationException | Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @OA\Patch(
     *      path="/api/accounts/{id}/restore",
     *      operationId="restore",
     *      tags={"Accounts"},
     *      summary="Patch an account",
     *      description="Restore an account",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function restore(Request $request): JsonResponse
    {
        try {
            $resultSet = Account::select('*')
                ->where('id', $request->id)
                ->where('deleted_at', '>', Carbon::now()->subSeconds(env('DELETION_DELAY'))->hour(23)->minute(59)->second(59))
                ->onlyTrashed();

            $account = $resultSet->first();

            if (empty($account)) {
                throw new ModelNotFoundException('Account not found.', 404);
            }

            $account->restore();

            return response()->json($account->fresh(), 200);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), $e->getCode());
        }
        catch (ValidationException | Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/accounts/email-is-available",
     *      operationId="checkIfEmailIsAvailable",
     *      tags={"Accounts"},
     *      summary="Get an email verification",
     *      description="Check if email is available",
     *      @OA\Parameter(name="email", description="Email", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function checkIfEmailIsAvailable(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            $resultSet = Account::select('accounts.*')
                ->where('accounts.email', $request->email);

            if(empty($resultSet->first())) {
                return response()->json(['available' => true], 200);
            }

            return response()->json(['available' => false], 200);

        }
        catch(ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 404);
        }
        catch(ValidationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
        catch(Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/accounts/password-forgotten",
     *      operationId="checkIfEmailIsAvailable",
     *      tags={"Accounts"},
     *      summary="Get an email verification",
     *      description="Check if email is available",
     *      @OA\Parameter(name="email", description="Email", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function passwordForgotten(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|string|email'
            ]);

            DB::beginTransaction();

            $resultSet = Account::select('*')
                ->where('email', $request->input('email'));

            $account = $resultSet->first();

            if (empty($account)) {
                throw new ModelNotFoundException('Account not found.', 404);
            }

            $account->password_forgotten_token_limit = Carbon::now()->addMinutes(env('PASSWORD_TOKEN_LIMIT'));
            $account->password_forgotten_token = md5(Str::uuid());

            $account->update();

            DB::commit();

            return response()->json([
                'token_duration' => $account->password_forgotten_token_limit,
                'id' => $account->id
            ], 200);

        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), $e->getCode());
        }
        catch (ValidationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
        catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
    }

    public function passwordReset(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'token' => 'required|string',
                'password' => 'required|between:8,255|confirmed'
            ]);

            $resultSet = Account::select('*')
                ->where('email', $request->input('email'))
                ->where('password_forgotten_token', $request->input('token'))
                ->where('password_forgotten_token_limit', '>', Carbon::now());

            $account = $resultSet->first();

            if (empty($account)) {
                throw new ModelNotFoundException('Account not found.', 404);
            }

            $account->password = app('hash')->make($request->input('password'));
            $account->password_forgotten_token_limit = null;
            $account->password_forgotten_token = null;
            $account->update();

            return response()->json($account->fresh(), 200);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ModelNotFoundException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), $e->getCode());
        }
        catch (ValidationException | Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/accounts/sign-in",
     *      operationId="signIn",
     *      tags={"Accounts"},
     *      summary="Sign In",
     *      description="SignIn",
     *      @OA\Parameter(name="email", description="Email", required=true, in="query"),
     *      @OA\Parameter(name="password", description="Password", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function signIn(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $account = Account::where('email', Str::lower($request->input('email')))->first();

            if (empty($account)) {
                throw new AuthenticationException('You are unauthorized to access this resource.');
            }

            if (!Hash::check($request->input('password'), $account->password)) {
                throw new AuthenticationException('You are unauthorized to access this resource.');
            }

            $credentials = [
                'email' => $account->email,
                'password' => $request->input('password')
            ];

            if (!auth('account')->attempt($credentials)) {
                throw new AuthenticationException('You are unauthorized to access this resource.');
            }

            return response()->json($this->getToken($request, $account), 200);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (TwoFactorAuthException | AuthenticationException | Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
    }

    public function getToken(Request $request, Account $account): bool|Authenticatable|null
    {
        try {
            $credentials = [
                'email' => $account->email,
                'password' => $request->input('password')
            ];

            if (!$token = auth('account')->attempt($credentials)) {
                throw new AuthenticationException('You are unauthorized to access this resource.');
            }

            $account->last_login_at = Carbon::now();
            $account->save();

            $response = auth('account')->user();
            $response['credentials'] = [
                'token' => auth('account')->setTTL(env('JWT_TTL'))->attempt($credentials),
                'tokenType' => 'bearer',
                'expiresIn' => auth('account')->factory()->getTTL(),
            ];

            return $response;
        }
        catch (AuthenticationException $e) {
            Bugsnag::notifyException($e);
            return false;
        }
    }

    /**
     * @OA\Get(
     *      path="/api/accounts/me",
     *      operationId="me",
     *      tags={"Accounts"},
     *      summary="Get me information",
     *      description="Me",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     *      )
     */
    public function me(): JsonResponse
    {
        try {
            $account = auth('account')->user();

            if (empty($account)) {
                throw new AuthenticationException('You are unauthorized to access this resource.');
            }

            return response()->json($account, 200);
        }
        catch (AuthenticationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 401);
        }
        catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/accounts/refresh-token",
     *      operationId="refreshToken",
     *      tags={"Accounts"},
     *      summary="Refresh a token",
     *      description="Refresh JWT token",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     *)
     */
    public function refreshToken(Request $request): JsonResponse
    {
        try {
            $account = auth('account')->user();

            if (empty($account)) {
                throw new AuthenticationException('You are unauthorized to access this resource.');
            }

            $response = auth('account')->user();
            $response['credentials'] = [
                'token' => auth('account')->setTTL(env('JWT_TTL'))->refresh(),
                'token_type' => 'bearer',
                'expires_in' => auth('account')->factory()->getTTL(),
            ];

            return response()->json($response, 200);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (ValidationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
        catch (AuthenticationException $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 401);
        }
        catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/accounts/sign-out",
     *      operationId="signOut",
     *      tags={"Accounts"},
     *      summary="Sign out a user",
     *      description="Sign out a user",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     *      security={{"bearer_token":{}}}
     * )
     */
    public function signOut(): JsonResponse
    {
        try {
            $account = auth('account')->user();

            if (empty($account)) {
                throw new AuthenticationException('You are unauthorized to access this resource.');
            }

            auth('account')->logout();

            return response()->json(['message' => 'Successfully logged out.'], 200);
        }
        catch (PDOException $e) {
            Bugsnag::notifyException($e);
            throw new PDOException($e);
        }
        catch (AuthenticationException | Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/accounts/search",
     *      operationId="search",
     *      tags={"Accounts"},
     *      summary="Search an account by email",
     *      description="Search an account by email",
     *      @OA\Parameter(name="email", description="Email", required=true, in="query"),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=403, description="Forbidden"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=409, description="Conflict"),
     *      @OA\Response(response=500, description="Servor Error"),
     * )
     */
    public function search(Request $request): JsonResponse
    {
        try{
            $request->validate([
                'email' => 'required|email',
            ]);

            $resultSet = Account::select('*')
                ->where('email', $request->email);

            $account = $resultSet->first();

            if (empty($account)) {
                throw new ModelNotFoundException('Employee not found.', 404);
            }

            return response()->json($account, 200);

        } catch(Exception $e){
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage(), 409);
        }
    }
}
