<?php

namespace App\Repositories\User\Lesson;

use App\Repositories\BaseRepository;
use App\Repositories\User\Lesson\LessonRepositoryInterface;
use App\Models\Lesson;


class LessonRepository extends BaseRepository implements LessonRepositoryInterface {

    public function getModel()
    {
        return \App\Models\Lesson::class;
    }

    public function getTest($id)
    {
        $lessons = Lesson::with([
            'questions',
            'questions.answers',
            'questions.answers.word',
        ])
        ->get()
        ->find($id);

        return $lessons;
    }
}
