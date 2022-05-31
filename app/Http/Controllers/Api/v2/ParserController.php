<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\XmlParseRequest;
use App\Http\Services\ParserServiceNew;
use Illuminate\Http\JsonResponse;

class ParserController extends Controller
{
    /**
     * Parse XML
     *
     * @param  mixed $request
     * @param  mixed $parserService
     * @return JsonResponse
     */
    public function parseXml(XmlParseRequest $request, ParserServiceNew $parserService): JsonResponse
    {
        try {
            $json = $parserService->convertXmlToJson($request->url);

            return response()->json($json);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
