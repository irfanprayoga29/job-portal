<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixApplicationsTable extends Command
{
    protected $signature = 'fix:applications-table';
    protected $description = 'Add missing cover_letter column to applications table';

    public function handle()
    {
        $this->info('Checking applications table...');
        
        try {
            // Check if applications table exists
            if (!Schema::hasTable('applications')) {
                $this->error('Applications table does not exist!');
                return 1;
            }
            
            $this->info('Applications table found');
            
            // Check if cover_letter column exists
            if (Schema::hasColumn('applications', 'cover_letter')) {
                $this->info('cover_letter column already exists');
            } else {
                $this->info('Adding cover_letter column...');
                
                Schema::table('applications', function ($table) {
                    $table->text('cover_letter')->nullable();
                });
                
                $this->info('cover_letter column added successfully!');
            }
            
            // Update the model file to include cover_letter
            $modelPath = app_path('Models/Application.php');
            $content = file_get_contents($modelPath);
            
            if (!str_contains($content, "'cover_letter'")) {
                $content = str_replace(
                    "'resume_path'",
                    "'resume_path',\n        'cover_letter'",
                    $content
                );
                file_put_contents($modelPath, $content);
                $this->info('Application model updated to include cover_letter in fillable');
            } else {
                $this->info('Application model already includes cover_letter in fillable');
            }
            
            $this->info('Fix completed successfully!');
            return 0;
            
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }
}
