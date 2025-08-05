<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('welcome');
});
Route::get('/jobs', function () {
    return view('jobs',[
        'jobs' => [
            [
                'id' => 1,
                'title' => 'Developer',
                'salary' => '50000'
            ],
            [
                'id' => 2,
                'title' => 'Designer',
                'salary' => '40000'
            ],
            [
                'id' => 3,
                'title'=> 'Manager',
                'salary' => '60000'
            ]
        ]

    ]);
});

Route::get('/jobs/{id}',function ($id){
    $jobs = [
        [
            'id' => 1,
            'title' => 'Developer',
            'salary' => '50000'
        ],
        [
            'id' => 2,
            'title' => 'Designer',
            'salary' => '40000'
        ],
        [
            'id' => 3,
            'title'=> 'Manager',
            'salary' => '60000'
        ]
    ];

    $job = \Illuminate\Support\Arr::first($jobs, fn($job) => $job['id'] == $id);

    return view('job', ['job' => $job]);

});

Route::get('/contact',function (){
    return view('contact');
});
