<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\XmlParseRequest;
use App\Http\Services\ParserService;
use Illuminate\Http\Request;

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
}
