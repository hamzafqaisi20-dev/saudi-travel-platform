export const destinations = [
    {
        id: 'makkah',
        code: 'QCA',
        title: { ar: 'مكة المكرمة — قِبلة المسلمين ومهوى الأفئدة', en: 'Makkah — The Holy City & Spiritual Sanctuary' },
        category: { ar: 'مقدسات وروحانيات', en: 'Sacred & Spiritual' },
        location: { ar: 'مكة المكرمة، الحجاز', en: 'Makkah Al-Mukarramah, Western Region' },
        rating: 4.99,
        reviewsCount: 8950,
        priceFrom: 450,
        image: '/images/destinations/makkah.jpg',
        badge: { ar: 'قِبلة المسلمين', en: 'Holiest Sanctuary' },
        description: {
            ar: 'أقدس بقاع الأرض، تحتضن المسجد الحرام والكعبة المشرفة ومشاعر الحج المقدسة ومعالم السيرة النبوية الشريفة وأبراج البيت.',
            en: 'The holiest sanctuary in Islam, home to the Sacred Mosque, the Kaaba, Abraj Al-Bait, and revered prophetic milestones.'
        },
        highlights: {
            ar: ['المسجد الحرام والكعبة المشرفة', 'برج الساعة ومتحف برج الساعة', 'جبل النور وغار حراء الثقافي', 'معرض عمارة الحرمين الشريفين'],
            en: ['The Grand Mosque & Holy Kaaba', 'Abraj Al-Bait Clock Tower', 'Jabal Al-Nour & Hira Cultural District', 'Two Holy Mosques Architecture Exhibition']
        }
    },
    {
        id: 'madinah',
        code: 'MED',
        title: { ar: 'المدينة المنورة — طيبة الطيبة ومدينة السلام', en: 'Madinah — The Radiant City of Peace' },
        category: { ar: 'مقدسات وروحانيات', en: 'Sacred & Spiritual' },
        location: { ar: 'المدينة المنورة، الحجاز', en: 'Madinah Al-Munawwarah, Western Region' },
        rating: 4.98,
        reviewsCount: 7620,
        priceFrom: 420,
        image: '/images/destinations/madinah.jpg',
        badge: { ar: 'طيبة الطيبة', en: 'City of the Prophet' },
        description: {
            ar: 'مدينة المصطفى ﷺ، مهد السكينة والطمأنينة، تحتضن المسجد النبوي الشريف والروضة المباركة ومسجد قباء وجبل أحد وبساتين النخيل.',
            en: 'The sanctuary of tranquility, home to the Prophet’s Mosque, the Blessed Rawdah, Quba Mosque, and peaceful date palm oases.'
        },
        highlights: {
            ar: ['المسجد النبوي الشريف والروضة المباركة', 'مسجد قباء أول مسجد في الإسلام', 'جبل أحد ومقبرة الشهداء', 'متحف دار المدينة وممشى قباء'],
            en: ['The Prophet’s Mosque & Blessed Rawdah', 'Quba Mosque', 'Mount Uhud & Martyrs Landmark', 'Dar Al-Madinah Heritage Museum']
        }
    },
    {
        id: 'alula',
        code: 'ULH',
        title: { ar: 'العلا — سحر التاريخ النبطي', en: 'AlUla — Living Museum of Antiquity' },
        category: { ar: 'تراث وفخامة', en: 'Heritage & Luxury' },
        location: { ar: 'العلا، المدينة المنورة', en: 'AlUla, Madinah Province' },
        rating: 4.9,
        reviewsCount: 1240,
        priceFrom: 1450,
        image: 'https://images.unsplash.com/photo-1682687220063-4742bd7fd538?auto=format&fit=crop&w=1200&q=80',
        badge: { ar: 'الأعلى طلباً', en: 'Most Popular' },
        description: {
            ar: 'استكشف موقع الحجر التراثي العالمي، ومسرح مرايا العاكس الأكبر في العالم، ومنتجعات وادي عشار الاستثنائية.',
            en: 'Explore Hegra UNESCO World Heritage site, Maraya the world’s largest mirrored building, and luxury oasis sanctuaries.'
        },
        highlights: {
            ar: ['مدائن صالح (الحجر)', 'مسرح مرايا', 'جبل الفيل', 'واحة النخيل القديمة'],
            en: ['Hegra Tombs', 'Maraya Concert Hall', 'Elephant Rock', 'Heritage Oasis Trail']
        }
    },
    {
        id: 'red-sea',
        code: 'RSI',
        title: { ar: 'وجهة البحر الأحمر — جزر المالديف السعودية', en: 'The Red Sea — Pristine Marine Paradise' },
        category: { ar: 'شواطئ وجزر فاخرة', en: 'Ultra-Luxury & Islands' },
        location: { ar: 'ساحل البحر الأحمر، تبوك', en: 'Red Sea Coast, Tabuk' },
        rating: 4.95,
        reviewsCount: 890,
        priceFrom: 2890,
        image: 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80',
        badge: { ar: 'فخامة بيئية', en: 'Regenerative Eco-Luxury' },
        description: {
            ar: 'أكثر من 90 جزيرة بكر، وأرقى المنتجعات العائمة في العالم مثل سانت ريجيس وريتز كارلتون ريزيرف نوجوما.',
            en: 'Over 90 untouched islands, fourth largest barrier reef, and bespoke overwater villas powered 100% by renewable energy.'
        },
        highlights: {
            ar: ['جزيرة أمهات', 'منتجع سانت ريجيس', 'غوص الشعاب المرجانية البكر', 'الطيران المائي'],
            en: ['Ummahat Islands', 'St. Regis Red Sea', 'Barrier Reef Diving', 'Seaplane Scenic Transfers']
        }
    },
    {
        id: 'riyadh',
        code: 'RUH',
        title: { ar: 'الرياض — عاصمة المستقبل وحي الطريف', en: 'Riyadh — Metropolis & Historic Diriyah' },
        category: { ar: 'عاصمة وترفيه وتاريخ', en: 'Capital & Cosmopolitan' },
        location: { ar: 'الرياض، نجد', en: 'Riyadh, Central Province' },
        rating: 4.88,
        reviewsCount: 3120,
        priceFrom: 650,
        image: 'https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?auto=format&fit=crop&w=1200&q=80',
        badge: { ar: 'قلب المملكة', en: 'Kingdom Capital' },
        description: {
            ar: 'عاصمة ناطحات السحاب المضيئة، ومطل البجيري الراقي، ومركز الملك عبدالله المالي، وعبق التراث في الدرعية التاريخية.',
            en: 'Futuristic architectural skyline, Bujairi Terrace fine dining overlooking UNESCO Diriyah, KAFD, and authentic Najdi heritage.'
        },
        highlights: {
            ar: ['حي الطريف بالدرعية', 'برج المملكة', 'مركز الملك عبدالله المالي (KAFD)', 'حافة العالم'],
            en: ['At-Turaif Diriyah', 'Kingdom SkyBridge', 'KAFD Financial District', 'Edge of the World']
        }
    },
    {
        id: 'jeddah',
        code: 'JED',
        title: { ar: 'جدة — عروس البحر الأحمر والبلد التاريخي', en: 'Jeddah — Historic Port & Red Sea Breeze' },
        category: { ar: 'تراث ساحلي وفنون', en: 'Coastal Heritage & Arts' },
        location: { ar: 'جدة، منطقة مكة المكرمة', en: 'Jeddah, Western Province' },
        rating: 4.79,
        reviewsCount: 2450,
        priceFrom: 580,
        image: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
        badge: { ar: 'عروس البحر', en: 'Bride of the Red Sea' },
        description: {
            ar: 'تأمل رواشين جدة التاريخية الأصيلة، واستمتع باليخوت الفاخرة على الكورنيش الشمالي وألذ المأكولات البحرية.',
            en: 'Centuries-old wooden Rawasheen windows in UNESCO Al Balad, modern yacht clubs, and vibrant waterfront nightlife.'
        },
        highlights: {
            ar: ['جدة البلد التاريخية', 'واجهة جدة البحرية', 'نافورة الملك فهد', 'نادي جدة لليخوت'],
            en: ['Historic Al Balad', 'Jeddah Waterfront', 'King Fahd Fountain', 'Yacht Club & Marina']
        }
    },
    {
        id: 'abha',
        code: 'AHB',
        title: { ar: 'أبها وعسير — سحر الضباب وقمم السحاب', en: 'Abha & Asir — Misty Peaks & Green Valleys' },
        category: { ar: 'طبيعة ومغامرات وجبال', en: 'Mountain & Nature Escapes' },
        location: { ar: 'عسير، جنوب المملكة', en: 'Asir, Southern Highlands' },
        rating: 4.82,
        reviewsCount: 970,
        priceFrom: 490,
        image: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80',
        badge: { ar: 'عاصمة الضباب', en: 'Fog & Mist Heights' },
        description: {
            ar: 'أجواء معتدلة باردة صيفاً، وقرية رجال ألمع التراثية الحائزة على جوائز اليونسكو، ومسارات التلفريك بين الجبال.',
            en: 'Refreshing cool mountain breezes, Rijal Almaa heritage stone village, and cable cars soaring above green canyons.'
        },
        highlights: {
            ar: ['قرية رجال ألمع', 'الجبل الأخضر', 'متنزه السودة الوطني', 'تلفريك عسير'],
            en: ['Rijal Almaa Village', 'Green Mountain', 'Al Souda Peaks', 'Highland Cable Cars']
        }
    }
];

