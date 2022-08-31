<?php
return [
    'status' =>[
        '1'=> 'Active',
        '2'=> 'DeActive'
    ],
    'membership_status' =>[
        '1'=> 'Pending',
        '2'=> 'Verified',
        '3'=>'Rejected'
    ],
    'setting_types'=>[
        '1'=>'Sentence',
        '2'=>'Paragraph',
        '3'=>'Image'
    ],
    'blog_types'=>[

        '1'=>'News',
        '2'=>'Notice',
        
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
        '2' =>'about_us',
        '3'=>'service',
        '4'=>'slider',
        '5' => 'team',
        '6' => 'blog',
        '7'=>'gallery',
        '8'=>'ndis_plan',
        '9' => 'testimonial',
        '10' => 'accomodation',
        '11'=>'add_section',
        '12'=>'placement'

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
