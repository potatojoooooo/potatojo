<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\GmailService;


class EmailController extends Controller
{
    public function index()
    {
        $gmailService = new GmailService();
        $messages = $gmailService->listMessages();

        // Process $messages and return a response
        // Remove the var_dump statements
        return view('index');
    }
}
