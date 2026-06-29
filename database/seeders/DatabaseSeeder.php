<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Homework;
use App\Models\Notice;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $parent = User::updateOrCreate(
            ['email' => 'parent@example.com'],
            [
                'name' => 'Raj Sharma',
                'password' => Hash::make('password'),
                'role' => 'parent',
            ]
        );

        $aarav = Student::updateOrCreate(
            ['admission_number' => 'ADM001'],
            [
                'name' => 'Aarav Sharma',
                'class_name' => '5',
                'section_name' => 'A',
                'date_of_birth' => '2015-04-10',
            ]
        );

        $anaya = Student::updateOrCreate(
            ['admission_number' => 'ADM002'],
            [
                'name' => 'Anaya Sharma',
                'class_name' => '2',
                'section_name' => 'B',
                'date_of_birth' => '2018-08-15',
            ]
        );

        $parent->children()->syncWithoutDetaching([
            $aarav->id,
            $anaya->id,
        ]);

        Homework::updateOrCreate(
            [
                'student_id' => $aarav->id,
                'subject' => 'Maths',
                'title' => 'Worksheet Page 12',
            ],
            [
                'description' => 'Complete all questions from worksheet page 12.',
                'assigned_date' => now()->toDateString(),
                'due_date' => now()->addDay()->toDateString(),
            ]
        );

        Homework::updateOrCreate(
            [
                'student_id' => $aarav->id,
                'subject' => 'English',
                'title' => 'Read Chapter 3',
            ],
            [
                'description' => 'Read chapter 3 and write five difficult words.',
                'assigned_date' => now()->toDateString(),
                'due_date' => now()->addDays(2)->toDateString(),
            ]
        );

        Homework::updateOrCreate(
            [
                'student_id' => $anaya->id,
                'subject' => 'EVS',
                'title' => 'Draw five fruits',
            ],
            [
                'description' => 'Draw and color five fruits in the notebook.',
                'assigned_date' => now()->toDateString(),
                'due_date' => now()->addDay()->toDateString(),
            ]
        );

        for ($i = 0; $i < 20; $i++) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $aarav->id,
                    'attendance_date' => now()->subDays($i)->toDateString(),
                ],
                [
                    'status' => in_array($i, [3, 9]) ? 'absent' : 'present',
                ]
            );
        }

        for ($i = 0; $i < 20; $i++) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $anaya->id,
                    'attendance_date' => now()->subDays($i)->toDateString(),
                ],
                [
                    'status' => in_array($i, [5]) ? 'absent' : 'present',
                ]
            );
        }

        Notice::updateOrCreate(
            ['title' => 'Parent Teacher Meeting'],
            [
                'message' => 'Parent-teacher meeting will be held this Friday at 10 AM.',
                'published_date' => now()->toDateString(),
                'is_active' => true,
            ]
        );

        Notice::updateOrCreate(
            ['title' => 'School Holiday'],
            [
                'message' => 'School will remain closed on Monday due to maintenance work.',
                'published_date' => now()->toDateString(),
                'is_active' => true,
            ]
        );

        Notice::updateOrCreate(
            ['title' => 'Annual Day Practice'],
            [
                'message' => 'Annual day practice will start from next week.',
                'published_date' => now()->toDateString(),
                'is_active' => true,
            ]
        );
    }
}