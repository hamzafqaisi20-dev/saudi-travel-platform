<?php

namespace App\Services;

class MockAiTravelPlannerService implements AiTravelPlannerInterface
{
    /**
     * Generate realistic travel itineraries tailored to Saudi destinations.
     */
    public function generateItinerary(array $preferences): array
    {
        $destination = $preferences['destination'] ?? 'AlUla';
        $days = (int) ($preferences['days'] ?? 3);
        $style = $preferences['style'] ?? 'Luxury & Culture';
        $locale = $preferences['locale'] ?? 'ar';

        $destinationsData = [
            'AlUla' => [
                'ar' => [
                    'title' => 'رحلة ساحرة في العلا: عاصمة الآثار والطبيعة',
                    'highlight' => 'اكتشف الحجر ومسرح مرايا وواحة العلا القديمة وجبل الفيل تحت سماء النجوم.',
                    'days' => [
                        ['day' => 1, 'title' => 'عجائب الحضارة النبطية', 'activities' => ['زيارة موقع الحجر التراثي العالمي (مدائن صالح)', 'جولة في بلدة العلا القديمة وسوق الحرفيين', 'عشاء فاخر في وادي عشار بمطعم صخيرات']],
                        ['day' => 2, 'title' => 'روائع العمارة ومسرح مرايا', 'activities' => ['تصوير مسرح مرايا التحفة المعمارية العاكسة', 'رحلة مسار الوادي بالدراجات أو الخيول العربية', 'جلسة شاي مسائية تحت جبل الفيل العملاق']],
                        ['day' => 3, 'title' => 'مغامرة واحة النخيل والاسترخاء', 'activities' => ['جولة استجمام في منتجعات بانيان تري أو هابيتاس', 'زيارة واحة النخيل وتذوق تمر البرني العريق', 'رصد النجوم في سماء الغراميل الخالية من التلوث الضوئي']],
                    ],
                    'estimatedCost' => '4,200 - 7,800',
                    'bestSeason' => 'أكتوبر - أبريل',
                ],
                'en' => [
                    'title' => 'Enchanting AlUla: The World’s Living Museum',
                    'highlight' => 'Uncover Hegra, Maraya Concert Hall, AlUla Old Town, and Elephant Rock under star-lit skies.',
                    'days' => [
                        ['day' => 1, 'title' => 'Nabataean Wonders at Hegra', 'activities' => ['Guided exploration of Hegra UNESCO World Heritage site', 'Stroll through AlUla Old Town & artisan craft market', 'Fine dining experience at Ashar Valley (Suhail Restaurant)']],
                        ['day' => 2, 'title' => 'Maraya & Desert Horizons', 'activities' => ['Architecture photo tour at Maraya Mirror Hall', 'Heritage Oasis trail walk and eco-cycling', 'Sunset tea gathering at the monumental Elephant Rock']],
                        ['day' => 3, 'title' => 'Oasis Wellness & Stargazing', 'activities' => ['Spa and wellness experience at Banyan Tree or Habitas', 'Date tasting & culinary workshop in the lush oasis', 'Dark-sky stargazing adventure in the mystic Gharameel']],
                    ],
                    'estimatedCost' => '4,200 - 7,800',
                    'bestSeason' => 'October - April',
                ]
            ],
            'Riyadh' => [
                'ar' => [
                    'title' => 'الرياض: نبض الحاضر وعراقة التاريخ في الدرعية',
                    'highlight' => 'استمتع بأفخم المطاعم، وفعاليات موسم الرياض، وحي الطريف بالدرعية، وإطلالة حافة العالم.',
                    'days' => [
                        ['day' => 1, 'title' => 'أصالة الدرعية وتاريخ نجد', 'activities' => ['جولة حي الطريف المسجل في اليونسكو', 'تناول وجبة غداء نجدية في مطل البجيري الراقي', 'زيارة قصر المصمك وسوق الزل التراثي']],
                        ['day' => 2, 'title' => 'أفق العاصمة وناطحات السحاب', 'activities' => ['إطلالة بانورامية من جسر برج المملكة المعلق', 'تسوق في مركز الفيصلية وشارع التحلية', 'سهرة عشاء في منطقة المربع أو فيا رياض الفاخرة']],
                        ['day' => 3, 'title' => 'مغامرة حافة العالم وموسم الرياض', 'activities' => ['رحلة سفاري صباحية إلى جبل فهرين (حافة العالم)', 'استكشاف بوليفارد سيتي وفعاليات الموسم العالمية', 'أمسية موسيقية ومأكولات عالمية']]
                    ],
                    'estimatedCost' => '3,500 - 6,200',
                    'bestSeason' => 'نوفمبر - مارس',
                ],
                'en' => [
                    'title' => 'Riyadh: Pulse of the Metropolis & Historic Diriyah',
                    'highlight' => 'Experience luxury dining, Riyadh Season attractions, UNESCO At-Turaif, and Edge of the World.',
                    'days' => [
                        ['day' => 1, 'title' => 'Diriyah Heritage & Bujairi Terrace', 'activities' => ['Walk through the historic mud-brick UNESCO site of At-Turaif', 'Michelin-grade dining at Bujairi Terrace overlooking the ruins', 'Al Masmak Fortress & Souq Al-Zal authentic antiquities']],
                        ['day' => 2, 'title' => 'Skyline & Modern Cosmopolitan Life', 'activities' => ['Panoramic view from Kingdom Centre Sky Bridge', 'Luxury shopping along Tahlia Street and VIA Riyadh', 'Fine dining at contemporary Saudi fusion restaurants']],
                        ['day' => 3, 'title' => 'Edge of the World & City Nightlife', 'activities' => ['Morning desert 4x4 expedition to the Edge of the World (Jebel Fihrayn)', 'Evening immersion at Boulevard City entertainment district', 'Live cultural shows and rooftop lounges']]
                    ],
                    'estimatedCost' => '3,500 - 6,200',
                    'bestSeason' => 'November - March',
                ]
            ],
            'RedSea' => [
                'ar' => [
                    'title' => 'وجهة البحر الأحمر: الفخامة الساحلية المستدامة',
                    'highlight' => 'جزر بكر، مياه فيروزية متلألئة، وأرقى المنتجعات العائمة في العالم.',
                    'days' => [
                        ['day' => 1, 'title' => 'الوصول إلى منتجع سانت ريجيس البحر الأحمر', 'activities' => ['رحلة طيران مائي من مطار البحر الأحمر الدولي', 'استرخاء في الفيلات العائمة فوق المياه الفيروزية', 'عشاء بحري طازج مع غروب الشمس الساحلي']],
                        ['day' => 2, 'title' => 'استكشاف الشعاب المرجانية البكر', 'activities' => ['غوص برفقة خبراء لمشاهدة رابع أكبر حيد مرجاني في العالم', 'رياضات بحرية بيئية (كاياك و paddle board)', 'جلسة سبا طبيعية مستوحاة من البحر']],
                        ['day' => 3, 'title' => 'رحلة جزيرة أمهات ومحميات الدلافين', 'activities' => ['رحلة يخت فاخر لرؤية الدلافين البرية والطيور المهاجرة', 'استكشاف مبادرات الاستدامة وزراعة المانغروف', 'عشاء شاطئي خاص على الرمال البيضاء الناعمة']]
                    ],
                    'estimatedCost' => '8,500 - 15,000',
                    'bestSeason' => 'على مدار العام',
                ],
                'en' => [
                    'title' => 'The Red Sea: Next-Gen Regenerative Luxury',
                    'highlight' => 'Untouched archipelagos, crystal turquoise waters, and world-class overwater villas.',
                    'days' => [
                        ['day' => 1, 'title' => 'Arrival & Overwater Sanctuary', 'activities' => ['Seaplane transfer via Red Sea International Airport', 'Check-in to overwater villa at St. Regis or Nujuma Ritz-Carlton Reserve', 'Sunset seafood culinary experience by the reef']],
                        ['day' => 2, 'title' => 'Pristine Barrier Reef Diving', 'activities' => ['Private scuba diving in the world’s fourth largest barrier reef system', 'Eco-friendly water sports: e-foiling & clear kayaking', 'Holistic marine mineral wellness and spa therapy']],
                        ['day' => 3, 'title' => 'Ummahat Islands & Marine Conservation', 'activities' => ['Luxury catamaran excursion to observe wild dolphin pods', 'Interactive mangrove reforestation and turtle conservation tour', 'Private starlit beach dining under Arabian skies']]
                    ],
                    'estimatedCost' => '8,500 - 15,000',
                    'bestSeason' => 'Year-round',
                ]
            ],
            'Jeddah' => [
                'ar' => [
                    'title' => 'جدة التاريخية والبحر: عروس البحر الأحمر',
                    'highlight' => 'بيوت البلد الرواشين الخشبية، الكورنيش الشمالي، ونوافير جدة الشهيرة.',
                    'days' => [
                        ['day' => 1, 'title' => 'سحر جدة التاريخية (البلد)', 'activities' => ['جولة بين البيوت الحجازية العتيقة ورواشين بيت نصيف', 'تذوق القهوة السعودية والحلويات الحجازية في المقاهي الفنية', 'تسوق البهارات والعطور الشرقية في سوق العلوي التراثي']],
                        ['day' => 2, 'title' => 'واجهة جدة البحرية واليخوت', 'activities' => ['نزهة صباحية على كورنيش جدة الواجهة البحرية', 'جولة بحرية خاصة باليخت وصيد الأسماك في مياه البحر الأحمر', 'عشاء في نادي جدة لليخوت ومارينا']],
                        ['day' => 3, 'title' => 'الفنون المعاصرة والتسوق العصري', 'activities' => ['زيارة حي جميل للفنون والمتاحف المعاصرة', 'مشاهدة نافورة الملك فهد الأعلى في العالم وقت المساء', 'عشاء حجازي بحري تقليدي بمطاعم السقالة']]
                    ],
                    'estimatedCost' => '2,800 - 5,400',
                    'bestSeason' => 'نوفمبر - أبريل',
                ],
                'en' => [
                    'title' => 'Jeddah Historic Charm & Waterfront Splendor',
                    'highlight' => 'Intricate Rawasheen architecture of Al Balad, vibrant Corniche, and the Red Sea breeze.',
                    'days' => [
                        ['day' => 1, 'title' => 'UNESCO Al Balad Historic Heritage', 'activities' => ['Guided walking tour through ancient coral-stone houses and Beit Nassif', 'Authentic Saudi specialty coffee tasting at local artisan cafes', 'Explore traditional spices and textiles in historic Souq Al-Alawi']],
                        ['day' => 2, 'title' => 'Jeddah Waterfront & Marine Delights', 'activities' => ['Morning cycling along the scenic North Corniche', 'Private yacht charter and snorkeling off the coast', 'Gourmet dinner at Jeddah Yacht Club & Marina']],
                        ['day' => 3, 'title' => 'Modern Arts & World’s Tallest Fountain', 'activities' => ['Contemporary art galleries visit at Hayy Jameel', 'Sunset viewing of the iconic King Fahd’s Fountain', 'Authentic Hijazi seafood banquet by the waves']]
                    ],
                    'estimatedCost' => '2,800 - 5,400',
                    'bestSeason' => 'November - April',
                ]
            ]
        ];

        $key = array_key_exists($destination, $destinationsData) ? $destination : 'AlUla';
        $localeKey = ($locale === 'en') ? 'en' : 'ar';
        $data = $destinationsData[$key][$localeKey];

        // Slice days according to user preference
        $daysList = array_slice($data['days'], 0, max(1, min($days, count($data['days']))));

        return [
            'status' => 'success',
            'provider' => 'mock_ai_engine',
            'destination' => $destination,
            'title' => $data['title'],
            'highlight' => $data['highlight'],
            'estimatedCost' => $data['estimatedCost'],
            'bestSeason' => $data['bestSeason'],
            'style' => $style,
            'itinerary' => $daysList,
            'note' => $localeKey === 'ar'
                ? 'تم إنشاء هذا المسار بواسطة محرك الذكاء الاصطناعي التجريبي لمنصة أجنحة السعودية. يمكنك تخصيص الأيام والأنشطة كما تحب.'
                : 'This itinerary was generated by SaudiWings AI Planning Engine prototype. Customize it freely to suit your travel style.',
        ];
    }

