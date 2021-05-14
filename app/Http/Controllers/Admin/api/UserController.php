<?php

namespace App\Http\Controllers\Admin\api;

use App\Http\Controllers\Controller;
use App\Jobs\ProductCreatedJob;
use App\Jobs\ProductDeletedJob;
use App\Jobs\ProductUpdatedJob;
use App\Models\Product;
use App\Models\User;

class UserController extends Controller
{
    public function random()
    {
        $user = User::inRandomOrder()->first();

        return [
            'id' => $user->id
        ];
    }
}
