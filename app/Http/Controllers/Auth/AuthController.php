<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have successfully logged in');
        }

        return redirect("login")->withSuccess('You have entered invalid credentials');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $this->create($request->all());

        $user = Auth::user();

        // using your user id we will create a braintree id with same id
        $response = \Braintree\Customer::create([
            'id' => $user->id
        ]);

        // save your braintree id
        if( $response->success) {
            $user->braintree_id = $response->customer->id;
            $user->save();
        }

        $data = ["subscription" => $user->braintree_plan, "active" => $user->braintree_active];

        return redirect("dashboard", $data)->withSuccess('You have successfully logged in');
    }

    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user();
            $data = ["subscription" => $user->braintree_plan, "active" => $user->braintree_active];
            return view('dashboard', $data);
        }

        return redirect("login")->withSuccess('Access denied');
    }

    private function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