export const flightOffers = [
    {
        id: 'FL-101',
        airline: { ar: 'الخطوط السعودية', en: 'Saudia' },
        airlineCode: 'SV',
        flightNumber: 'SV 1024',
        origin: { code: 'RUH', city: { ar: 'الرياض', en: 'Riyadh' }, airport: { ar: 'مطار الملك خالد الدولي', en: 'King Khalid Int. Airport' } },
        destination: { code: 'ULH', city: { ar: 'العلا', en: 'AlUla' }, airport: { ar: 'مطار العلا الدولي', en: 'AlUla Int. Airport' } },
        departureTime: '08:30',
        arrivalTime: '10:20',
        duration: '1h 50m',
        stops: { ar: 'مباشرة', en: 'Direct' },
        aircraft: 'Airbus A321neo',
        cabinClass: { ar: 'درجة الأعمال', en: 'Business Class' },
        priceSAR: 1280,
        tag: { ar: 'الأسرع والأفضل', en: 'Fastest Route' }
    },
    {
        id: 'FL-102',
        airline: { ar: 'طيران الرياض', en: 'Riyadh Air' },
        airlineCode: 'RX',
        flightNumber: 'RX 308',
        origin: { code: 'RUH', city: { ar: 'الرياض', en: 'Riyadh' }, airport: { ar: 'مطار الملك خالد الدولي', en: 'King Khalid Int. Airport' } },
        destination: { code: 'RSI', city: { ar: 'البحر الأحمر', en: 'The Red Sea' }, airport: { ar: 'مطار البحر الأحمر الدولي', en: 'Red Sea Int. Airport' } },
        departureTime: '11:15',
        arrivalTime: '13:00',
        duration: '1h 45m',
        stops: { ar: 'مباشرة', en: 'Direct' },
        aircraft: 'Boeing 787-9 Dreamliner',
        cabinClass: { ar: 'الدرجة الأولى الفاخرة', en: 'First Class Suite' },
        priceSAR: 2150,
        tag: { ar: 'تجربة ضيافة رقمية فاخرة', en: 'Ultra-Luxury Tech' }
    },
    {
        id: 'FL-103',
        airline: { ar: 'الخطوط السعودية', en: 'Saudia' },
        airlineCode: 'SV',
        flightNumber: 'SV 1088',
        origin: { code: 'JED', city: { ar: 'جدة', en: 'Jeddah' }, airport: { ar: 'مطار الملك عبدالعزيز الدولي', en: 'King Abdulaziz Int. Airport' } },
        destination: { code: 'RUH', city: { ar: 'الرياض', en: 'Riyadh' }, airport: { ar: 'مطار الملك خالد الدولي', en: 'King Khalid Int. Airport' } },
        departureTime: '15:40',
        arrivalTime: '17:15',
        duration: '1h 35m',
        stops: { ar: 'مباشرة', en: 'Direct' },
        aircraft: 'Boeing 777-300ER',
        cabinClass: { ar: 'الضيافة المميزة', en: 'Premium Guest Class' },
        priceSAR: 490,
        tag: { ar: 'العرض الأكثر توفيراً', en: 'Best Value' }
    },
    {
        id: 'FL-104',
        airline: { ar: 'طيران ناس', en: 'flynas' },
        airlineCode: 'XY',
        flightNumber: 'XY 244',
        origin: { code: 'DMM', city: { ar: 'الدمام', en: 'Dammam' }, airport: { ar: 'مطار الملك فهد الدولي', en: 'King Fahd Int. Airport' } },
        destination: { code: 'AHB', city: { ar: 'أبها', en: 'Abha' }, airport: { ar: 'مطار أبها الدولي', en: 'Abha Int. Airport' } },
        departureTime: '09:05',
        arrivalTime: '11:00',
        duration: '1h 55m',
        stops: { ar: 'مباشرة', en: 'Direct' },
        aircraft: 'Airbus A320neo',
        cabinClass: { ar: 'الدرجة الاقتصادية', en: 'Economy Class' },
        priceSAR: 380,
        tag: { ar: 'رحلة صباحية', en: 'Morning Flight' }
    },
    {
        id: 'FL-105',
        airline: { ar: 'الخطوط السعودية', en: 'Saudia' },
        airlineCode: 'SV',
        flightNumber: 'SV 1432',
        origin: { code: 'RUH', city: { ar: 'الرياض', en: 'Riyadh' }, airport: { ar: 'مطار الملك خالد الدولي', en: 'King Khalid Int. Airport' } },
        destination: { code: 'MED', city: { ar: 'المدينة المنورة', en: 'Madinah' }, airport: { ar: 'مطار الأمير محمد بن عبدالعزيز الدولي', en: 'Prince Mohammad Bin Abdulaziz Int. Airport' } },
        departureTime: '07:15',
        arrivalTime: '08:45',
        duration: '1h 30m',
        stops: { ar: 'مباشرة', en: 'Direct' },
        aircraft: 'Airbus A321neo',
        cabinClass: { ar: 'درجة الضيافة', en: 'Guest Class' },
        priceSAR: 360,
        tag: { ar: 'رحلات طيبة الطيبة', en: 'Pilgrim & Sacred Route' }
    },
    {
        id: 'FL-106',
        airline: { ar: 'طيران ناس', en: 'flynas' },
        airlineCode: 'XY',
        flightNumber: 'XY 512',
        origin: { code: 'RUH', city: { ar: 'الرياض', en: 'Riyadh' }, airport: { ar: 'مطار الملك خالد الدولي', en: 'King Khalid Int. Airport' } },
        destination: { code: 'JED', city: { ar: 'جدة / مكة المكرمة', en: 'Jeddah / Makkah' }, airport: { ar: 'مطار الملك عبدالعزيز الدولي', en: 'King Abdulaziz Int. Airport' } },
        departureTime: '13:20',
        arrivalTime: '15:05',
        duration: '1h 45m',
        stops: { ar: 'مباشرة', en: 'Direct' },
        aircraft: 'Airbus A320neo',
        cabinClass: { ar: 'الدرجة الاقتصادية المميزة', en: 'Premium Economy' },
        priceSAR: 320,
        tag: { ar: 'رحلات العمرة الميسرة', en: 'Umrah Gateway Route' }
    }
];

