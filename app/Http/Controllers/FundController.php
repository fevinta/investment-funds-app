<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchFundsRequest;
use App\Http\Requests\UpdateFundRequest;
use App\Interfaces\FundRepositoryInterface;
use App\Models\Fund;
use Illuminate\Http\JsonResponse;

class FundController extends Controller
{
    public function __construct(private FundRepositoryInterface $fundRepository)
    {
        //
    }

    public function index(SearchFundsRequest $request): JsonResponse
    {
        $result = $this->fundRepository->search($request->validated());

        return response()->json($result);
    }

    public function update(UpdateFundRequest $request, Fund $fund)
    {
        $updated = $this->fundRepository->updateFund($fund, $request->validated());

        if (!$updated) {
            return response()->json(['message' => 'Error updating the Fund.'], 500);
        } else {
            return response()->json(['message' => 'Fund updated successfully.']);
        }
    }
}
