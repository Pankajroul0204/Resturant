<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'event_name' => 'Birthday Party',
                'event_description' => 'A fun-filled birthday celebration.',
                'capacity' => 100,
                'is_displayed' => true,
                'active' => true,
            ],
            [
                'event_name' => 'Wedding Reception',
                'event_description' => 'A beautiful wedding reception.',
                'capacity' => 150,
                'is_displayed' => true,
                'active' => true,
            ],
            [
                'event_name' => 'Corporate Meeting',
                'event_description' => 'A gathering of professionals for a corporate meeting.',
                'capacity' => 500,
                'is_displayed' => true,
                'active' => true,
            ],
            [
                'event_name' => 'Private Party',
                'event_description' => 'An exclusive private party.',
                'capacity' => 50,
                'is_displayed' => false,
                'active' => true,
            ],
            [
                'event_name' => 'Anniversary Celebration',
                'event_description' => 'A special celebration for a couple\'s anniversary.',
                'capacity' => 50,
                'is_displayed' => false,
                'active' => true,
            ],
            [
                'event_name' => 'Others',
                'event_description' => 'Other types of events.',
                'capacity' => 50,
                'is_displayed' => false,
                'active' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
