<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        // Esto es para controlar lo que se puede ver en el perfil. Si es estudiante solo puede ver su perfil.
        if ((Auth::user()->role && (Auth::user()->role->role == 'estudiante')) && (Auth::check() && $user->id != Auth::user()->id)) {
            abort(404);
        }

        return view('profile.show', ['user' => $user]);
    }

    /**
     * Change the current password.
     */
    public function changePass()
    {
        $user = Auth::user();
        return view('profile.change-pass', ['user' => $user]);
    }

    /**
     * Store the new password.
     */
    public function storePass(Request $request)
    {
        $user = Auth::user();

        $this->validatePass($request);

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.'])->withInput();
        }

        $user->password = Hash::make($request->new_password);

        // Guardar el nuevo usuario
        $user->save();

        return redirect()->route('profile', ['user' => $user])->with('success', 'Contraseña actualizada correctamente.');
    }

    public function storeImage(Request $request)
    {
        $user = Auth::user();

        $validator = \Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:512',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return back()->with('error', 'La imagen no es válida o es demasiado grande, debe tener un tamaño máximo de 512 KB.');
        }

        if ($request->hasFile('photo')) {
            try {
                $image = $request->file('photo');
                $imageData = file_get_contents($image->getRealPath());

                $user->photo = $imageData;
                $user->save();

                return redirect()->route('profile')->with('success', 'Imagen de perfil actualizada correctamente.');
            } catch (\Exception $e) {
                return redirect()->route('profile')->with('error', 'No se ha podido actualizar la imagen de perfil.');
            }
        }
    }

    private function validatePass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            // Confirmed busca automáticamente un campo con el nombre new_password_confirmation
            'new_password' => [
                'required',
                'min:8',
                'max:255',
                'confirmed',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'new_password_confirmation' => 'required',
        ], [
            // Mensajes de error personalizados según lo que falle
            'new_password.regex' => 'La contraseña debe contener al menos una letra, un número y un carácter especial.',
            'new_password.confirmed' => 'Las contraseñas no coinciden.',
            'new_password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'new_password.max' => 'La contraseña no puede tener más de 255 caracteres.',
            'new_password_confirmation.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'new_password_confirmation.max' => 'La contraseña no puede tener más de 255 caracteres.',
        ]);
    }
}
