<?php

namespace App\Http\Controllers\System;
use App\User;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Database\Connection;
use Hyn\Tenancy\Exceptions\ConnectionException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var WebsiteRepository
     */
    private $websites;


    public function __construct()
    {
        $this->websites = app(WebsiteRepository::class);
        $this->connection = app(Connection::class);
    }


    public function getSubdomais(){
        return DB::table('hostnames')->get();
    }

    public function index(){

        $subdomains = $this->getSubdomais();

        return view('system.app.home', compact('subdomains'));

    }

    public function website($id){


        $hostname = DB::table('hostnames')->where('id' , '=', $id)->first();


        $web = DB::table('websites')->where('id', '=', $hostname->website_id )->first();



        $website = $this->websites->query()->where('id', $hostname->website_id)->firstOrFail();

        try {
            $this->connection->set($website);

        } catch (ConnectionException $e) {
            dd($e);
        }


        $users = User::all();


        return view('system.app.website', compact('web', 'hostname', 'users'));
    }


}
