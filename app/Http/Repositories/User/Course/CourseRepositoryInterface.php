<?php

namespace App\Repositories\User\Course;

interface CourseRepositoryInterface {
    public function showCourse($id);
    public function checkValidInModel($id);
    public function allWordByCourse($id);
}