export const travelPartners = [
    {
        category: { ar: 'شركات الطيران الوطنية', en: 'National Flag Carriers' },
        items: [
            {
                name: { ar: 'الخطوط السعودية', en: 'Saudia' },
                badge: { ar: 'الناقل الوطني', en: 'Flag Carrier' },
                desc: { ar: 'الناقل الجوي الوطني للمملكة برحلات تغطي أكثر من 100 وجهة حول العالم.', en: 'Saudi Arabia national carrier connecting over 100 global destinations.' },
                url: 'https://www.saudia.com/',
                type: 'airline'
            },
            {
                name: { ar: 'طيران الرياض', en: 'Riyadh Air' },
                badge: { ar: 'الناقل الرقمي العالمي', en: 'Digital Carrier' },
                desc: { ar: 'الناقل الجوي الحديث الذي يعيد تعريف تجربة السفر الفاخرة بتقنيات الجيل القادم.', en: 'State-of-the-art carrier redefining digital and luxury flight experience.' },
                url: 'https://www.riyadhair.com/en/home',
                type: 'airline'
            }
        ]
    },
    {
        category: { ar: 'منصات حجز الطيران والفنادق', en: 'Flight & Hotel Booking Platforms' },
        items: [
            {
                name: { ar: 'المطار', en: 'Almatar' },
                badge: { ar: 'منصة سعودية رائدة', en: 'Leading Saudi Platform' },
                desc: { ar: 'تطبيق السفر وحجز الرحلات والإقامات المعتمد في المملكة.', en: 'Premier Saudi platform for seamless flight reservations and hotel bookings.' },
                url: 'https://almatar.com/en/',
                type: 'ota'
            }
        ]
    },
    {
        category: { ar: 'الهيئات والجهات السياحية الرسمية', en: 'Official Tourism & Visa Authorities' },
        items: [
            {
                name: { ar: 'روح السعودية (Visit Saudi)', en: 'Visit Saudi' },
                badge: { ar: 'البوابة السياحية الرسمية', en: 'Official Tourism Portal' },
                desc: { ar: 'الدليل الرسمي لاكتشاف الفعاليات والمزارات والوجهات السياحية الاستثنائية.', en: 'The official destination guide for discovering wonders across Saudi Arabia.' },
                url: 'https://www.visitsaudi.com/',
                type: 'government'
            },
            {
                name: { ar: 'وزارة السياحة', en: 'Ministry of Tourism' },
                badge: { ar: 'الجهة المنظمة', en: 'Regulatory Body' },
                desc: { ar: 'الجهة المسؤولة عن قيادة نمو القطاع السياحي ضمن مستهدفات رؤية 2030.', en: 'Spearheading national tourism strategy and sustainable industry growth.' },
                url: 'https://mt.gov.sa/',
                type: 'government'
            },
            {
                name: { ar: 'التأشيرة السياحية السعودية (eVisa)', en: 'Saudi Tourist eVisa' },
                badge: { ar: 'البوابة الرسمية للتأشيرات', en: 'Official eVisa Portal' },
                desc: { ar: 'إصدار التأشيرة الإلكترونية الفورية للسياح من أكثر من 60 دولة حول العالم.', en: 'Instant online tourist visa application portal for international travelers.' },
                url: 'https://visa.visitsaudi.com/',
                type: 'visa'
            }
        ]
    },
    {
        category: { ar: 'الترفيه والفعاليات والمواسم', en: 'Entertainment & Season Ticketing' },
        items: [
            {
                name: { ar: 'الهيئة العامة للترفيه (GEA)', en: 'General Entertainment Authority' },
                badge: { ar: 'منظم المواسم', en: 'Entertainment Regulator' },
                desc: { ar: 'الجهة المسؤولة عن تنظيم وتطوير قطاع الترفيه ومواسم السعودية الكبرى.', en: 'Leading world-class entertainment, cultural spectacles, and festivals.' },
                url: 'https://www.gea.gov.sa/',
                type: 'entertainment'
            },
            {
                name: { ar: 'ويبوك (Webook)', en: 'Webook' },
                badge: { ar: 'منصة التذاكر الرسمية', en: 'Official Mega-Events Ticketing' },
                desc: { ar: 'المنصة الرسمية لحجز تذاكر الفعاليات الترفيهية والرياضية الكبرى بالمملكة.', en: 'Official ticketing gateway for mega-events, sports bouts, and entertainment.' },
                url: 'https://webook.com/en',
                type: 'ticketing'
            }
        ]
    },
    {
        category: { ar: 'خدمات الحج والعمرة والنقل السريع', en: 'Hajj, Umrah & High-Speed Transit' },
        items: [
            {
                name: { ar: 'منصة نُسك (Nusuk)', en: 'Nusuk' },
                badge: { ar: 'البوابة الرسمية لضيوف الرحمن', en: 'Official Umrah & Pilgrimage Portal' },
                desc: { ar: 'المنصة الحكومية الموحدة لإصدار تصاريح العمرة وزيارة الروضة الشريفة وباقات الحرمين الشريفين.', en: 'Official unified Saudi platform for Umrah permits, Rawdah visits, and pilgrim services.' },
                url: 'https://www.nusuk.sa/',
                type: 'pilgrimage'
            },
            {
                name: { ar: 'قطار الحرمين السريع (HHR)', en: 'Haramain High-Speed Railway' },
                badge: { ar: 'الربط السككي فائق السرعة', en: 'High-Speed Rail 300 km/h' },
                desc: { ar: 'ربط مكة المكرمة بالمدينة المنورة ومطار الملك عبدالعزيز بجدة برحلات مريحة بسرعة 300 كم/س.', en: 'High-speed electric train connecting Makkah, Madinah, and Jeddah King Abdulaziz Airport.' },
                url: 'https://sar.com.sa/',
                type: 'transit'
            }
        ]
    }
];

