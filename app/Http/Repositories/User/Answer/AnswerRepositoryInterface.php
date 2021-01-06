<?php

namespace App\Repositories\User\Answer;

interface AnswerRepositoryInterface {
    public function getCorrectAnswer($id);
    public function saveResult($lesson, $data);
}
