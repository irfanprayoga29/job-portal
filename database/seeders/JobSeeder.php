<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Users;
use App\Models\Categories;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get company users (role_id = 2)
        $companies = Users::where('role_id', 2)->get();
        
        if ($companies->count() == 0) {
            $this->command->info('No company users found. Please run TestCompanySeeder first.');
            return;
        }

        // Create some categories if they don't exist
        $categories = [
            'Technology',
            'Marketing',
            'Finance',
            'Human Resources',
            'Design',
            'Sales'
        ];

        foreach ($categories as $categoryName) {
            Categories::firstOrCreate(['name' => $categoryName]);
        }

        $allCategories = Categories::all();

        // Sample jobs data
        $jobsData = [
            [
                'name' => 'Junior Frontend Developer',
                'location' => 'Jakarta, Indonesia',
                'salary' => 8000000,
                'description' => 'We are looking for a passionate Junior Frontend Developer to join our growing team. You will work on exciting projects and learn from experienced developers.',
                'requirements' => 'Bachelor degree in Computer Science or related field. Experience with HTML, CSS, JavaScript, and React.js. Fresh graduates are welcome.',
                'employment_type' => 'Full-time',
                'experience_level' => 'Entry Level'
            ],
            [
                'name' => 'Digital Marketing Specialist',
                'location' => 'Bandung, Indonesia',
                'salary' => 6500000,
                'description' => 'Join our marketing team to create and execute digital marketing campaigns that drive brand awareness and customer engagement.',
                'requirements' => 'Bachelor degree in Marketing or related field. Experience with social media marketing, Google Ads, and analytics tools.',
                'employment_type' => 'Full-time',
                'experience_level' => 'Mid Level'
            ],
            [
                'name' => 'Senior Backend Developer',
                'location' => 'Jakarta, Indonesia',
                'salary' => 15000000,
                'description' => 'Lead backend development projects and mentor junior developers. Work with cutting-edge technologies and scalable architectures.',
                'requirements' => 'Bachelor degree in Computer Science. 5+ years experience with PHP, Laravel, MySQL, and cloud platforms.',
                'employment_type' => 'Full-time',
                'experience_level' => 'Senior Level'
            ],
            [
                'name' => 'UX/UI Designer',
                'location' => 'Yogyakarta, Indonesia',
                'salary' => 7000000,
                'description' => 'Create beautiful and intuitive user experiences for our web and mobile applications. Collaborate with product and development teams.',
                'requirements' => 'Bachelor degree in Design or related field. Portfolio showcasing UX/UI design work. Proficiency in Figma, Adobe XD.',
                'employment_type' => 'Full-time',
                'experience_level' => 'Mid Level'
            ],
            [
                'name' => 'Financial Analyst',
                'location' => 'Surabaya, Indonesia',
                'salary' => 9000000,
                'description' => 'Analyze financial data and prepare reports to support business decision making. Work closely with finance and operations teams.',
                'requirements' => 'Bachelor degree in Finance, Accounting, or Economics. Strong analytical skills and proficiency in Excel.',
                'employment_type' => 'Full-time',
                'experience_level' => 'Mid Level'
            ],
            [
                'name' => 'Content Writer',
                'location' => 'Remote',
                'salary' => 5000000,
                'description' => 'Create engaging content for our blog, social media, and marketing materials. Help tell our brand story.',
                'requirements' => 'Bachelor degree in Communications, Journalism, or related field. Excellent writing skills in Indonesian and English.',
                'employment_type' => 'Remote',
                'experience_level' => 'Entry Level'
            ]
        ];

        foreach ($jobsData as $index => $jobData) {
            // Assign job to a random company
            $company = $companies->random();
            
            $job = Job::create(array_merge($jobData, [
                'user_id' => $company->id,
                'date_uploaded' => now()->subDays(rand(1, 30)),
                'status' => true
            ]));

            // Assign random categories to each job
            $randomCategories = $allCategories->random(rand(1, 3));
            $job->categories()->sync($randomCategories->pluck('id'));
        }

        $this->command->info('Job seeder completed. Created ' . count($jobsData) . ' jobs.');
    }
}
