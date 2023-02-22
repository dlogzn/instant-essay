<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use App\Models\EssayLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EssayLogController extends Controller
{
    public function index(): Response
    {
        $title = 'Essay Log';
        $activeNav = 'Essay Log';
        return response()->view('ControlPanel.essay_log', compact('title', 'activeNav'), Response::HTTP_OK);
    }

    public function fetchRecords(Request $request): JsonResponse
    {
        try {
            $essayLogs = EssayLog::with(['user'])->get();
            return response()->json(['payload' => $essayLogs], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
