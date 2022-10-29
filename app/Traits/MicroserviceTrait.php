<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait MicroserviceTrait
{
    public function uri(Request $request, String $uri): JsonResponse
    {
        $response = match ($request->method()) {
            'POST' => Http::withHeaders([
                'Authorization' => $request->header('Authorization') ?? null,
            ])->post($uri . "" . $request->getRequestUri(), $request->request->all())->body(),
            'GET' => Http::withHeaders([
                'Authorization' => $request->header('Authorization') ?? null,
            ])->get($uri . "" . $request->getRequestUri(), $request->request->all())->body(),
            'DELETE' => Http::withHeaders([
                'Authorization' => $request->header('Authorization') ?? null,
            ])->delete($uri . "" . $request->getRequestUri(), $request->request->all())->body(),
            'PATCH' => Http::withHeaders([
                'Authorization' => $request->header('Authorization') ?? null,
            ])->patch($uri . "" . $request->getRequestUri(), $request->request->all())->body(),
        };
        $response = json_decode($response);
        return response()->json($response->content->body);
    }
}

