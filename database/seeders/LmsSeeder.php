<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LmsSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Teachers (if not already seeded)
        $alice = User::firstOrCreate(
            ['email' => 'alice.teacher@example.com'],
            [
                'name'     => 'Alice Teacher',
                'password' => Hash::make('password123'),
                'role'     => 'teacher',
            ]
        );
        $bob = User::firstOrCreate(
            ['email' => 'bob.teacher@example.com'],
            [
                'name'     => 'Bob Teacher',
                'password' => Hash::make('secure456'),
                'role'     => 'teacher',
            ]
        );

        // 2. Create Students
        $sara = User::firstOrCreate(
            ['email' => 'sara.student@example.com'],
            [
                'name'     => 'Sara Student',
                'password' => Hash::make('studypass'),
                'role'     => 'student',
            ]
        );
        $mike = User::firstOrCreate(
            ['email' => 'mike.student@example.com'],
            [
                'name'     => 'Mike Student',
                'password' => Hash::make('mikepass'),
                'role'     => 'student',
            ]
        );

        // 3. Subjects by Alice
        $math = Subject::create([
            'user_id'     => $alice->id,
            'name'        => 'Calculus I',
            'description' => 'Intro to limits, derivatives, and integrals.',
            'code'        => 'MTH-CAL101',
            'credits'     => 5,
        ]);
        $phys = Subject::create([
            'user_id'     => $alice->id,
            'name'        => 'Physics I',
            'description' => 'Mechanics and thermodynamics.',
            'code'        => 'PHY-PHY101',
            'credits'     => 4,
        ]);

        // 4. Tasks for each subject
        $task1 = Task::create([
            'subject_id'  => $math->id,
            'name'        => 'Limits Worksheet',
            'description' => 'Solve limit problems in the PDF.',
            'points'      => 10,
        ]);
        $task2 = Task::create([
            'subject_id'  => $phys->id,
            'name'        => 'Kinematics Lab Report',
            'description' => 'Submit your lab observations.',
            'points'      => 15,
        ]);

        // 5. Enroll students
        $math->students()->syncWithoutDetaching([$sara->id, $mike->id]);
        $phys->students()->syncWithoutDetaching([$mike->id]); // only Mike

        // 6. Sample Solutions
        Solution::create([
            'task_id'       => $task1->id,
            'user_id'       => $sara->id,
            'content'       => 'My answers to limits problems...',
            'evaluated_at'  => Carbon::now()->subDay(),
            'points_earned' => 9,
        ]);
        Solution::create([
            'task_id'       => $task1->id,
            'user_id'       => $mike->id,
            'content'       => 'Here are my limit solutions.',
            'evaluated_at'  => null, // pending
            'points_earned' => null,
        ]);
        Solution::create([
            'task_id'       => $task2->id,
            'user_id'       => $mike->id,
            'content'       => 'Lab report content...',
            'evaluated_at'  => null,
            'points_earned' => null,
        ]);
    }
}
