<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountPanel\EssayRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EssayController extends Controller
{
    public function __construct()
    {
        set_time_limit(300);
    }

    public function index(): Response
    {
        $title = 'Essay';
        $activeNav = 'Essay';
        return response()->view('AccountPanel.essay', compact('title', 'activeNav'), Response::HTTP_OK);
    }

    public function write(EssayRequest $request): JsonResponse
    {
        try {

            $prompt = 'Write an essay in English* in at least ' . $request->get('length') . ' words on the following topic.\n\n' . $request->get('topic') . '\n\nPlease make sure that the essay will be more elaborative, more descriptive and as longer as possible. Also remember that the essay must be written in with at least ' . $request->get('length') . ' words.\n\nFinally, do not forget to complete the essay.\n';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,'https://api.openai.com/v1/completions');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode([
                "model" => "text-davinci-003",
                "prompt" => $prompt,
                "temperature" => 0.7,
                "max_tokens" => 3000,
                "top_p" => 1,
                "frequency_penalty" => 0.3,
                "presence_penalty" => 0.0
            ]));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . env('OPENAI_BEARER_KEY')));
            $response = json_decode(curl_exec($ch), true);
            curl_close($ch);
            return response()->json(['payload' => ['response' => $response, 'prompt' => $prompt]], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
