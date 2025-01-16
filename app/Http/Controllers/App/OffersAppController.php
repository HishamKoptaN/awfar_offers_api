<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Traits\AppResponseTrait;
use App\Models\SubCategory;
use App\Models\Store;
use App\Models\Offer;

class OffersAppController extends Controller
{
    public function handleRequest(
        Request $request,
        $id = null,
    ) {
        switch ($request->method()) {
            case 'GET':
                return $this->get($id);
            case 'POST':
                return $this->sendMessage(
                    $request,
                    $id,
                );
            default:
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Invalid request method',
                    ],
                );
        }
    }
    public function get($cityId)
    {
        try {
            $offers = Offer::with(
                ['store', 'subCategory'],
            )
                ->byCityId($cityId)
                ->get()
                ->map->getOfferDetails();
            return successResponse(
                $offers,
            );
        } catch (\Exception $e) {
            return failureResponse(
                $e->getMessage(),
            );
        }
    }
    public function translateDescription($description, $targetLanguage)
    {
        $response = Http::post(
            'https://translation.googleapis.com/language/translate/v2',
            [
                'q' => $description,
                'target' => $targetLanguage,
                'key' => env('GOOGLE_TRANSLATE_API_KEY'),
            ],
        );
        $translation = $response->json()['data']['translations'][0]['translatedText'];
        return $translation;
    }
}
