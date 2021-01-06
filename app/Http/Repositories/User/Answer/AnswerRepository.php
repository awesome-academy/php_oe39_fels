<?php

namespace App\Repositories\User\Answer;
use App\Repositories\BaseRepository;
use App\Repositories\User\Answer\AnswerRepositoryInterface;
use App\Models\Answer;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface {

    public function getModel()
    {
        return \App\Models\Answer::class;
    }

    public function getCorrectAnswer($id)
    {
        $answers = Answer::with('word')
            ->with('question')
            ->where('is_correct', 1)
            ->get()
            ->where('question.lesson_id', $id);

        return $answers;
    }

    public function saveResult($lesson, $data)
    {
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
    }
}
