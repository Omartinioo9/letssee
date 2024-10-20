<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Utilisateur::where('role', 'developer')->get();
        return response()->json($clients);
    }
    public function FindUtilisateur($id)
    {
        // Rechercher l'utilisateur par son ID
        $devloper = Utilisateur::find($id);
    
        // Vérifier si l'utilisateur a été trouvé
        if ($devloper) {
            // Retourner l'utilisateur trouvé en format JSON
            return response()->json($devloper);
        } else {
            // Retourner une réponse indiquant que l'utilisateur n'a pas été trouvé
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $wtv = Utilisateur::create($request->all());
        return response()->json($wtv, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        return response()->json($utilisateur, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6',
            'role' => 'nullable|string|in:client,developer',
            'status' => 'nullable|string|in:active,inactive',
            'programming_languages' => 'nullable|string',
            'frameworks' => 'nullable|string',
            'experience' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ?? $user->password;
        $user->role = $request->role ?? $user->role;
        $user->status = $request->status ?? $user->status;
        $user->programming_languages = $request->programming_languages ?? $user->programming_languages;
        $user->frameworks = $request->frameworks ?? $user->frameworks;
        $user->experience = $request->experience ?? $user->experience;

        // if ($request->hasFile('avatar')) {
        //     if ($user->avatar) {
        //         Storage::delete($user->avatar);
        //     }
        //     $user->avatar = $request->file('avatar')->store('avatars');
        // }

        $user->save();

        return response()->json($user, 200);
    }


    public function updateAvatar(Request $request)
{
    $user = auth()->user();

    $validator = Validator::make($request->all(), [
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    if ($request->hasFile('avatar')) {
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }
        $path = $request->file('avatar')->store('public/avatars');
        $user->avatar = str_replace('public/', '', $path);
        $user->save();
    }

    return response()->json($user, 200);
}

// public function me()
// {
//     $user = Auth::user();
//     return response()->json($user);
// }
    
}    