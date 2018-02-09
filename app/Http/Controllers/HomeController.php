<?php

namespace App\Http\Controllers;

use App\Member;
use App\MemberAnswer;
use App\Services\MemberAnswerService;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var MemberAnswerService
     */
    protected $answerService;

    /**
     * HomeController constructor.
     * @param MemberAnswerService $answerService
     */
    public function __construct(MemberAnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    /**
     * @author Jerry
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $titles = Title::all();

        return view('home', compact('titles'));
    }

    /**
     * @author Jerry
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $id = $request->session()->getId();

        $member = Member::where('session_id', $id)->first();

        if (empty($member)) {
            $insert = [
                'session_id'    =>  $id,
            ];

            $member = Member::create($insert);
        }


        $data = $request->except('_token');

        return $this->answerService->insert($member->id, $data['answer'], $data['message']);

    }
}
