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
                    'highlight' => 'استمتع بأفخم المطاعم، وحي الطريف بالدرعية، ومركز الملك عبدالله المالي، وإطلالة حافة العالم.',
                    'days' => [
                        ['day' => 1, 'title' => 'أصالة الدرعية وتاريخ نجد', 'activities' => ['جولة حي الطريف المسجل في اليونسكو', 'تناول وجبة غداء نجدية في مطل البجيري الراقي', 'زيارة قصر المصمك وسوق الزل التراثي']],
                        ['day' => 2, 'title' => 'أفق العاصمة وناطحات السحاب', 'activities' => ['إطلالة بانورامية من جسر برج المملكة المعلق', 'تسوق في مركز الفيصلية وشارع التحلية', 'سهرة عشاء في منطقة المربع أو فيا رياض الفاخرة']],
                        ['day' => 3, 'title' => 'مغامرة حافة العالم ومركز الملك عبدالله المالي', 'activities' => ['رحلة سفاري صباحية إلى جبل فهرين (حافة العالم)', 'جولة في مركز الملك عبدالله المالي (KAFD) وأبراجه العصرية', 'أمسية راقية ومأكولات عالمية في مطل البجيري']]
                    ],
                    'estimatedCost' => '3,500 - 6,200',
                    'bestSeason' => 'نوفمبر - مارس',
                ],
                'en' => [
                    'title' => 'Riyadh: Pulse of the Metropolis & Historic Diriyah',
                    'highlight' => 'Experience luxury dining, KAFD architectural marvels, UNESCO At-Turaif, and Edge of the World.',
                    'days' => [
                        ['day' => 1, 'title' => 'Diriyah Heritage & Bujairi Terrace', 'activities' => ['Walk through the historic mud-brick UNESCO site of At-Turaif', 'Michelin-grade dining at Bujairi Terrace overlooking the ruins', 'Al Masmak Fortress & Souq Al-Zal authentic antiquities']],
                        ['day' => 2, 'title' => 'Skyline & Modern Cosmopolitan Life', 'activities' => ['Panoramic view from Kingdom Centre Sky Bridge', 'Luxury shopping along Tahlia Street and VIA Riyadh', 'Fine dining at contemporary Saudi fusion restaurants']],
                        ['day' => 3, 'title' => 'Edge of the World & KAFD Metropolis', 'activities' => ['Morning desert 4x4 expedition to the Edge of the World (Jebel Fihrayn)', 'Evening architecture & dining walk through King Abdullah Financial District (KAFD)', 'Cultural lounges and authentic hospitality at Bujairi Terrace']]
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
            ],
            'Makkah' => [
                'ar' => [
                    'title' => 'مكة المكرمة: رحلة العمرة والروحانية في رحاب الكعبة المشرفة',
                    'highlight' => 'أداء مناسك العمرة، الصلاة في المسجد الحرام، وزيارة جبل النور وغار حراء ومعرض عمارة الحرمين الشريفين.',
                    'days' => [
                        ['day' => 1, 'title' => 'مناسك العمرة والسكينة في الحرم', 'activities' => ['الإحرام والوصول إلى المسجد الحرام لأداء طواف وسعي العمرة', 'شرب ماء زمزم المبارك وصلاة النوافل في الحجر وصحن المطاف', 'الإقامة الفاخرة في أبراج البيت المطلة على الكعبة المشرفة']],
                        ['day' => 2, 'title' => 'جبل النور وغار حراء الثقافي', 'activities' => ['زيارة حي حراء الثقافي والمتحف التفاعلي للقرآن الكريم والوحي', 'جولة تعريفية حول جبل ثور والمشاعر المقدسة (منى ومزدلفة وعرفات)', 'عشاء فاخر في مطاعم أبراج وقف الملك عبدالعزيز']],
                        ['day' => 3, 'title' => 'تاريخ عمارة الحرمين والتنقل السلس', 'activities' => ['زيارة مجمع الملك عبدالعزيز لكسوة الكعبة المشرفة', 'استكشاف معرض عمارة الحرمين الشريفين والمخطوطات النادرة', 'الانتقال بقطار الحرمين السريع فائق السرعة إلى المدينة المنورة أو جدة']]
                    ],
                    'estimatedCost' => '1,800 - 4,500',
                    'bestSeason' => 'على مدار العام (تفضيل نوفمبر - فبراير)',
                ],
                'en' => [
                    'title' => 'Holy Makkah: Spiritual Umrah & Grand Mosque Journey',
                    'highlight' => 'Perform Umrah, pray before the Holy Kaaba, visit Jabal Al-Nour, Hira Cultural District, and Clock Tower.',
                    'days' => [
                        ['day' => 1, 'title' => 'Umrah Pilgrimage & The Holy Kaaba', 'activities' => ['Ihram entry and performing the blessed Tawaf & Sa\'i at the Grand Mosque', 'Supplication and drinking Zamzam water in the serene precincts', 'Check-in to luxury suite overlooking the Kaaba at Abraj Al-Bait']],
                        ['day' => 2, 'title' => 'Hira Cultural District & Revelation History', 'activities' => ['Visit Hira Cultural District and interactive Revelation Museum', 'Historical overview of Mount Thawr and sacred pilgrimage sites (Mina, Arafat)', 'Fine Arabic hospitality dining at the Clock Royal Towers']],
                        ['day' => 3, 'title' => 'Holy Mosques Architecture & High-Speed Rail', 'activities' => ['Guided tour of Kiswah Factory (Kaaba Cloth Embroidery Center)', 'Two Holy Mosques Architecture Exhibition & rare manuscripts', 'High-speed Haramain Express Rail journey onward to Madinah or Jeddah Airport']]
                    ],
                    'estimatedCost' => '1,800 - 4,500',
                    'bestSeason' => 'Year-round (Best Nov - Feb)',
                ]
            ],
            'Madinah' => [
                'ar' => [
                    'title' => 'المدينة المنورة: سكينة طيبة الطيبة ومسجد النبي ﷺ',
                    'highlight' => 'الصلاة في الروضة الشريفة، وزيارة مسجد قباء وجبل أحد وممشى قباء وبساتين نخيل العجوة المباركة.',
                    'days' => [
                        ['day' => 1, 'title' => 'سلام السكينة والصلاة في الروضة الشريفة', 'activities' => ['الوصول والصلاة في المسجد النبوي والسلام على رسول الله ﷺ وصاحبيه', 'الصلاة في الروضة المباركة (بتصريح رسمي ميسر عبر منصة نُسك)', 'استراحة هادئة في باحة الحرم والاستمتاع بالمظلات العملاقة']],
                        ['day' => 2, 'title' => 'مسجد قباء وممشى النخيل التاريخي', 'activities' => ['زيارة مسجد قباء (أول مسجد أُسس على التقوى) وصلاة ركعتين فيه', 'المشي في ممشى قباء الحضري وتذوق تمور العجوة والنعناع المديني', 'زيارة متحف دار المدينة للتراث المعماري والحضاري']],
                        ['day' => 3, 'title' => 'جبل أحد والأسواق التراثية', 'activities' => ['زيارة جبل أحد ومقبرة شهداء أحد وجبل الرماة واستحضار السيرة النبوية', 'تسوق تمور المدينة وأرقى الهدايا التذكارية من سوق التمور المركزي', 'أمسية هادئة في حدائق المدينة قبل المغادرة عبر قطار الحرمين']]
                    ],
                    'estimatedCost' => '1,600 - 3,900',
                    'bestSeason' => 'على مدار العام (تفضيل أكتوبر - أبريل)',
                ],
                'en' => [
                    'title' => 'Madinah Al-Munawwarah: Serenity of the Prophet’s City',
                    'highlight' => 'Pray in the Blessed Rawdah, visit Quba Mosque, Mount Uhud, and lush prophetic date groves.',
                    'days' => [
                        ['day' => 1, 'title' => 'Peace & Prayer in the Prophet’s Mosque', 'activities' => ['Arrival and prayer at the Prophet’s Mosque (Al-Masjid An-Nabawi)', 'Prayer in the Blessed Rawdah (reserved seamlessly via Nusuk portal)', 'Peaceful contemplation under the iconic giant automated umbrellas']],
                        ['day' => 2, 'title' => 'Quba Mosque & Historic Date Oases', 'activities' => ['Visit and prayer in historic Quba Mosque (the first mosque in Islam)', 'Scenic stroll along Quba Boulevard with Ajwa date & mint tasting', 'Dar Al-Madinah Heritage Museum showcasing urban prophetic history']],
                        ['day' => 3, 'title' => 'Mount Uhud & Cultural Souqs', 'activities' => ['Tour of Mount Uhud, Archers’ Hill, and Martyrs Memorial', 'Selection of premium Medina Ajwa dates and handmade local keepsakes', 'Relaxed evening tea before Haramain High-Speed Train departure']]
                    ],
                    'estimatedCost' => '1,600 - 3,900',
                    'bestSeason' => 'Year-round (Best Oct - Apr)',
                ]
            ],
            'Abha' => [
                'ar' => [
                    'title' => 'أبها وعسير: سحر الضباب والقمم الجبلية الخضراء',
                    'highlight' => 'استمتع بأجواء السحاب الباردة، وقرية رجال ألمع التراثية العالمية، وركوب التلفريك في السودة.',
                    'days' => [
                        ['day' => 1, 'title' => 'سحر الضباب في قمم السودة', 'activities' => ['جولة في منتزه السودة الوطني أعلى قمة جبلية في المملكة', 'تجربة التلفريك المعلق بين قمم السحاب والوديان السحيقة', 'عشاء عسيري تقليدي بطعم الحنيذ والمشغوثة الأصيلة']],
                        ['day' => 2, 'title' => 'قرية رجال ألمع التراثية العالمية', 'activities' => ['زيارة قصور رجال ألمع الحجرية الملونة المسجلة في اليونسكو', 'استكشاف فن القط العسيري النسائي التراثي المصنف عالمياً', 'احتساء الشاي بالحبق الجبلي في مطلات الجبل الأخضر']],
                        ['day' => 3, 'title' => 'شارع الفن وبحيرة سد أبها', 'activities' => ['نزهة صباحية حول بحيرة سد أبها والحدائق المعلقة', 'جولة تسوق وتصوير في شارع الفن ومقاهي المدينة العصرية', 'تسوق عسل السدر الطبيعي والتوابل الجنوبية من السوق الشعبي']]
                    ],
                    'estimatedCost' => '1,500 - 3,200',
                    'bestSeason' => 'مايو - سبتمبر (صيفاً معتدل ومنعش)',
                ],
                'en' => [
                    'title' => 'Abha & Asir: Capital of Mist & Highland Peaks',
                    'highlight' => 'Crisp mountain breezes, UNESCO Rijal Almaa stone village, Al Souda cable cars, and Asiri art.',
                    'days' => [
                        ['day' => 1, 'title' => 'Al Souda Mist & Cloudline Peaks', 'activities' => ['Explore Al Souda National Park, Saudi Arabia’s highest peak', 'Scenic cable car ride descending through green cliffs', 'Traditional Asiri feast featuring authentic smoked Haneeth']],
                        ['day' => 2, 'title' => 'Rijal Almaa UNESCO Heritage Village', 'activities' => ['Guided exploration of Rijal Almaa gingerbread-style stone towers', 'Discover UNESCO-recognized Al-Qatt Al-Asiri feminine wall art', 'Highland sunset tea overlooking misty Green Mountain']],
                        ['day' => 3, 'title' => 'Art Street & Abha Dam Oasis', 'activities' => ['Morning walk around tranquil Abha Dam reservoir gardens', 'Coffee and photography along the jacaranda-lined Art Street', 'Sourcing pure highland Sidr honey and mountain herbs from the souq']]
                    ],
                    'estimatedCost' => '1,500 - 3,200',
                    'bestSeason' => 'May - September (Pleasantly cool summer)',
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
                ? 'تم تصميم هذا المسار المقترح بواسطة مساعد السفر الذكي في InfoTravel لمساعدتك في تخطيط رحلتك بأعلى درجات الراحة والمرونة.'
                : 'This itinerary was curated by the InfoTravel AI Travel Planner to give you a seamless and memorable journey.',
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
            if (str_contains($normalized, 'umrah') || str_contains($normalized, 'makkah') || str_contains($normalized, 'mecca') || str_contains($normalized, 'madinah') || str_contains($normalized, 'medina') || str_contains($normalized, 'rawdah') || str_contains($normalized, 'nusuk')) {
                return [
                    'reply' => "Welcome to your spiritual pilgrimage journey! Official Umrah and Rawdah permits are booked easily via the official Nusuk portal (nusuk.sa). We help you find direct flights to Jeddah (JED) or Madinah (MED), luxury stays adjacent to the Holy Mosques, and high-speed Haramain Train tickets connecting Makkah and Madinah in two comfortable hours.",
                    'suggestions' => ['Plan 3-Day Umrah Itinerary', 'Madinah Rawdah Visit Guide', 'Haramain Train Booking Info', 'Open Official Nusuk Portal']
                ];
            }
            if (str_contains($normalized, 'flight') || str_contains($normalized, 'book') || str_contains($normalized, 'ticket')) {
                return [
                    'reply' => "I can help you find flights between key Saudi airports (Riyadh RUH, Jeddah JED, Madinah MED, Dammam DMM, AlUla ULH, and Red Sea RSI). You can also apply promo code SAUDI20 for 20% off sample fares. Where would you like to fly?",
                    'suggestions' => ['Flights to Riyadh (RUH)', 'Flights to Madinah (MED)', 'Flights to AlUla (ULH)', 'Red Sea Flights (RSI)']
                ];
            }
            if (str_contains($normalized, 'alula') || str_contains($normalized, 'hegra')) {
                return [
                    'reply' => "AlUla offers a blend of ancient Nabataean history, Hegra tombs, and desert luxury at Ashar Valley. Best visited between October and April. Would you like a 3-day itinerary or resort recommendations?",
                    'suggestions' => ['Generate 3-Day AlUla Itinerary', 'Show Luxury Resorts in AlUla', 'Find Flights to AlUla']
                ];
            }
            if (str_contains($normalized, 'abha') || str_contains($normalized, 'asir')) {
                return [
                    'reply' => "Abha and Asir offer cool mountain breezes, cable cars over mist-covered peaks in Al Souda, and the stone village of Rijal Almaa. It is the premier summer retreat in Saudi Arabia.",
                    'suggestions' => ['Generate 3-Day Abha Plan', 'Rijal Almaa Heritage Village', 'Flights to Abha (AHB)']
                ];
            }
            if (str_contains($normalized, 'visa') || str_contains($normalized, 'entry') || str_contains($normalized, 'passport')) {
                return [
                    'reply' => "Saudi Arabia offers an instant tourist eVisa for citizens of over 60 countries and GCC residents, valid for multiple entries across 12 months. Apply directly at visa.visitsaudi.com.",
                    'suggestions' => ['eVisa Requirements', 'Visit Saudi Official Portal', 'Book Connecting Flights']
                ];
            }
            return [
                'reply' => "Welcome to InfoTravel AI Concierge! I can craft personalized itineraries for holy journeys to Makkah and Madinah, desert escapes in AlUla, Red Sea island stays, and cosmopolitan Riyadh. How can I help you plan your trip today?",
                'suggestions' => ['Plan 3-Day Umrah in Makkah', 'Plan a 3-day trip to AlUla', 'Red Sea Island Resorts', 'Best destinations in Saudi']
            ];
        }

        // Arabic responses
        if (str_contains($normalized, 'عمرة') || str_contains($normalized, 'مكة') || str_contains($normalized, 'حرم') || str_contains($normalized, 'كعبة') || str_contains($normalized, 'نسك') || str_contains($normalized, 'نُسك') || str_contains($normalized, 'روضة') || str_contains($normalized, 'مدينة') || str_contains($normalized, 'قطار الحرمين')) {
            return [
                'reply' => "أهلاً بك في رحلتك الإيمانية المباركة! تصاريح العمرة وزيارة الروضة الشريفة تصدر رسمياً عبر منصة نُسك (Nusuk). نوفر لك أفضل خيارات الطيران إلى جدة أو المدينة، والفنادق المطلة على الحرمين، ورحلات قطار الحرمين السريع الرابط بين مكة والمدينة في ساعتين فقط. كيف تحب أن نرتب مسارك الإيماني؟",
                'suggestions' => ['إنشاء مسار العمرة في مكة (3 أيام)', 'مسار زيارة المدينة المنورة', 'حجز قطار الحرمين السريع', 'رابط منصة نُسك الرسمية']
            ];
        }
        if (str_contains($normalized, 'طيران') || str_contains($normalized, 'حجز') || str_contains($normalized, 'تذكرة') || str_contains($normalized, 'رحلات')) {
            return [
                'reply' => "يسعدني مساعدتك في استعراض خيارات الطيران بين مطارات المملكة (الرياض RUH، جدة ومكة JED، المدينة المنورة MED، الدمام DMM، العلا ULH، والبحر الأحمر RSI). كما يمكنك تطبيق كوبون الخصم SAUDI20 للاستفادة من خصم 20% على أسعار التذاكر. ما هي وجهتك وتاريخ سفرك؟",
                'suggestions' => ['رحلات إلى الرياض (RUH)', 'رحلات إلى المدينة (MED)', 'رحلات إلى العلا (ULH)', 'رحلات البحر الأحمر (RSI)']
            ];
        }
        if (str_contains($normalized, 'علا') || str_contains($normalized, 'العلا') || str_contains($normalized, 'مدائن')) {
            return [
                'reply' => "العلا تجمع بين عجائب مقابر الحجر النبطية، ومسرح مرايا العاكس، ومنتجعات وادي عشار الهادئة. أفضل فترات الزيارة بين أكتوبر وأبريل. هل تحب إعداد جدول سياحي لمدة 3 أيام؟",
                'suggestions' => ['إنشاء مسار 3 أيام في العلا', 'منتجعات وادي عشار الفاخرة', 'رحلات الطيران إلى العلا']
            ];
        }
        if (str_contains($normalized, 'أبها') || str_contains($normalized, 'ابها') || str_contains($normalized, 'عسير') || str_contains($normalized, 'سودة')) {
            return [
                'reply' => "أبها وعسير وجهتك الصيفية المنعشة في المملكة! تتميز بالضباب والطقس البارد، وتلفريك السودة، وقرية رجال ألمع التراثية العالمية. هل ترغب في تخطيط مسار جبلي؟",
                'suggestions' => ['إنشاء مسار أبها وعسير (3 أيام)', 'استكشاف قرية رجال ألمع', 'رحلات الطيران إلى أبها']
            ];
        }
        if (str_contains($normalized, 'فيزا') || str_contains($normalized, 'تأشيرة') || str_contains($normalized, 'دخول')) {
            return [
                'reply' => "تتيح المملكة التأشيرة السياحية الإلكترونية (eVisa) لمواطني أكثر من 60 دولة وحاملي إقامات دول الخليج وتأشيرات شنغن والولايات المتحدة والمملكة المتحدة، وتصدر فوراً عبر بوابة التأشيرات الرسمية (visa.visitsaudi.com).",
                'suggestions' => ['شروط التأشيرة الإلكترونية', 'بوابة روح السعودية الرسمية', 'استكشاف باقات السفر']
            ];
        }

        return [
            'reply' => "أهلاً بك في مساعد السفر الذكي لمنصة InfoTravel! أنا هنا لمساعدتك في التخطيط لرحلات العمرة والزيارة، واستكشاف العلا والبحر الأحمر وأبها والرياض، واقتراح أفضل مواعيد السفر وتذاكر الطيران. كيف تود أن نبدأ؟",
            'suggestions' => ['خطط لي رحلة عمرة في مكة', 'خطط لي رحلة 3 أيام في العلا', 'أفضل المنتجعات في البحر الأحمر', 'أبرز معالم الرياض التاريخية']
        ];
    }
}
