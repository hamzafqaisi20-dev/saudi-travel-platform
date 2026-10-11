<?php

namespace App\Providers;

use App\Services\AiTravelPlannerInterface;
use App\Services\MockAiTravelPlannerService;
use App\Services\OpenAiTravelPlannerService;
use Illuminate\Support\ServiceProvider;

class AiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AiTravelPlannerInterface::class, function ($app) {
            $provider = env('AI_PLANNER_PROVIDER', 'mock');

            if ($provider === 'openai' && !empty(env('OPENAI_API_KEY'))) {
                return new OpenAiTravelPlannerService();
            }

            return new MockAiTravelPlannerService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
