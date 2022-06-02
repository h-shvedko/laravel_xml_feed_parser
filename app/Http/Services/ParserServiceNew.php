<?php

namespace App\Http\Services;

use App\Dto\XmlStateDto;
use XMLReader;

/**
 * ParserServiceNew
 */
class ParserServiceNew extends XMLReader
{
    /**
     * Constructor
     *
     * @param  XmlStateDto $xmlStateDto
     * @return void
     */
    public function __construct(private XmlStateDto $xmlStateDto)
    {
    }

    /**
     * Convert XML to JSON
     *
     * @param  string $url
     * @return array
     */
    public function convertXmlToJson(string $url): array
    {
        $this->open($url);

        $content = $this->readString();

        return $this->parseToJson($content);
    }

    /**
     * Parse XML to JSON
     *
     * @param  string $xmlString
     * @return array
     */
    private function parseToJson(string $xmlString): array
    {
        $xmlString = str_replace(['&lt;![CDATA[', ']]&gt;'], ['<![CDATA[', ']]>'], $xmlString);

        $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);

        return [
            $this->xmlStateDto->getInitialParentTag()['name'] => json_decode($json, true),
        ];
    }

    /**
     * readString
     *
     * @return string
     */
    public function readString(): string
    {
        $depth = 1;
        while ($this->read() && $depth != 0) {
            if ($this->nodeType == XMLReader::ELEMENT) {
                $initialParent = $this->xmlStateDto->getInitialParentTag();
                if (isset($initialParent['name']) && $initialParent['name'] == $this->name) {
                    return $initialParent['xml'];
                }
                $this->xmlStateDto->setInitialParentTag([
                    'name' => $this->name,
                    'xml' => $depth != 1 ? $this->readOuterXml(): ''
                ]);
                $depth++;
                $this->xmlStateDto->setLevel($depth);
            }

            if ($this->nodeType == XMLReader::END_ELEMENT) {
                $depth--;

                $this->xmlStateDto->setLevel($depth);
            }
        }

        return '';
    }

}
