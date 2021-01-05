<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Course;
use App\Models\User;
use App\Repositories\User\Course\CourseRepositoryInterface;
use App\Repositories\User\Profile\ProfileRepositoryInterface;
use App\Repositories\User\Word\WordRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WordController extends Controller
{
    protected $courseRepo;
    protected $userRepo;
    protected $wordRepo;

    public function __construct(
        CourseRepositoryInterface $courseRepo,
        ProfileRepositoryInterface $userRepo,
        WordRepositoryInterface $wordRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->userRepo = $userRepo;
        $this->wordRepo = $wordRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wordStatus = $this->userRepo->wordStatusUser();
        $words = $this->wordRepo->getAll();
        $listCategorys = $this->courseRepo->getAll();
        return view('user.all_word_list')->with(compact('words', 'listCategorys', 'wordStatus'));
    }

    public function filter(Request $request)
    {
        $listCategorys = $this->courseRepo->getAll();

        $data = $request->all();

        $course_selected = $data['course_id'];
        $valueChoose = $data['value'];

        $wordStatus = $this->userRepo->wordStatusUser();

        if( $data['course_id'] == 'all' ){
            $words = $this->wordRepo->getAll();
        }else{
            $words = $this->wordRepo->filterWordbyCourse($data['course_id']);
        }
        return view('user.listing')->with(compact('words', 'listCategorys', 'course_selected', 'wordStatus', 'valueChoose'));
    }

}
