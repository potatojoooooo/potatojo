<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Auth;
use Ddeboer\Imap\Server;


class EmailController extends Controller
{
    public function index()
    {
        
        $url = "{imap.gmail.com:993/imap/ssl/novalidate-cert/norsh}Inbox";
        $id = "joanne0611@1utar.my";
        $pwd = "000611-01-0188";
        $imap = imap_open($url, $id, $pwd) or die('Cannot connect: '.imap_last_error());
        print("Connection established...." . "<br>");
        imap_close($imap);
        return view('dashboard');
    }
}
