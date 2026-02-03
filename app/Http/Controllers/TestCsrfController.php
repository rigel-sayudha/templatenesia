<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestCsrfController extends Controller
{
    public function testCsrf()
    {
        return response()->json([
            'ok' => true,
            'csrf_token' => csrf_token(),
            'session_id' => session()->getId(),
            'session_driver' => config('session.driver'),
            'session_cookie' => config('session.cookie'),
        ]);
    }

    public function testLivewireModal()
    {
        return view('test-livewire-modal');
    }
}
