<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\User;
use Hyn\Tenancy\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;

class RegisterController extends Controller
{

    public function register(Request $data){
        $domain_base = Config::get('app.domain_base');
        $data['subDomain'] =   $data['subDomain'] . '.' . $domain_base;

         $data->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'subDomain' =>['required', 'string', 'unique:hostnames,fqdn']
        ]);
        $hostname = $this->createTenant($data['subDomain']);
        app( Environment::class )->hostname( $hostname );

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $url ='https://'. $data['subDomain'];
        if ($user){
            return Redirect::to($url);
        }

    }

    public function formRegister(){
        return view('system.auth.register');
    }


    public function createTenant($subdomain){
        $website = new Website;
        app(WebsiteRepository::class)->create($website);
        $hostname = new Hostname;
        $hostname->fqdn = $subdomain;
        $hostname = app(HostnameRepository::class)->create($hostname);
        app(HostnameRepository::class)->attach($hostname, $website);
        return $hostname;
    }
}
