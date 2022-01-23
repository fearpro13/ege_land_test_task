<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Setting;
use App\Models\Test;
use App\Models\User;
use Hamcrest\Core\Set;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class fill_up_fakes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fake_data {iterations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Наполнить проект данными для теста';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $iterations = $this->argument('iterations') ?? 5;

        DB::beginTransaction();
        try {
            $this->makeUsers($iterations);
            $this->makeQuestions($iterations);
            $this->makeTests($iterations);
            $this->makeCourses($iterations);
            $this->makeSettings($iterations);
            $this->makeQuestionTypes($iterations);
            $this->mixData($iterations);

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        echo "Успешно создано\n";

        return 0;
    }

    private function makeUsers(int $usersCount): void
    {
        for ($i = 0; $i <= $usersCount - 1; $i++) {
            $rand = bin2hex(random_bytes(4));
            $randPhone = rand(0, 999999999);
            $randVk = rand(100000000, 999999999);

            $user = new User();
            $user->name = "user#$rand";
            $user->last_name = "last_name#$rand";
            $user->email = "user_${rand}@domen.ru";
            $user->phone = "+7" . sprintf("%'.09d", $randPhone);;
            $user->vk_id = $randVk;

            $user->save();

            unset($user);
        }
    }

    private function makeQuestions($count): void
    {
        for ($i = 0; $i <= $count; $i++) {

            $rand = bin2hex(random_bytes(6));

            $question = new Question();

            $question->name = "Very interesting question #$rand";
            $question->save();

            unset($question);
        }

    }

    private function makeTests($count): void
    {
        for ($i = 0; $i <= $count; $i++) {
            $test = new Test();
            $rand = bin2hex(random_bytes(6));

            $test->name = "Examination test #$rand";
            $test->save();

            unset($test);
        }
    }

    private function makeCourses($count): void
    {


        for ($i = 0; $i <= $count; $i++) {
            $course = new Course();
            $rand = bin2hex(random_bytes(6));

            $randDice = floor(rand(1, 4));
            switch ($randDice) {
                case 1:
                    $course->name = " 1 YEAR course#$rand";
                    break;
                case 2:
                    $course->name = "3 Months course#$rand";
                    break;
                case 3:
                    $course->name = " 2 Weeks course#$rand";
                    break;
                default:
                    $course->name = " 1 Week course#$rand";
                    break;
            }


            $course->save();

            unset($course);
        }
    }

    private function makeSettings($count): void
    {
        for ($i = 0; $i <= $count; $i++) {
            $setting = new Setting();
            $rand = bin2hex(random_bytes(6));

            $setting->name = "Setting #$rand";
            $setting->save();

            unset($setting);
        }
    }

    private function makeQuestionTypes($count): void
    {
        for ($i = 0; $i <= $count; $i++) {
            $questionType = new QuestionType();
            $rand = bin2hex(random_bytes(6));

            $questionType->name = "Question type #$rand";
            $questionType->save();

            unset($questionType);
        }
    }

    private function mixData($count): void
    {
        $users = User::all();
        $settings = Setting::all();
        $courses = Course::all();
        $tests = Test::all();

        //fill up users_settings
        for ($i = 0; $i <= $count; $i++) {
            $user = $users->random();
            $setting = $settings->random();
            $course = $courses->random();
            $test = $tests->random();

            /**
             * @var User $user
             */
            $user->settings()->attach($setting);
            $user->tests()->attach($test);
            $user->courses()->attach($course);
        }

    }
}
