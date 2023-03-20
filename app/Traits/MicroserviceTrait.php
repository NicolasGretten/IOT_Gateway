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

            } else if($uri === env('PAYMENT_API') && $request->header('Stripe-Signature') && $request->object == "event"){
                $response = Http::withHeaders([
                    "Accept" => $request->header('Accept'),
                    "Cache-Control" => $request->header('Cache-Control'),
                    "Connection" => $request->header('Connection'),
                    "Content-Length" => $request->header('Content-Length'),
                    "Content-Type" => $request->header('Content-Type'),
                    "Host" => $request->header('Host'),
                    "Stripe-Signature" => $request->header('Stripe-Signature'),
                    "User-Agent" => $request->header('User-Agent'),
                    "X-Forwarded-For" => $request->header('X-Forwarded-For'),
                    "X-Forwarded-Host" => $request->header('X-Forwarded-Host'),
                    "X-Forwarded-Port" => $request->header('X-Forwarded-Port'),
                    "X-Forwarded-Proto" => $request->header('X-Forwarded-Proto'),
                    "X-Real-Ip" => $request->header('X-Real-Ip')
                ])->post($uri . $request->getRequestUri(), $request->request->all())->body();
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
            return response()->json($response->content->body ?? []);
        } catch (Exception $e) {
            Bugsnag::notifyException($e);
            return response()->json($e->getMessage());
        }
    }
}

