<?php

namespace Controllers;

use Models\QB;
use Models\User;
use Rakit\Validation\Validator;
use Systems\Auth;
use Systems\Cookie;
use Systems\Date;
use Carbon\Carbon;
use Systems\View;
use Systems\Url;

class AuthController
{
    function login()
    {
        $validator = new Validator();
        $validation = $validator->validate($_POST, [
            'phone' => 'required|numeric',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";
            return View::redirect('', ['danger' => $errors->$msg], true);
        }
        global $_COOKIE_LOGIN;
        $username = $_POST['phone'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];
        /*  if (isset($_POST['g-recaptcha-response'])) {
              $captcha = $_POST['g-recaptcha-response'];
          }
          if (!$captcha) {
        $post_back['login']['error'] = 'Please check the the captcha form.';
        $post_back['username']['value'] = $username;
            return View::make('login', $post_back);
         }
        $secret = '6LebYKUZAAAAAC1MFI5w5FTiiq8NoA3Y_1a-uoGe';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        $responseData = json_decode($response);
        if ($responseData->success == false) {
             $post_back['login']['error'] = 'You are spammer ! Get the @$%K out';
             $post_back['username']['value'] = $username;
             return View::make('login', $post_back);
         } else {     */
        $db = new User();
        $check_user = $db->login($username);
        if ($check_user) {
            $hashedPassword = $check_user[0]["user_password"];
            if (!password_verify($password, $hashedPassword))
                return View::redirect('', ['danger' => 'نام کاربری یا کلمه عبور نادرست است .'], true);
            $user = $check_user[0];
            Auth::setSessionLogin($user);
            if ($remember) {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $user_ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $user_ip = $_SERVER['REMOTE_ADDR'];
                }
                //$_SESSION['user_is_loggedin'] = 1;
                $cookiehash = md5(sha1($username . $user_ip));
                Cookie::put($_COOKIE_LOGIN, $cookiehash, time() + 3600 * 24 * 365, '/', '');
                $QB = QB::getInstance();
                $QB->update(User::table, ['user_session' => $cookiehash])->where(User::primary, $user[User::primary])->exec();
            }
            $address = User::redirect();
            if (isset($_POST['reference']) && $_POST['reference'] !== '' && $_POST['reference'] !== $_SERVER['HTTP_ORIGIN'] . '/login/') {
                $address = $_POST['reference'];
            }
            return View::redirect('../' . $address);
        } else
            return View::redirect('', ['danger' => 'نام کاربری یا کلمه عبور نادرست است .'], true);
        //}
    }

    function loginAfterRegister($user_id)
    {
        $QB = QB::getInstance();
        $user = $QB->table(User::table)->where(User::primary, $user_id)->get()->toArray()[0];
        Auth::setSessionLogin($user);
        $address = User::redirect();
        return View::redirect('../' . $address);
    }

    function register()
    {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        self::check_before_register();
        // Check exists email & username
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $registerdate = Date::now();
        $db = new User();
        $create_new_acount = $db->create_acount($name, $email, $phone, $hashedPassword, $registerdate);
        if ($create_new_acount) {
            return self::loginAfterRegister($create_new_acount);
        } else {
            return View::redirect('', ['danger' => 'در فرایند ثبت نام مشکلی پیش آمده :('], true);
        }
    }

