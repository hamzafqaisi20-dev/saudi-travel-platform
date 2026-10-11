<?php

namespace App\Services;

interface AiTravelPlannerInterface
{
    /**
     * Generate a personalized Saudi travel itinerary.
     *
     * @param array $preferences (destination, duration, budget, travelers, style, interests)
     * @return array
     */
    public function generateItinerary(array $preferences): array;

    /**
     * Chat response for conversational travel advice.
     *
     * @param string $message
     * @param array $context
     * @return array
     */
    public function chatResponse(string $message, array $context = []): array;
}
