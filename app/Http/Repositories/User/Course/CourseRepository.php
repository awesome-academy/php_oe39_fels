<?php

namespace App\Repositories\User\Course;

use App\Repositories\BaseRepository;
use App\Repositories\User\Course\CourseRepositoryInterface;
use App\Models\Course;
use App\Models\Word;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface {

    public function getModel()
    {
        return \App\Models\Course::class;
    }

    public function showCourse($id)
    {
        return Course::with('lessons')->where('id', $id)->firstOrFail();
    }

    public function checkValidInModel($id)
    {
        $course = Course::findOrFail($id);

        return $course->users();
    }

    public function allWordByCourse($id)
    {
        $allWord = Word::with('course')->where('course_id', $id)->paginate(config('constant.pagination.words_per_page'));
        return $allWord;
    }
}