    /**
     * Context-aware conversational responses for the travel chatbot.
     */
    public function chatResponse(string $message, array $context = []): array
    {
        $locale = $context['locale'] ?? 'ar';
        $normalized = mb_strtolower(trim($message));

        if ($locale === 'en') {
            if (str_contains($normalized, 'flight') || str_contains($normalized, 'book') || str_contains($normalized, 'ticket')) {
                return [
                    'reply' => "I can help you explore premium flight options between key Saudi hubs (Riyadh RUH, Jeddah JED, Dammam DMM, AlUla ULH, and Red Sea RSI). We highlight routes operated by Saudia, Riyadh Air, and leading regional carriers. What is your preferred departure date?",
                    'suggestions' => ['Flights to Riyadh (RUH)', 'Flights to AlUla (ULH)', 'Red Sea Flights (RSI)', 'Check Mock Fares']
                ];
            }
            if (str_contains($normalized, 'alula') || str_contains($normalized, 'hegra')) {
                return [
                    'reply' => "AlUla is Saudi Arabia's premier heritage and luxury escape! Best visited from October to April. Highlights include Hegra's tombs, the mirror-clad Maraya concert hall, and Elephant Rock. Would you like a 3-day luxury itinerary?",
                    'suggestions' => ['Generate 3-Day AlUla Itinerary', 'Show Luxury Resorts in AlUla', 'Find Flights to AlUla']
                ];
            }
            if (str_contains($normalized, 'visa') || str_contains($normalized, 'entry') || str_contains($normalized, 'passport')) {
                return [
                    'reply' => "Saudi Arabia offers a streamlined tourist eVisa for citizens of over 60 countries and GCC residents, valid for 1 year with multiple entries. You can apply directly through the official portal at visa.visitsaudi.com.",
                    'suggestions' => ['eVisa Requirements', 'Visit Saudi Official Portal', 'Book Connecting Flights']
                ];
            }
            return [
                'reply' => "Welcome to SaudiWings AI Concierge! I can craft tailored luxury itineraries, suggest flights across Saudi Arabia, explain visa guidelines, and recommend seasonal events like Riyadh Season or Winter at Tantora. How can I assist your journey today?",
                'suggestions' => ['Plan a 3-day trip to AlUla', 'Best luxury destinations in Saudi', 'Flights from Dubai to Riyadh', 'Red Sea Island Resorts']
            ];
        }

        // Arabic responses
        if (str_contains($normalized, 'طيران') || str_contains($normalized, 'حجز') || str_contains($normalized, 'تذكرة') || str_contains($normalized, 'رحلات')) {
            return [
                'reply' => "يسعدني مساعدتك في استكشاف خيارات الطيران الفاخرة بين أهم مطارات المملكة (الرياض RUH، جدة JED، الدمام DMM، العلا ULH، والبحر الأحمر RSI) عبر الخطوط السعودية وطيران الرياض والناقلين الإقليميين. ما هي وجهتك وتاريخ سفرك المفضل؟",
                'suggestions' => ['رحلات إلى الرياض (RUH)', 'رحلات إلى العلا (ULH)', 'رحلات البحر الأحمر (RSI)', 'استعراض عروض الطيران النموذجية']
            ];
        }
        if (str_contains($normalized, 'علا') || str_contains($normalized, 'العلا') || str_contains($normalized, 'مدائن')) {
            return [
                'reply' => "العلا هي تحفة التاريخ والطبيعة في المملكة! أنسب وقت لزيارتها هو بين أكتوبر وأبريل. تشمل أبرز معالمها: الحجر (مدائن صالح)، مسرح مرايا العاكس، وجبل الفيل، مع أرقى المنتجعات العالمية مثل بانيان تري وهابيتاس. هل ترغب في إعداد برنامج سياحي لمدة 3 أيام؟",
                'suggestions' => ['إنشاء مسار 3 أيام في العلا', 'منتجعات وادي عشار الفاخرة', 'رحلات الطيران إلى العلا']
            ];
        }
        if (str_contains($normalized, 'فيزا') || str_contains($normalized, 'تأشيرة') || str_contains($normalized, 'دخول')) {
            return [
                'reply' => "تتيح المملكة العربية السعودية التأشيرة السياحية الإلكترونية (eVisa) لمواطني أكثر من 60 دولة وحاملي إقامات دول مجلس التعاون وتأشيرات شنغن والولايات المتحدة والمملكة المتحدة، وتصدر فورياً عبر البوابة الرسمية (visa.visitsaudi.com).",
                'suggestions' => ['شروط التأشيرة الإلكترونية', 'بوابة روح السعودية الرسمية', 'استكشاف باقات السفر']
            ];
        }

        return [
            'reply' => "أهلاً بك في المساعد الذكي لمنصة أجنحة السعودية! أنا هنا لمساعدتك في تخطيط مسار سفر استثنائي، واستكشاف أفضل الوجهات السعودية (العلا، الرياض، البحر الأحمر، جدة، أبها)، وتقديم إرشادات الطيران والتأشيرات. كيف تود أن نبدأ رحلتك؟",
            'suggestions' => ['خطط لي رحلة 3 أيام في العلا', 'أفضل المنتجعات في البحر الأحمر', 'أبرز فعاليات موسم الرياض', 'عروض الرحلات الداخلية']
        ];
    }
}
