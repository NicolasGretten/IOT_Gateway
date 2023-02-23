<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Traits\MicroserviceTrait;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    use MicroserviceTrait;

    /**
     * Create a new subscription
     *
     * Create a new subscription.
     *
     * @param $payload
     * @return JsonResponse
     */
    public function create($payload): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     * Update a subscription
     *
     * Update a subscription by swapping the plan.
     *
     * @param $payload
     * @return Subscription|null
     */
    public function update($payload): ?Subscription
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     * Delete a subscription
     *
     * Delete a subscription.
     *
     * @group Subscriptions
     *
     * @urlParam id        required    Customer ID         Example: cus_JL3EpIjK0AsHy3
     *
     * @bodyParam subscription_name required    Subscription name   Example: abonnement professionnels
     *
     * @responseFile /responses/subscriptions/delete.json
     *
     * @param $payload
     * @return JsonResponse
     */
    public function delete($payload): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));

    }

    /**
     * Resume a subscription
     *
     * Resume a previously deleted subscription.
     *
     * @group Subscriptions
     *
     * @urlParam id        required    Customer ID         Example: cus_JL3EpIjK0AsHy3
     *
     * @bodyParam subscription_name required    Subscription name   Example: abonnement professionnels
     *
     * @responseFile /responses/subscriptions/resume.json
     *
     * @param $payload
     * @return JsonResponse
     */
    public function resume($payload): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /**
     * @param $payload
     * @return JsonResponse
     */
    public function quantity($payload): JsonResponse
    {
        return $this->uri($request, env("PAYMENT_API"));
    }

    /*
     * Return a user by his Id.
     */
    public function findCustomer($payload){
        return $this->uri($request, env("PAYMENT_API"));
    }
}
