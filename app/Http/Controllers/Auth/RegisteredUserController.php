<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\collections;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = DB::table('users')
                ->select(
                    'id as id',
                    'fullname as fullname',
                    'username as username',
                    'address as address',
                    'phoneNumber as phoneNumber',
                    'birthdate as birthdate',
                    'religion as religion',
                    DB::raw('
                    (CASE
                    WHEN gender="1" THEN "Laki-laki"
                    WHEN gender="2" THEN "Perempuan"
                    END) AS gender
                    '),
                )->get();

            return Datatables::of($users)
                ->addColumn(
                    'action',
                    function ($user) {
                        $html =
                            '<a href="/userView/' . $user->id . '">Edit</a>';
                        return $html;
                    }
                )
                ->make(true);
        }
        return view('user.daftarPengguna');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function addUser()
    {
        return view('user.registrasi');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => ['required', 'string', 'max:100'],
                'fullname' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'address' => ['required', 'string', 'max:1000'],
                'birthdate' => ['required', 'date', 'before:today'],
                'phoneNumber' => ['required', 'string', 'max:20'],
                'religion' => ['required', 'string', 'max:20'],
                'gender' => ['integer'],
            ],
            [
                'username.required' => 'Username harus diisi',
                'username.unique' => 'Username telah digunakan',
                'birthdate.before' => 'Tanggal lahir harus sebelum hari ini'

            ]
        );

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'phoneNumber' => $request->phoneNumber,
            'religion' => $request->religion,
            'gender' => (int)$request->gender,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function show(User $user)
    {
        return view('user.infoPengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:1000'],
            'phoneNumber' => ['required', 'string', 'max:20'],
        ]);
        User::find($id)->update($validated);
        return redirect('/user');
    }

    // API 
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'message' => 'Invalid login     '
            ], 401);
        }
        $user = User::where('username', $request['username'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function getUserAPI()
    {
        $users = User::all();
        return response()->json($users, 200);
    }
}
