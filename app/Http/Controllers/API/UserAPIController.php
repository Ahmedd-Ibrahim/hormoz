<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Requests\API\UpdateUserInformation;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UserInformationResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use League\CommonMark\Block\Element\ThematicBreak;
use Response;

use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
//        $this->middleware('user.role:admin-moderator',['except'=>['create']]);

    }

    /**
     * Display a listing of the User.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendSuccess('User deleted successfully');
    }

    /*
     * login form
     * @return instance of user & token
     * */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->sendError('invalid_credentials',400);
            }
        } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = User::where('email',$request->email)->first();
        $user['token'] =  $token;
        return $this->sendResponse(new UserResource($user,$token), 'User crossed successfully');

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:user,seller',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(),400);
        }

        $user = \App\User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        $user['token'] = $token;
        return $this->sendResponse(new UserResource($user), 'User crossed successfully');
    }

    public function forgetPassword(Request $request)
    {
        $user = User::where('phone','=',$request->phone)->first();
        if($user)
        {
            return $this->sendResponse('exists','success');
        } else{
            return $this->sendResponse('not exists','error');

        }

    }

    public function setPassword(Request $request)
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim

        $user->update(['password'=>bcrypt($request->password)]);
        $token = ['token'=>jwtAuth::fromUser($user)];
        $data = [$user,$token];
        return $this->sendResponse( $data,'error');

    } // End of set password

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);

    } // End of logout


    public function profile()
    {
         $user = $this->userRepository->getUserInfo();

         if (!$user) {
             return $this->sendError('Need To Send token');
         }

         return $this->sendResponse(new UserInformationResource($user),'User Information received successfully');
    }


    public function updateProfile(UpdateUserInformation $request)
    {
        $input = $request->all();

        $update = $this->userRepository->updateProfile($input);

        if (!$update) {
            return $this->sendError('Need To Send token');
        }

        return $this->sendResponse(new UserInformationResource($update),'User Information updated successfully');
    }


    public function updatePassword(UpdatePasswordRequest $request)
    {

        $input = $request->all();
        $update = $this->userRepository->updatePass($input);

        if(empty($update)) {
            return $this->sendError('Check requirement');
        } elseif (!empty($this->userRepository->errors)) {
            return $this->sendError($this->userRepository->errors);
        }

        return $this->sendSuccess('password Updated Successfully');
    }
}
