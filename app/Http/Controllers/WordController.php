<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $wordStatus = $user->words;
        $words = Word::get();
        $listCategorys = Course::get();
        return view('user.all_word_list')->with(compact('words', 'listCategorys', 'wordStatus'));
    }

    public function filter(Request $request)
    {
        $listCategorys = Course::get();

        $data = $request->all();

        if(empty($data['course_id'])){
            $data['course_id'] = 'all';
        }

        if (empty($data['value'])) {
            $data['value'] = 'all';
        }

        $course_selected = $data['course_id'];
        $valueChoose = $data['value'];

        $user = User::where('id',Auth::user()->id)->first();
        $wordStatus = $user->words;

        if( $data['course_id'] == 'all' ){
            $words = Word::get();
        }else{
            $words = Word::where('course_id', $data['course_id'])->get();
        }
        return view('user.listing')->with(compact('words', 'listCategorys', 'course_selected', 'wordStatus', 'valueChoose'));
    }

}