export const experiences = [
    {
        id: 'umrah-trip',
        title: { ar: 'رحلة العمرة وزيارة المسجد الحرام', en: 'Spiritual Umrah & The Grand Mosque' },
        location: { ar: 'المسجد الحرام، مكة المكرمة', en: 'The Grand Mosque, Makkah' },
        image: '/images/destinations/umrah.jpg',
        tag: { ar: 'مناسك وروحانيات', en: 'Spiritual & Umrah' },
        date: { ar: 'متاح طوال العام', en: 'Year-Round Availability' },
        desc: {
            ar: 'تجربة إيمانية متكاملة لأداء مناسك العمرة في رحاب الكعبة المشرفة والمسجد الحرام، مع أرقى خدمات الضيافة والتنقل الميسر.',
            en: 'A deeply fulfilling spiritual journey to perform Umrah at the Holy Kaaba and Grand Mosque, featuring luxury hospitality and seamless arrangements.'
        },
        portal: {
            name: 'Nusuk',
            url: 'https://www.nusuk.sa/',
            notice: {
                ar: 'تصاريح العمرة وزيارة الحرم تصدر رسمياً عبر منصة نُسك (Nusuk) التابعة لوزارة الحج والعمرة. توفر أجنحة السعودية باقات الطيران والإقامة الفاخرة وقطار الحرمين.',
                en: 'Official Umrah permits are issued through the official Nusuk portal by the Ministry of Hajj & Umrah. SaudiWings provides flights, luxury stays, and Haramain Train transfers.'
            }
        }
    },
    {
        id: 'madinah-ziyarah',
        title: { ar: 'سكينة المدينة المنورة وزيارة مسجد النبي ﷺ', en: 'Peaceful Madinah & The Prophet’s Mosque' },
        location: { ar: 'المسجد النبوي، المدينة المنورة', en: 'The Prophet’s Mosque, Madinah' },
        image: '/images/destinations/madinah_ziyarah.jpg',
        tag: { ar: 'سكينة وتراث نبوي', en: 'Peace & Sacred Heritage' },
        date: { ar: 'متاح طوال العام', en: 'Year-Round Availability' },
        desc: {
            ar: 'الصلاة في الروضة الشريفة والسلام على رسول الله ﷺ، وزيارة مسجد قباء وجبل أحد وبساتين نخيل العجوة في أجواء ملؤها الطمأنينة.',
            en: 'Praying in the Blessed Rawdah, greeting the Prophet ﷺ, visiting Quba Mosque, Mount Uhud, and historical prophetic landmarks.'
        },
        portal: {
            name: 'Nusuk',
            url: 'https://www.nusuk.sa/',
            notice: {
                ar: 'تصاريح زيارة الروضة الشريفة تصدر رسمياً عبر منصة نُسك (Nusuk). توفر أجنحة السعودية باقات الفنادق المطلة على الحرم النبوي وقطار الحرمين.',
                en: 'Rawdah permits are booked via the Nusuk platform. SaudiWings provides luxury hotels overlooking the Prophet’s Mosque and high-speed rail transfers.'
            }
        }
    },
    {
        id: 'winter-tantora',
        title: { ar: 'شتاء طنطورة وسماء العلا', en: 'Winter at Tantora & AlUla Skies' },
        location: { ar: 'وادي عشار ومسرح مرايا، العلا', en: 'Ashar Valley & Maraya, AlUla' },
        image: 'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?auto=format&fit=crop&w=1200&q=80',
        tag: { ar: 'ثقافة وموسيقى وفنون', en: 'Arts & Music Festival' },
        date: { ar: 'ديسمبر — فبراير', en: 'December — February' },
        desc: {
            ar: 'أمسيات كلاسيكية عالمية داخل مسرح مرايا، ومهرجان المناطيد الساحر فوق جبال العلا الصخرية الخلابة.',
            en: 'Iconic musical recitals in Maraya mirror hall, stargazing retreats, and hot-air balloon festivals over sandstone canyons.'
        },
        portal: {
            name: 'Experience AlUla',
            url: 'https://www.experiencealula.com/',
            notice: {
                ar: 'تذاكر فعاليات العلا تحجز رسمياً عبر منصة اكتشف العلا الرسمية وموقع ويبوك. توفر أجنحة السعودية باقات الطيران والمنتجعات الفاخرة.',
                en: 'Official ticketing is managed via Experience AlUla and Webook. SaudiWings provides flight packages and luxury resort arrangements.'
            }
        }
    },
    {
        id: 'red-sea-diving',
        title: { ar: 'غوص الشعاب المرجانية البكر', en: 'Pristine Barrier Reef Diving' },
        location: { ar: 'جزر أمهات وشيبارة، البحر الأحمر', en: 'Ummahat & Sheybarah, The Red Sea' },
        image: 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80',
        tag: { ar: 'مغامرات بحرية فاخرة', en: 'Marine Eco-Adventures' },
        date: { ar: 'متاح طوال العام', en: 'Year-Round Availability' },
        desc: {
            ar: 'استكشاف أكثر من 300 نوع من الشعاب المرجانية الحية النادرة في مياه دافئة وشفافة بنقاء مذهل.',
            en: 'Guided expeditions through untouched underwater gardens teeming with rare corals, sea turtles, and pristine biodiversity.'
        },
        portal: {
            name: 'Red Sea Global',
            url: 'https://www.redseaglobal.com/',
            notice: {
                ar: 'حجوزات منتجعات البحر الأحمر البيئية ورحلات الطيران المائي تنظم رسمياً بالتنسيق مع البحر الأحمر الدولية.',
                en: 'Red Sea resort stays and seaplane transfers are coordinated directly with Red Sea Global partners.'
            }
        }
    }
];

