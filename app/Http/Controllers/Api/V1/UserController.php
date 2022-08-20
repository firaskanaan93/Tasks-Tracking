<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $users = User::where(function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->input('term', '') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->input('term', '') . '%');
        })
            ->where('role', $request->input('role', 'normal'))
            ->get(['id', 'name as text']);

        return ['results' => $users];
    }
}
