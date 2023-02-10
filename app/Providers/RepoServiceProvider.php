<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repository\TeacherRepositoryInterface', 'App\Repository\TeacherRepository');
        $this->app->bind('App\Repository\StudentRepositoryInterface', 'App\Repository\StudentRepository');
        $this->app->bind('App\Repository\studentPromotionRepositoryInterface', 'App\Repository\studentPromotionRepository');
        $this->app->bind('App\Repository\StudentGraduateRepositoryInterface', 'App\Repository\StudentGraduateRepository');
        $this->app->bind('App\Repository\FeesRepositoryInterface', 'App\Repository\FeesRepository');
        $this->app->bind('App\Repository\FeesInvoicesRepositoryInterface', 'App\Repository\FeesInvoicesRepository');
        $this->app->bind('App\Repository\ReceiptStudentRepositoryInterface', 'App\Repository\ReceiptStudentRepository');
        $this->app->bind('App\Repository\processingFeeRepositoryInterface', 'App\Repository\processingFeeRepository');
        $this->app->bind('App\Repository\PayementRepositoryInterface', 'App\Repository\PayementRepository');
        $this->app->bind('App\Repository\AttendanceRepositoryInterface', 'App\Repository\AttendanceRepository');
        $this->app->bind('App\Repository\SubjectsRepositoryInterface', 'App\Repository\SubjectsRepository');
        $this->app->bind('App\Repository\QuizzRepositoryInterface', 'App\Repository\QuizzRepository');
        $this->app->bind('App\Repository\QuestionRepositoryInterface', 'App\Repository\QuestionRepository');
       
      
      
      
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
