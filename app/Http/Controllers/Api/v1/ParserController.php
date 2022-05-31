<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\XmlParseRequest;
use App\Http\Services\ParserService;
use App\Http\Services\ParserServiceNew;

class ParserController extends Controller
{
    public function parseXml(XmlParseRequest $request, ParserService $parserService){
        try{
            $json = $parserService->convertXmlToJson($request->url);
            return response()->json($json);
        } catch (\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function parseXml2(XmlParseRequest $request, ParserServiceNew $parserService)
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
