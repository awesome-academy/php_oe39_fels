<?php

namespace App\Repositories\User\Word;
use App\Repositories\BaseRepository;
use App\Repositories\User\Word\WordRepositoryInterface;
use App\Models\Word;


class WordRepository extends BaseRepository implements WordRepositoryInterface {

    public function getModel()
    {
        return \App\Models\Word::class;
    }

    public function filterWordbyCourse($id)
    {
        return $this->model::where('course_id', $id)->get();
    }

}
