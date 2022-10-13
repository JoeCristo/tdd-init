<?php

namespace App\Http\DTO;

use Symfony\Component\HttpFoundation\Request;

interface RequestDto
{
    public  function __construct(Request $request);
}