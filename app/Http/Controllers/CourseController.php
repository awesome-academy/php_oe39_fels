<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    protected $course;
    protected $lesson;

    public function __construct(Course $course, Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->course = $course;
    }

    public function show(Course $course)
    {
        $course = Course::with('lessons')->where('id', $course->id)->firstOrFail();
        
        return view('courses.detail', compact('course'));
    }

    public function enroll(Course $course)
    {
        $this->checkValidInModel($course->id)->attach(Auth::user()->id);

        return redirect()->route('course.detail', ['course' => $course]);
    }

    public function leave(Course $course)
    {
        $this->checkValidInModel($course->id)->detach(Auth::user()->id);

        return redirect()->back();
    }

    public function checkValidInModel($id)
    {
        $course = $this->course->findOrFail($id);

        return $course->users();
    }

    public function allWordCourse(Course $course)
    {
        $allWord = Word::with('course')->where('course_id', $course->id)->paginate(config('constant.pagination.words_per_page'));

        return view('user.word_by_course',[
            'words' => $allWord,
            'course' => $course,
        ]);
    }
}
