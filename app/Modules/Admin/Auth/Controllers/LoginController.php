<?php

namespace App\Modules\Admin\Auth\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LoginController extends Base
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/administrator';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();

    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {

        /** set session refferrer */
        $this->setPreviousUrl();

        /** @var String $title */
        $this->title = __("admin.pages_login_title");
        /** @var String $content */
        $this->template = 'Admin::Auth.login';

        /**render output*/
        return $this->renderOutput();
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //set api token
        $user->api_token = Str::random(60);
        $user->update();

    }

    /**
     * Set prev url in session
     * @return bool
     */
    private function setPreviousUrl()
    {
        // Via the global helper...
        session(['previousUrl' => URL::previous()]);
        return true;
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {

        /** @var String $redirect */
        $redirect = property_exists($this, 'redirectTo') ? $this->redirectTo : '/';

        /** @var String $previousUrl */
        $previousUrl = session('previousUrl');

        //check $previousUrl
        if ($previousUrl) {

            /** @var Array $path */
            $path = parse_url($previousUrl);
            $redirect = $previousUrl;

        }

        return $redirect;
    }

}
