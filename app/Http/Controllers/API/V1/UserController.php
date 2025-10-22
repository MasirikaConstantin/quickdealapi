<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Inscription d'un nouvel utilisateur
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'role' => 'utilisateur', // Par défaut
            ]);

            // Créer le token d'accès
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Utilisateur créé avec succès',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'prenom' => $user->prenom,
                        'nom' => $user->nom,
                        'email' => $user->email,
                        'telephone' => $user->telephone,
                        'role' => $user->role,
                    ],
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'utilisateur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Connexion de l'utilisateur
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Identifiants incorrects'
                ], 401);
            }

            if (!$user->est_actif) {
                return response()->json([
                    'success' => false,
                    'message' => 'Votre compte est désactivé'
                ], 403);
            }

            // Révoquer tous les tokens existants (optionnel)
            // $user->tokens()->delete();

            // Créer un nouveau token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Connexion réussie',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'prenom' => $user->prenom,
                        'nom' => $user->nom,
                        'email' => $user->email,
                        'telephone' => $user->telephone,
                        'role' => $user->role,
                        'avatar' => $user->avatar,
                    ],
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la connexion',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout(Request $request)
    {
        try {
            // Supprimer le token courant
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la déconnexion',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Déconnexion de tous les appareils
     */
    public function logoutAll(Request $request)
    {
        try {
            // Supprimer tous les tokens de l'utilisateur
            $request->user()->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Déconnexion de tous les appareils réussie'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la déconnexion globale',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupérer le profil de l'utilisateur connecté
     */
    public function profile(Request $request)
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'prenom' => $user->prenom,
                        'nom' => $user->nom,
                        'email' => $user->email,
                        'telephone' => $user->telephone,
                        'role' => $user->role,
                        'bio' => $user->bio,
                        'avatar' => $user->avatar,
                        'adresse' => $user->adresse,
                        'ville' => $user->ville,
                        'code_postal' => $user->code_postal,
                        'note_vendeur' => $user->note_vendeur,
                        'ventes_totales' => $user->ventes_totales,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération du profil',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mettre à jour le profil de l'utilisateur
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'prenom' => 'sometimes|string|max:255',
            'nom' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user->update($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Profil mis à jour avec succès',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'prenom' => $user->prenom,
                        'nom' => $user->nom,
                        'email' => $user->email,
                        'telephone' => $user->telephone,
                        'bio' => $user->bio,
                        'adresse' => $user->adresse,
                        'ville' => $user->ville,
                        'code_postal' => $user->code_postal,
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du profil',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Rafraîchir le token (optionnel)
     */
    public function refreshToken(Request $request)
    {
        try {
            $user = $request->user();
            
            // Révoquer l'ancien token
            $request->user()->currentAccessToken()->delete();
            
            // Créer un nouveau token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Token rafraîchi avec succès',
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du rafraîchissement du token',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}