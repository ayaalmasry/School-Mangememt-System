<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    use AuthTrait;

    
    public function loginForm($type){

        return view('auth.login',compact('type'));
    }

    public function login(Request $request){
        
        

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->intended(RouteServiceProvider::STUDENT);// return redirect(RouteServiceProvider::STUDENT);
   
        }
        
         if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->intended(RouteServiceProvider::HOME);// return redirect(RouteServiceProvider::STUDENT);
   
        }
        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->intended(RouteServiceProvider::TEACHER);// return redirect(RouteServiceProvider::STUDENT);
   
        }
        if (Auth::guard('parent')->attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->intended(RouteServiceProvider::PARENT);// return redirect(RouteServiceProvider::STUDENT);
   
        }
        

    }

    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function dashboard(){
        return view('dashboard');
    }
    
    public function student(){
        return view('dashboardstudent');
    }




}