export const sampleAirportCodes = [
    { code: 'RUH', city: { ar: 'الرياض', en: 'Riyadh' }, name: { ar: 'مطار الملك خالد الدولي', en: 'King Khalid Int. Airport' } },
    { code: 'JED', city: { ar: 'جدة / مكة المكرمة', en: 'Jeddah / Makkah Gateway' }, name: { ar: 'مطار الملك عبدالعزيز الدولي', en: 'King Abdulaziz Int. Airport' } },
    { code: 'MED', city: { ar: 'المدينة المنورة', en: 'Madinah' }, name: { ar: 'مطار الأمير محمد بن عبدالعزيز الدولي', en: 'Prince Mohammad Bin Abdulaziz Int. Airport' } },
    { code: 'ULH', city: { ar: 'العلا', en: 'AlUla' }, name: { ar: 'مطار العلا الدولي', en: 'AlUla Int. Airport' } },
    { code: 'RSI', city: { ar: 'البحر الأحمر', en: 'The Red Sea' }, name: { ar: 'مطار البحر الأحمر الدولي', en: 'Red Sea Int. Airport' } },
    { code: 'DMM', city: { ar: 'الدمام', en: 'Dammam' }, name: { ar: 'مطار الملك فهد الدولي', en: 'King Fahd Int. Airport' } },
    { code: 'AHB', city: { ar: 'أبها', en: 'Abha' }, name: { ar: 'مطار أبها الدولي', en: 'Abha Int. Airport' } },
    { code: 'DXB', city: { ar: 'دبي', en: 'Dubai' }, name: { ar: 'مطار دبي الدولي', en: 'Dubai Int. Airport' } },
    { code: 'LHR', city: { ar: 'لندن', en: 'London' }, name: { ar: 'مطار هيثرو لندن', en: 'London Heathrow Airport' } }
];
