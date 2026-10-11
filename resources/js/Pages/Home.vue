<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import HeroSection from '@/Components/HeroSection.vue';
import PartnerBar from '@/Components/PartnerBar.vue';
import FlightSearchWidget from '@/Components/FlightSearchWidget.vue';
import PopularDestinations from '@/Components/PopularDestinations.vue';
import JourneySteps from '@/Components/JourneySteps.vue';
import WanderlustPromo from '@/Components/WanderlustPromo.vue';
import FeaturedFlightsSection from '@/Components/FeaturedFlightsSection.vue';
import SaudiExperiencesSection from '@/Components/SaudiExperiencesSection.vue';
import AiAssistantSection from '@/Components/AiAssistantSection.vue';
import PartnerEcosystemSection from '@/Components/PartnerEcosystemSection.vue';
import TrustValuesSection from '@/Components/TrustValuesSection.vue';
import { useLocale } from '@/composables/useLocale';

const { isAr } = useLocale();
</script>

<template>
    <AppLayout>
        <Head :title="isAr ? 'الرئيسية - InfoTravel' : 'Home - InfoTravel Smart Tech'" />

        <!-- Reference Inspired Cinematic Hero Section -->
        <HeroSection />

        <!-- Flight Search Widget Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 sm:mt-8 lg:mt-10 relative z-30">
            <FlightSearchWidget />
        </section>

        <!-- Brand and Social Bar (Matches Reference Row 2) -->
        <PartnerBar />

        <!-- Popular Destinations (Matches Reference Row 3) -->
        <PopularDestinations />

        <!-- Journey To The Skies Made Simple (Matches Reference Row 4) -->
        <JourneySteps />

        <!-- Wanderlust Promo Banner (Matches Reference Row 5) -->
        <WanderlustPromo />

        <!-- Featured Mock Flight Offers -->
        <FeaturedFlightsSection />

        <!-- Saudi Experiences & Entertainment -->
        <SaudiExperiencesSection />

        <!-- AI Travel Planner & Concierge Assistant -->
        <AiAssistantSection />

        <!-- Partner Ecosystem & Official Resources -->
        <PartnerEcosystemSection />

        <!-- Trust & Value Propositions -->
        <TrustValuesSection />
    </AppLayout>
</template>
