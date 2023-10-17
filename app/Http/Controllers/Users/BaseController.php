<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\User\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
