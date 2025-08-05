<?php

namespace App\Models;
class Job{

    public static function all() {
        return [
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
                'id'=> 3,
                'title'=> 'Manager',
                'salary'=> '60000'
            ]
        ];
    }


    public static function find($id):array {
        $job =  \Illuminate\Support\Arr::first(static::all(), fn($job) => $job['id'] == $id);

        if(!$job) {
            abort(404, 'Job not found');
        }

        return $job;
    }
}
?>