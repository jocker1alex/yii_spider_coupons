<?php

namespace app\commands;

use yii\console\Controller;
use DiDom\Document;
use app\models\Market;
use app\models\Coupon;

/**
 * This command - spider to collect coupons of markets from website.
 */
class SpiderController extends Controller
{
    const HOST = 'https://www.coupons.com';
    const URI  = '/store-loyalty-card-coupons/';
    const EXIST = 'exist = 1';
    const NOT_EXIST = 'exist = 0';
    const SCANED = 'scan = 1';
    const NOT_SCANED = 'scan = 0';
    const MARKET_SELECTOR = 'a.store-pod';
    const COUPON_SELECTOR = 'div.mod-gallery script';

    /**
     * This command - find markets from website and save to database
     */
    public function actionGetMarkets()
    {   
        Market::updateAll(['exist' => 0], self::EXIST);
       
        $url = self::HOST . self::URI;
        $document = new Document($url, true);
        $elements = $document->find(self::MARKET_SELECTOR);
        foreach ($elements as $element)
        {
            $this->addMarket($element);
        }

        Market::deleteAll(self::NOT_EXIST);
    }

    /**
     * This command - add market from website to database.
     * @param object $element element of HTML.
     */
    protected function addMarket($element)
    {
        // check the presence of market in the database
        $market = Market::findOne(['title' => $element->getAttribute('title')]);

        if($market === null)
        {
            $market = new Market();
            $market->url   = self::HOST . $element->getAttribute('href');
            $market->scan  = 0;
            $market->title = $element->getAttribute('title');
        }

        $market->exist = 1;

        $market->save();
    }

    /**
     * This command - find coupons from website and save to database.
     */
    public function actionGetCoupons()
    {   
        $this->actionGetMarkets();

        $markets = Market::findAll(['scan' => 0]);
        foreach ($markets as $market) 
        {
            Coupon::updateAll(['exist' => 0], 'id_market = ' . $market->id);
            
            $document = new Document($market->url, true);
            $textJsData = $this->findSelectorText($document, self::COUPON_SELECTOR);
            if(!is_null($textJsData))
            {
                $elements = $this->getJsonData($textJsData);
                foreach($elements as $element) 
                {
                    $this->addCoupon($market, $element);
                }
            }

            $market->scan = 1;

            $market->save();
        }

        Coupon::deleteAll(self::NOT_EXIST);

        Market::updateAll(['scan' => 0]);
    }

    /**
     * This command - find HTML tag by selector and get text.
     * @param object $element element of HTML.
     * @param string $selector HTML selector.
     * @return null|string
     */
    protected function findSelectorText($element, $selector)
    {
        return empty($element->find($selector)) ? null : $element->find($selector)[0]->text();
    }

    /**
     * This command - javascript code => json data  => array.
     * @param string $textJsData - javascript code.
     * @return array from json data.
     */
    protected function getJsonData($textJsData)
    {
        $start    = mb_strpos($textJsData, '[');
        $length   = mb_strrpos($textJsData, ']') - $start + 1;
        $jsonData = mb_substr($textJsData, $start, $length);
        return json_decode($jsonData, true);
    }

    /**
     * This command - get json element.
     * @param array $element array of json data.
     * @param string $key key of array
     * @return string value of array by key
     */
    protected function getJsonElement($element, $key)
    {
        return array_key_exists($key, $element) ? $element[$key] : '';
    }

    /**
     * This command - add coupon to database from website.
     * @param array $element coupon from JSON data.
     * @param object $market market from database.
     */
    protected function addCoupon($market, $element)
    {   
        $brand       = $this->getJsonElement($element, 'brandName');
        $expiry      = $this->getJsonElement($element, 'offerExpiryDateFormatted');
        $summary     = $this->getJsonElement($element, 'offerSummary');
        $picture     = $this->getJsonElement($element, 'largeImage');
        $description = $this->getJsonElement($element, 'offerDescription');

        // check the presence of coupon in the database
        $coupon = Coupon::findOne([
            'brand'       => $brand,
            'expiry'      => $expiry,
            'summary'     => $summary,
            'picture'     => $picture,
            'id_market'   => $market->id,
            'description' => $description,
        ]);

        if($coupon === null)
        {
            $coupon = new Coupon();
            $coupon->brand       = $brand;
            $coupon->expiry      = $expiry;
            $coupon->summary     = $summary;
            $coupon->picture     = $picture;
            $coupon->id_market   = $market->id;
            $coupon->description = $description;
        }
       
        $coupon->exist = 1;
        
        $coupon->save();
    }
}
