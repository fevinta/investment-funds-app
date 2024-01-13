<?php

namespace App\Http\Controllers;

use App\Interfaces\FundRepositoryInterface;
use App\Models\Fund;
use Illuminate\Http\JsonResponse;

class FundDuplicatesController extends Controller
{
    public function __construct(
        private FundRepositoryInterface $fundRepository
    ) {
        //
    }

    public function index(Fund $fund): JsonResponse
    {
        $result = $this->fundRepository->getAllPossibleDuplicates($fund);

        return response()->json([
            'data' => $result
        ]);
    }
}
