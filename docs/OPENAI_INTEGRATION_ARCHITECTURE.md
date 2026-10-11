# SaudiWings - OpenAI Integration Architecture & Roadmap

## Overview
SaudiWings travel platform utilizes an enterprise-grade service abstraction layer in Laravel, ensuring clean separation between frontend Vue.js presentation and backend AI services.

In **Phase One (Visual & Prototyping Showcase)**, the platform operates using `MockAiTravelPlannerService`. This guarantees 100% reliable, zero-latency, realistic responses for destinations like AlUla, Riyadh, The Red Sea, and Jeddah in both Arabic and English, with no exposure of API keys or dependence on external network rate limits.

---

## Architecture Components

1. **Service Contract**: `app/Services/AiTravelPlannerInterface.php`
   - Defines standard methods: `generateItinerary(array $preferences)` and `chatResponse(string $message, array $context)`.

2. **Phase One Mock Service**: `app/Services/MockAiTravelPlannerService.php`
   - Delivers rich, realistic itinerary generation tailored to Saudi Vision 2030 destinations.
   - Provides context-aware conversational answers in Arabic (RTL) and English (LTR).

3. **Future Live Service**: `app/Services/OpenAiTravelPlannerService.php`
   - Connects to OpenAI's `/v1/chat/completions` API using Laravel's `Http` client.
   - Includes automatic graceful fallback to the mock service if the API key is absent or when network failures occur.

4. **Service Container Binding**: `app/Providers/AiServiceProvider.php`
   - Reads `AI_PLANNER_PROVIDER` from `.env`.
   - Binds `AiTravelPlannerInterface` to either `OpenAiTravelPlannerService` or `MockAiTravelPlannerService`.

5. **Secure Controller**: `app/Http/Controllers/AiTravelPlannerController.php`
   - Endpoints:
     - `POST /api/ai/itinerary`
     - `POST /api/ai/chat`
   - Validates input and sanitizes parameters.
   - **Crucial Rule**: API keys are NEVER sent to or stored in frontend Vue 3 components.

---

## How to Switch to Live OpenAI in Future Phases

1. Obtain an API key from [platform.openai.com](https://platform.openai.com/).
2. In your `.env` file, set:
   ```env
   AI_PLANNER_PROVIDER=openai
   OPENAI_API_KEY=sk-proj-YOUR_ACTUAL_KEY
   OPENAI_MODEL=gpt-4o-mini
   ```
3. Run `php artisan config:clear`.
4. The platform will automatically route requests through `OpenAiTravelPlannerService`.
