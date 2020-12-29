<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        $answers = Answer::with('word')
            ->with('question')
            ->where('is_correct',1)
            ->get()
            ->where('question.lesson_id', $lesson->id);
            
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

        $lessons = Lesson::with([
            'questions',
            'questions.answers',
            'questions.answers.word',
        ])
        ->get()
        ->find($lesson->id);
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
        $user = Auth::user();
        $score = 0;
        foreach ($data as $questionID => $answerID) {
            $answer = Answer::find($answerID);
            if(!empty($answer)) {
                if($answer->is_correct == 1) {
                    $score++;
                    DB::table('users_word')->updateOrInsert(
                        [
                            'user_id' => $user->id,
                            'word_id' => $answer->word_id,
                        ],
                        [
                            'status' => 'learned',
                        ],
                    );
                }else{
                    DB::table('users_word')->insertOrIgnore(
                        [
                            'user_id' => $user->id,
                            'word_id' => $answer->word_id,
                            'status' => 'unlearned',
                        ],
                    );
                }
            }
        }
        $lesson->users()->attach(
            [
                'user_id' => $user->id,
            ],
            [
                'score' => $score,
                'status' => json_encode($data),
            ]
        );

        return redirect()->route('lesson.result.test',[
            'lesson' => $lesson,
        ]);
    }

    public function result(Lesson $lesson)
    {
        $user = Auth::user();
        $result = User::find($user->id)->lessons()->where('user_id', $user->id)
                ->where('lesson_id', $lesson->id)->first();
        $lessons = Lesson::with([
            'questions',
            'questions.answers',
            'questions.answers.word',
        ])
        ->get()
        ->find($lesson->id);
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
