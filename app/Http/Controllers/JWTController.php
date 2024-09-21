<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class JWTController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'loginAdmin', 'loginEcommerce', 'register']]);
    }

    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'cNombres' => $request->name,
            'cApellidos' => $request->surname,
            'email' => $request->email,

            'cDocumento' => $request->cNroDocumento,
            'cAvatar' => '',
            'cCelular' =>  $request->cCelular,
            'dFechaNacimiento' =>null,
            'nGenero' => 0, // 1 para masculino
            'nTipoUsuario' => 1, // 1 para cliente ecommerce 2 par usuario administrador
            'nRol' => 0, // 1 para administrador, otro no definidos
            'nEstado' => 1, // 1 para activo


            'name' => $request->name,
            'surname' => $request->surname,
            'password' => $request->password,
            'type_user' => 1,
            'state' => 1,
            'role_id' => 0,
            'cUsuarioCreacion' => $request->cNroDocumento,
            'cUsuarioModificacion' => $request->cNroDocumento,



        ]);


        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth('api')->attempt(["email" => $request->email, "password" => $request->password, "state" => 1, "type_user" => 2])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function loginEcommerce(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // , "type_user" => 1
        if (!$token = auth('api')->attempt(["email" => $request->email, "password" => $request->password, "state" => 1])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = auth('api')->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            "user" => [
                "id" => $user->id,
                "name" => $user->name,
                "surname" => $user->surname,
                "email" => $user->email,
                "role" => $user->role,
                "cDocumento" => $user->cDocumento
            ],
        ]);
    }
}
