<?php

namespace App\Http\Controllers;

use App\Repositories\User\Course\CourseRepositoryInterface;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    protected $courseRepo;

    public function __construct(CourseRepositoryInterface $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }

    public function show(Course $course)
    {
        $course = $this->courseRepo->showCourse($course->id);

        return view('courses.detail', compact('course'));
    }

    public function enroll(Course $course)
    {
        $this->courseRepo->checkValidInModel($course->id)->attach(Auth::user()->id);

        return redirect()->route('course.detail', ['course' => $course]);
    }

    public function leave(Course $course)
    {
        $this->courseRepo->checkValidInModel($course->id)->detach(Auth::user()->id);

        return redirect()->back();
    }

    public function allWordCourse(Course $course)
    {
        $allWord = $this->courseRepo->allWordByCourse($course->id);

        return view('user.word_by_course',[
            'words' => $allWord,
            'course' => $course,
        ]);
    }
}
