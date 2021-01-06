<?php

namespace App\Http\Controllers;

use App\Repositories\User\Lesson\LessonRepositoryInterface;
use App\Repositories\User\Answer\AnswerRepositoryInterface;
use App\Repositories\User\Profile\ProfileRepositoryInterface;
use App\Models\Answer;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    protected $lessonRepo;
    protected $answerRepo;
    protected $userRepo;

    public function __construct(
        LessonRepositoryInterface $lessonRepo,
        AnswerRepositoryInterface $answerRepo,
        ProfileRepositoryInterface $userRepo
    ) {
        $this->lessonRepo = $lessonRepo;
        $this->answerRepo = $answerRepo;
        $this->userRepo = $userRepo;
    }

    public function show(Lesson $lesson)
    {
        $answers = $this->answerRepo->getCorrectAnswer($lesson->id);

        return view('lessons.detail', [
            'answers' => $answers,
            'lesson' => $lesson,
        ]);
    }

    public function test(Lesson $lesson)
    {
        if($lesson->is_complete) {
            return redirect()->route('lesson.result.test', ['lesson' => $lesson]);
        }

        $lessons = $this->lessonRepo->getTest($lesson->id);
        $questions = $lessons->questions;

        return view('lessons.test', [
            'lesson' => $lesson,
            'lessons' => $lessons,
            'questions' => $questions,
        ]);
    }

    public function handleTest(Request $request, Lesson $lesson)
    {
        $data = $request->except([
            '_token',
        ]);
        $this->answerRepo->saveResult($lesson, $data);

        return redirect()->route('lesson.result.test',[
            'lesson' => $lesson,
        ]);
    }

    public function result(Lesson $lesson)
    {
        $result = $this->userRepo->resultExamUser($lesson->id);
        $lessons = $this->lessonRepo->getTest($lesson->id);
        $history = json_decode($result->pivot->status, true);

        return view('lessons.result',[
            'questions' => $lessons->questions,
            'lesson' => $lesson,
            'score' => $result->pivot->score,
            'history' => $history,
            'total' => count($history),
        ]);
    }
}
