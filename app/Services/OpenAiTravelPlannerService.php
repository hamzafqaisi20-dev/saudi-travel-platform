<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * OpenAiTravelPlannerService
 *
 * Pre-configured future service implementation for OpenAI API integration.
 * In Phase One, if OPENAI_API_KEY is not configured or empty, it automatically
 * falls back gracefully to MockAiTravelPlannerService to guarantee a 100% reliable demo.
 */
class OpenAiTravelPlannerService implements AiTravelPlannerInterface
{
    protected ?string $apiKey;
    protected string $model;
    protected MockAiTravelPlannerService $fallback;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key') ?: env('OPENAI_API_KEY');
        $this->model = config('services.openai.model', 'gpt-4o-mini');
        $this->fallback = new MockAiTravelPlannerService();
    }

    public function generateItinerary(array $preferences): array
    {
        if (empty($this->apiKey)) {
            Log::info('OpenAI API key not set. Using MockAiTravelPlannerService fallback.');
            return $this->fallback->generateItinerary($preferences);
        }

        try {
            $prompt = "You are a world-class luxury Saudi travel designer. Create a customized itinerary for " . json_encode($preferences);

            $response = Http::withToken($this->apiKey)
                ->timeout(15)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => $this->model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an elite Saudi travel concierge. Respond with structured travel insights.'],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                $content = $response->json('choices.0.message.content');
                return [
                    'status' => 'success',
                    'provider' => 'openai_live',
                    'content' => $content,
                    'preferences' => $preferences
                ];
            }
        } catch (\Throwable $e) {
            Log::error('OpenAI generation error: ' . $e->getMessage());
        }

        return $this->fallback->generateItinerary($preferences);
    }

    public function chatResponse(string $message, array $context = []): array
    {
        if (empty($this->apiKey)) {
            return $this->fallback->chatResponse($message, $context);
        }

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(12)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => $this->model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are the official AI concierge for SaudiWings luxury flight and tourism platform.'],
                        ['role' => 'user', 'content' => $message]
                    ],
                ]);

            if ($response->successful()) {
                return [
                    'reply' => $response->json('choices.0.message.content'),
                    'suggestions' => ['Explore Flights', 'Saudi Destinations', 'Visa Information']
                ];
            }
        } catch (\Throwable $e) {
            Log::error('OpenAI chat error: ' . $e->getMessage());
        }

        return $this->fallback->chatResponse($message, $context);
    }
}
