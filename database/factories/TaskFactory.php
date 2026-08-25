<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tasks = [
            [
                'title' => 'Prepare the weekly team report',
                'description' => 'Collect the latest updates from the team and prepare a clear summary for the weekly meeting.',
            ],
            [
                'title' => 'Review the project requirements',
                'description' => 'Go through the project requirements and make sure all requested features are clearly documented.',
            ],
            [
                'title' => 'Update the company website',
                'description' => 'Review the website content and update outdated information across the main pages.',
            ],
            [
                'title' => 'Create the monthly marketing plan',
                'description' => 'Prepare the marketing activities and campaigns planned for the upcoming month.',
            ],
            [
                'title' => 'Prepare the sales presentation',
                'description' => 'Create a professional presentation containing the latest sales results, targets, and upcoming opportunities.',
            ],
            [
                'title' => 'Review the monthly expenses',
                'description' => 'Check the current expenses and compare them with the approved monthly budget.',
            ],
            [
                'title' => 'Schedule the team meeting',
                'description' => 'Choose a suitable time for the team meeting and send the meeting details to all participants.',
            ],
            [
                'title' => 'Organize project documentation',
                'description' => 'Review the existing project documents and organize them into clear and accessible sections.',
            ],
            [
                'title' => 'Research customer feedback',
                'description' => 'Review recent customer feedback and identify the most common issues and improvement opportunities.',
            ],
            [
                'title' => 'Prepare the quarterly review',
                'description' => 'Collect the required information and prepare the quarterly performance review.',
            ],
            [
                'title' => 'Update employee records',
                'description' => 'Review employee information and make sure the available records are complete and up to date.',
            ],
            [
                'title' => 'Plan the next product release',
                'description' => 'Define the main tasks, priorities, and deadlines required for the upcoming product release.',
            ],
            [
                'title' => 'Review customer support tickets',
                'description' => 'Check unresolved support tickets and identify the cases that require immediate attention.',
            ],
            [
                'title' => 'Prepare the project budget',
                'description' => 'Estimate the expected project costs and prepare a budget for the upcoming work.',
            ],
            [
                'title' => 'Analyze the latest sales data',
                'description' => 'Review recent sales data and identify important trends and changes in performance.',
            ],
            [
                'title' => 'Create the project timeline',
                'description' => 'Build a clear timeline for the project and define the major milestones.',
            ],
            [
                'title' => 'Review the design concepts',
                'description' => 'Review the proposed designs and provide feedback before the final implementation.',
            ],
            [
                'title' => 'Prepare onboarding materials',
                'description' => 'Create useful documentation and materials for new team members joining the organization.',
            ],
            [
                'title' => 'Test the new feature',
                'description' => 'Test the newly implemented feature and report any issues that need to be fixed.',
            ],
            [
                'title' => 'Update the project documentation',
                'description' => 'Document the latest project changes and make sure the instructions are accurate.',
            ],
            [
                'title' => 'Plan next week priorities',
                'description' => 'Review the current workload and define the most important tasks for next week.',
            ],
            [
                'title' => 'Review the annual goals',
                'description' => 'Evaluate the current progress toward the annual goals and identify areas that need improvement.',
            ],
            [
                'title' => 'Prepare a client presentation',
                'description' => 'Create a presentation summarizing the current project progress and the next planned steps.',
            ],
            [
                'title' => 'Organize the shared files',
                'description' => 'Review shared files and remove unnecessary duplicates while keeping important documents organized.',
            ],
            [
                'title' => 'Research new business opportunities',
                'description' => 'Research potential opportunities and prepare a short summary of the most promising options.',
            ],
            [
                'title' => 'Review the team performance',
                'description' => 'Review recent team performance and identify achievements, challenges, and improvement areas.',
            ],
            [
                'title' => 'Prepare the next sprint plan',
                'description' => 'Review unfinished work and prepare the tasks that should be included in the next sprint.',
            ],
            [
                'title' => 'Update the customer database',
                'description' => 'Review customer records and update missing or outdated information.',
            ],
            [
                'title' => 'Prepare the weekly meeting agenda',
                'description' => 'Create the agenda for the upcoming team meeting and include the main discussion points.',
            ],
            [
                'title' => 'Review pending invoices',
                'description' => 'Check pending invoices and identify payments that require follow-up.',
            ],
        ];

        $task = fake()->randomElement($tasks);

        return [
            'title' => $task['title'],
            'description' => $task['description'],

            'status' => fake()->randomElement([
                'pending',
                'in_progress',
                'completed',
            ]),

            'priority' => fake()->randomElement([
                'low',
                'medium',
                'high',
            ]),

            'user_id' => null,
            'category_id' => null,
            'image' => null,
        ];
    }
}
