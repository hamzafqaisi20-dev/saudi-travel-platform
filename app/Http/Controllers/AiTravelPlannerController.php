<?php

namespace App\Http\Controllers;

use App\Services\AiTravelPlannerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiTravelPlannerController extends Controller
{
    protected AiTravelPlannerInterface $aiService;

    public function __construct(AiTravelPlannerInterface $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Generate structured itinerary based on user preferences.
     */
    public function generateItinerary(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'destination' => 'nullable|string',
            'days' => 'nullable|integer|min:1|max:14',
            'style' => 'nullable|string',
            'locale' => 'nullable|string|in:ar,en',
            'budget' => 'nullable|string',
            'travelers' => 'nullable|string',
        ]);

        $result = $this->aiService->generateItinerary($validated);

        return response()->json($result);
    }

    /**
     * Conversational chat endpoint for real-time AI assistance.
     */
    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'locale' => 'nullable|string|in:ar,en',
            'context' => 'nullable|array',
        ]);

        $result = $this->aiService->chatResponse(
            $validated['message'],
            array_merge($validated['context'] ?? [], ['locale' => $validated['locale'] ?? 'ar'])
        );

        return response()->json($result);
    }
}
