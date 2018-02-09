<?php
/**
 * Created by PhpStorm.
 * User: 87976
 * Date: 2018/2/8
 * Time: 16:20
 */

namespace App\Services;


use Illuminate\Support\Facades\DB;

/**
 * Class MemberAnswerService
 * @package App\Services
 */
class MemberAnswerService
{

    /**
     * @author Jerry
     * @param int $memberId
     * @param array $answer
     * @param array $message
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function insert(int $memberId, array $answer, array $message)
    {

        $answerInsert = [];

        foreach ($answer as $key => $value) {

            if (! isset($value['radio'])) {
                $errorData = array_merge($answer, $message);

                return redirect()->back()->withInput($errorData)->with('error', '请填好完整的调查数据，第' . $key . '题未选择');
            }

            $answerInsertData = [
                'title_id'  =>  $key,
                'answer_id' =>  $value['radio'],
                'text'  =>  empty($value['text']) ? '' : $value['text'],
                'type'  =>  1,
                'member_id' =>  $memberId,
            ];

            $answerInsert[] = $answerInsertData;
        }

        if (! empty($message)) {
            foreach ($message as $key => $value) {
                if (empty($value['textarea'])) {
                    $errorData = array_merge($answer, $message);

                    return redirect()->back()->withInput($errorData)->with('error', '请填好完整的调查数据，第' . $key . '题未选择');
                }
            }
        }

        $answerMessageInsert = [];
        if (! empty($message)) {
            foreach ($message as $key => $value) {

                $answerMessageInsertData = [
                    'title_id'  =>  $key,
                    'text'  =>  empty($value['textarea']) ? '' : $value['textarea'],
                    'type'  =>  2,
                    'member_id' =>  $memberId,
                ];

                $answerMessageInsert[] = $answerMessageInsertData;
            }

            DB::transaction(function () use ($answerMessageInsert, $answerInsert) {
                $this->insertOrUpdateAnswer($answerInsert);

                $this->insertOrUpdateMessage($answerMessageInsert);
            });
        }
        else{
            DB::transaction(function () use ($answerInsert) {
                $this->insertOrUpdateAnswer($answerInsert);
            });
        }

//        return redirect('/')->with('status', '保存成功，感谢您的支持');
        return view('success');
    }

    /**
     * @author Jerry
     * @param array $answers
     */
    protected function insertOrUpdateAnswer(array $answers)
    {
        foreach ($answers as $key => $value) {
            $data = $value;
            unset($value['answer_id']);
            unset($value['text']);

            $answer = DB::table('member_answer')->where($value)->first();

            if (empty($answer)) {
                DB::table('member_answer')->insert($data);
            }

            DB::table('member_answer')->where($value)->update($data);

        }
    }

    /**
     * @author Jerry
     * @param array $Messages
     */
    protected function insertOrUpdateMessage(array $Messages)
    {
        foreach ($Messages as $key => $value) {
            $data = $value;
            unset($value['text']);

            $answer = DB::table('member_answer')->where($value)->first();

            if (empty($answer)) {
                DB::table('member_answer')->insert($data);
            }

            DB::table('member_answer')->where($value)->update($data);

        }
    }
}