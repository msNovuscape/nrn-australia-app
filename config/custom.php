<?php
return [
    'status' =>[
        '1'=> 'Active',
        '2'=> 'DeActive'
    ],
    'membership_status' =>[
        '1'=> 'Pending',
        '2'=> 'Verified',
        '3'=>'Rejected',
        '4' => 'Reapply',
    ],
    'payment_status' =>[
        '1'=> 'Pending',
        '2'=> 'Verified',
        '3'=>'Rejected',
    ],
    'news_types' =>[
        '1'=> 'NRNA',
        '2'=> 'Third Party',
    ],
    'notice_types' =>[
        '1'=> 'NRNA',
        '2'=> 'Third Party',
    ],
    'project_types' =>[
        '1'=> 'NRNA',
        '2'=> 'Third Party',
    ],
    'featured_types'=>[
        '1' => 'Yes',
        '2' => 'No'
    ],
    'setting_types'=>[
        '1'=>'Sentence',
        '2'=>'Paragraph',
        '3'=>'Image'
    ],
    'gender' =>[
        '1'=> 'Male',
        '2'=> 'Female',
        '3' => 'Not mentioned'
    ],
    'states' =>[
        '1'=> 'Queensland',
        '2'=> 'South Australia',
        '3' => 'Tasmania',
        '4' => 'Victoria',
        '5' => 'Western Australia',
        '6' => 'Northern Territory',
        '7' => 'Australian Capital Territory',
        '8' => 'New South Wales'
    ],
    'countries' =>[
        '1'=> 'Australia',
        // '2'=> 'Female',
        // '3' => 'Not mentioned'
    ],
    'blog_types'=>[

        '1'=>'News',
        '2'=>'Notice',

    ],

    'regions'=>[

        '1'=>'Metro',
        '2'=>'Regional',

    ],

    'testimonial_types'=>[
        '1'=>'Service',
        '2'=>'Academy',
    ],
    'faqs_types' =>[
        '1' => 'Service',
        '2' => 'Academy'
    ],
    'image_folders'=>[
        '1' =>'setting',
        '2' =>'gallery',
        '3'=>'slider',
        '4' => 'team',
        '5' => 'blog',
        '6' => 'news',
        '7' => 'profile_image',
        '8' => 'identification_image',
        '9' => 'proof_of_residency_image',
        '10' => 'payment_slip',
        '11' => 'notice',
        '12' => 'project',
        '13' => 'document'
    ],
    'course_types'=>[
        '1' =>'Upcoming Courses',
        '2' =>'Recommended Courses',
//        '3'=>'Trending Courses',
    ],
    'query_types'=>[
        '1' =>'Contact Us',
        '2' =>'Quick In Query',
    ],
    'ndis_plan'=>[
        '1' =>'Self Managed',
        '2' =>'Agency Managed',
        '3' => 'Plan Managed'
    ],
    'contact_us_types'=>[
        '1' =>'Course',
        '2' =>'Service',
    ],
    'trending_courses'=>[
        '1' =>'Yes',
        '2' =>'No',
    ],
    'seo_types'=>[
        '1' =>'Project',
        '2' =>'Academy',
        '3'=>'Blog',
        '4'=>'Contact',
        '5' => 'Home',
        '6'=> 'About',
        '7' => 'Faq'
    ],
    'file_dir'=>'storage_new',
    'domain_suffix' =>'np',
    'per_page' =>10,
];
