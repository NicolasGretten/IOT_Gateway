<?php

namespace App\Traits;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

trait MicroserviceTrait
{
    public function uri(Request $request, String $uri): JsonResponse
    {
        try{
            if($uri === env('IMAGE_API') && $request->hasFile('file') && $request->file('file')->isValid()){
                $image = $request->file('file');
                $response = Http::attach('file', file_get_contents($image), 'image.png')
                    ->withHeaders([
                        'Authorization' => $request->header('Authorization') ?? null,
                    ])
                    ->post($uri . $request->getRequestUri(), $request->request->all())->body();

            } else if($uri === env('PAYMENT_API')){
                Log::alert("REQUEST =================== " . $request);
                Http::withHeaders($request->header())->post($uri . $request->getRequestUri(), $request->request->all())->body();
            } else {
                $response = match ($request->method()) {
                    'POST' => Http::withHeaders([
                        'Authorization' => $request->header('Authorization') ?? null,
                    ])->post($uri . $request->getRequestUri(), $request->request->all())->body(),
                    'GET' => Http::withHeaders([
                        'Authorization' => $request->header('Authorization') ?? null,
                    ])->get($uri . $request->getRequestUri(), $request)->body(),
                    'DELETE' => Http::withHeaders([
                        'Authorization' => $request->header('Authorization') ?? null,
                    ])->delete($uri . $request->getRequestUri(), $request->request->all())->body(),
                    'PATCH' => Http::withHeaders([
                        'Authorization' => $request->header('Authorization') ?? null,
                    ])->patch($uri . $request->getRequestUri(), $request->request->all())->body(),
                };
            }

            $response = json_decode($response);
            return response()->json($response->content->body);
        } catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage());
        }
    }
}

