<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
Use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }

    public function show(User $user)
    {
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password), 
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Usuário cadastrado com sucesso',
            ], 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy(User $user)
    {
       try{
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Usuário excluído com sucesso',
            ], 200);
       }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir usuário',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    
    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Usuário atualizado com sucesso',
            ], 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar usuário',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}


