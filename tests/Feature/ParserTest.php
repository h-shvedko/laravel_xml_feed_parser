<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class ParserTest extends TestCase
{

    /**
     * @return void
     */
    public function test_parse_xml_from_external_url_fail(): void
    {
        $this->get(route('v2.api.parsexml'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @dataProvider provide_test_parse_xml_from_external_url_success
     *
     * @return void
     */
    public function test_parse_xml_from_external_url_success(string $url, array $expected): void
    {
        $this->get(
            route('v2.api.parsexml', ['url' => $url])
        )
            ->assertStatus(200)
            ->assertJson($expected);
    }

    public function provide_test_parse_xml_from_external_url_success()
    {

        return [
            [
                'https://appjobs-general.s3.eu-west-1.amazonaws.com/test-xml-feeds/feed_2.xml',
                [
                    'products' => [
                        'product' => [
                            'data_feed_id' => '41399',
                            'aw_deep_link' => 'https://www.awin1.com/pclick.php?p=30889002183&a=764485&m=18964',
                            'merchant_product_id' => 'drivers_nl_nl_amstelveen',
                            'search_price' => '0.01',
                            'aw_image_url' => 'https://images2.productserve.com/?w=200&h=200&bg=white&trim=5&t=letterbox&url=ssl%3Acrawl-it.ess.nl%2Ffeeds%2FTakeaway_FTP%2Flogo.jpg&feedId=41399&k=09d93586d17e19091ebf4e6d4f9e02881038d7ea',
                            'region' => 'Amstelveen',
                            'merchant_image_url' => 'https://crawl-it.ess.nl/feeds/Takeaway_FTP/logo.jpg',
                            'description' => 'Wil je betaald worden om in je stad rond te rijden? En ben je op zoek naar een stabiele baan als Bezorger met een vast uurloon en verzekering? Dan is het tijd om te solliciteren bij Thuisbezorgd.nl!  Onderweg Als onze Koerier bezorg je heerlijke gerechten in jouw stad - je haalt ze op bij het restaurant en brengt ze naar onze hongerige klanten. Wij bieden de mogelijkheid om parttime en in het weekend te werken en het is zo leuk en gemakkelijk als het klinkt!  Wij maken je het leven gemakkelijker, door:  - Je te voorzien van de benodigde uitrusting,  - Je te begeleiden met onze app terwijl jij door de stad rijdt,     Onze Fietskoerier:  - Is minimaal 16 jaar oud.  - Is super servicegericht en bezorgt met een glimlach.  - Beschikt over een smartphone (met 4G!) voor de navigatie.  - Houdt zich aan de verkeersregels.  - Is beschikbaar op één doordeweekse avond en één avond in het weekend.    Over het salaris als Bezorger bij Thuisbezorgd.nl:  - Een vast uurloon - van €13,34 bruto per uur, vanaf 21 jaar, inclusief vakantiegeld en vakantie-uren.  - Een orderbonus, per geaccepteerde order, als je werkt tussen 17 en 21 uur van tussen de 1 en 2 euro. Bezorg je tijdens deze uren bijv 8 orders kun je tussen de 8 en 16 euro extra verdienen, onafhankelijk van je leeftijd.   Overige voordelen als Bezorger bij Thuisbezorgd.nl: - Arbeidscontract en verzekering.  - Flexibiliteit en een stabiele planning: wij garanderen je tot 40 werkuren per week. Probeer een van onze vaste contracten met 16, 24, 32 en 40 gegarandeerde uren en diensten per week.  - Ondersteuning van het team wanneer je dit nodig hebt. De kans om buiten te werken en je stad op je duimpje te leren kennen     Start als Bezorger. Solliciteer nu!',
                            'merchant_name' => 'Takeaway Recruitment NL',
                            'category_name' => [
                            ],
                            'delivery_cost' => [
                            ],
                            'language' => 'nl',
                            'display_price' => 'EUR0.01',
                            'location' => 'NL',
                            'product_name' => 'Bezorger',
                            'merchant_id' => '18964',
                            'category_id' => '0',
                            'currency' => 'EUR',
                            'last_updated' => [
                            ],
                            'aw_product_id' => '30889002183',
                            'merchant_category' => [
                            ],
                            'store_price' => [
                            ],
                            'merchant_deep_link' => 'https://www.thuisbezorgd.nl/bezorger?city=Amstelveen',
                        ],
                    ],
                ],
            ],
            [
                'https://appjobs-general.s3.eu-west-1.amazonaws.com/test-xml-feeds/feed_4.xml',
                [
                    'jobs' => [
                        'job' => [
                            'referenceId' => '109147',
                            'title' => 'Amazon Delivery Driver',
                            'company' => 'Amazon Flex',
                            'description' => 'Amazon Flex is hiring now in Prescott, AZ. With Amazon Flex, you can earn money for delivering parcels with your own car, on your own schedule, any time you like – just select available hourly blocks, decide if the shift length and payment suit you, and if so, hit the road. <p> Amazon Flex drivers earn between $18 to $25 per hour depending on the location + tips. Since Amazon is an ecommerce giant, you’ll never run out of tasks to complete. <p> In order to start, you have to be at least 21 years of age, have a smartphone, own vehicle and drivers license. <p> Interested? Sign up and start working immediately!',
                            'city' => 'Prescott',
                            'state' => 'AZ',
                            'country' => 'United States',
                            'education' => 'any',
                            'experience' => 'any',
                            'jobType' => 'part-time, temporary',
                            'posterType' => 'recruiter',
                            'salary' => '75',
                            'postDate' => '2022-01-03T01:15:09-04:00',
                            'url' => 'https://www.appjobs.com/redirect/prescott-az/amazon-flex?referral_id=bf21a9e8fb2316&utm_source=MyJobHelper&utm_medium=cpc&utm_campaign=United_States_EN',
                            'categories' => 'delivery jobs',
                            'cpc' => '0.39',
                        ],
                    ],
                ],
            ],
        ];

    }

}