    function check_before_register(){
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
        ]);
        $validation->setMessages([
            //'phone:numeric' => 'شماره تلفن وارد شده معتبر نیست',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";
            return View::redirect('', ['danger' => $msg], true);
        }
        $QB = QB::getInstance();
        $check_email = $QB->table(User::table)->where('user_email', $email)->QGet();
        if ($check_email)
            return View::redirect('', ['danger' => 'ایمیل وارد شده موجود می باشد .'], true);
        $check_phone = $QB->table(User::table)->where('user_phone', $phone)->QGet();
        if (count($check_phone) > 0)
            return View::redirect('', ['danger' => 'شماره تلفن وارد شده موجود می باشد .'], true);
    }

    function forget_password()
    {
        $code = rand(100000, 999999);
        $phone = $_POST['phone'];
        //$hashedphone = password_hash($phone, PASSWORD_DEFAULT);
        $QB = QB::getInstance();
        $check_phone = $QB->table(User::table)->where('user_phone', $phone)->QGet();
        if (count($check_phone) == 0)
            return View::redirect('', ['danger' => 'شماره تلفن وارد شده موجود نمی باشد .'], null, ['phone' => $phone]);
        $QB->delete('resetpassword')->where('user_phone', $phone)->exec();
        $QB->insert('resetpassword', ['user_phone' => $phone, 'reset_code' => $code, 'reset_expired' => Carbon::now()->addMinute(4)]);
        return View::redirect('../recovery_password?user=' . $phone);
    }

    function recovery_password()
    {
        $phone = Url::get('user');
        $QB = QB::getInstance();
        $code = $_POST['code'];
        $check_code = $QB->table('resetpassword')->where('user_phone', $phone)->where('reset_code', $code)->QGet();
        if (count($check_code) == 0)
            return View::redirect('', ['danger' => ['کد وارد شده صحیح نمی باشد .']]);
        $expire = Carbon::createFromFormat('Y-m-d H:i:s', $check_code[0]['reset_expired']);
        if ($expire->isPast())
            return View::redirect('../forget', ['danger' => ['کد وارد شده منقضی شده است.']], null, ['phone' => $phone]);
        $token = password_hash($code, PASSWORD_DEFAULT);
        return View::redirect('../new_password?user=' . $phone . '&token=' . $token);
    }

    function new_password()
    {
        $phone = Url::get('user');
        $code = Url::get('token');
        $password = $_POST['password'];
        $validator = new Validator;
        $validation = $validator->validate($_POST, [
            'password' => 'required|min:6',
            'confirm-password' => 'required|same:password',
        ]);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";
            return View::redirect('', ['danger' => $msg]);
        }
        $QB = QB::getInstance();
        $check_code = $QB->table('resetpassword')->where('user_phone', $phone)->QGet();
        if (count($check_code) == 0)
            return View::redirect('../forget', ['danger' => ['درخواست نامعتبر است.']]);
        else {
            $resetcode = $check_code[0]['reset_code'];
            if (!password_verify($resetcode, $code))
                return View::redirect('../forget', ['danger' => ['درخواست نامعتبر است.']]);
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $check = $QB->update(User::table, ['user_password' => $hashedPassword])->where('user_phone', $phone)->exec();
        $QB->delete('resetpassword')->where('user_phone', $phone)->exec();
        if (!$check)
            return View::redirect('', ['danger' => 'عملیات تغییر رمز موفقیت آمیر نبود.']);
        return View::redirect('../login', ['success' => 'رمز با موفقیت تغییر کرد']);
    }

    function logout()
    {
        $QB = QB::getInstance();
        $QB->update(User::table, ['user_session' => NULL])->where(User::primary, Auth::id())->exec();
        global $_COOKIE_JWT;
        global $_COOKIE_LOGIN;
        Cookie::destroy($_COOKIE_LOGIN);
        Cookie::destroy($_COOKIE_JWT);
        @session_start();
        @session_destroy();
        return View::redirect('../index');

    }

    function edit()
    {
        $user = Auth::user();
        return View::make('auth/edit', ['user' => $user]);
    }

    function check_before_update($user_id)
    {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";
            return View::redirect('', ['danger' => $msg], true);
        }

        if (!empty($password)) {
            $validator = new Validator;
            $validation = $validator->make($_POST, [
                'password' => 'min:6',
                'confirm-password' => 'required|same:password',
            ]);
            $validation->validate();
            if ($validation->fails()) {
                $errors = $validation->errors();
                $errors = $errors->firstOfAll();
                $msg = '';
                foreach ($errors as $error)
                    $msg .= "<pre>$error</pre>";
                return View::redirect('', ['danger' => $msg], true);
            }
        }
        // Check exists email & username
        $QB = QB::getInstance();
        $check_email = $QB->table(User::table)->where('user_email', $email)->where(User::primary, '!=', $user_id)->QGet();
        if ($check_email)
            return View::redirect('', ['danger' => 'ایمیل وارد شده موجود می باشد .'], true);
        $check_phone = $QB->table(User::table)->where('user_phone', $phone)->where(User::primary, '!=', $user_id)->QGet();
        if (count($check_phone) > 0)
            return View::redirect('', ['danger' => 'شماره تلفن وارد شده موجود می باشد .'], true);

    }

    function update()
    {
        $user_id = Auth::id();
        self::check_before_update($user_id);
        $QB = QB::getInstance();
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $registerdate = Date::now();
        $create_new_acount = $QB->update(User::table, ['user_name' => $name,
            'user_phone' => $phone, 'user_email' => $email, 'user_update' => $registerdate])->where(User::primary, $user_id)->exec();
        if (!empty($password))
            $QB->update(User::table, ['user_password' => $hashedPassword])->where(User::primary, $user_id);
        if (!$create_new_acount)
            return View::redirect('', ['danger' => 'در فرایند ویرایش مشکلی پیش آمده :('], true);
        Auth::updateSessionLogin($user_id);
        return View::redirect('../' . User::redirect(), ['success' => 'اطلاعات با موفقیت به روز رسانی شد.']);
    }

    function adminStore()
    {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        self::check_before_register();
        // Check exists email & username
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $registerdate = Date::now();
        $db = new User();
        $create_new_acount = $db->create_admin($name, $email, $phone, $hashedPassword, $registerdate);
        if ($create_new_acount) {
            return View::redirect('../adminUserIndex', ['succeess' => 'مدیر با موفقیت ثبت شد :)']);
        } else {
            return View::redirect('', ['danger' => 'در فرایند ثبت مشکلی پیش آمده :('], true);
        }
    }

    function adminUpdate()
    {
        $user_id = Url::get('id');
        self::check_before_update($user_id);

        $QB = QB::getInstance();
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $registerdate = Date::now();
        $create_new_acount = $QB->update(User::table, ['user_name' => $name,
            'user_phone' => $phone, 'user_email' => $email, 'user_update' => $registerdate])->where(User::primary, $user_id)->exec();
        if (!empty($password))
            $QB->update(User::table, ['user_password' => $hashedPassword])->where(User::primary, $user_id);
        if (!$create_new_acount)
            return View::redirect('', ['danger' => 'در فرایند ویرایش مشکلی پیش آمده :('], true);
        return View::redirect('../adminUserIndex', ['success' => 'اطلاعات با موفقیت به روز رسانی شد.']);
    }
}