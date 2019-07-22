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
    const PROTO = 'https://';
    const HOST = 'www.coupons.com';
    const URI = '/store-loyalty-card-coupons/';

    /**
     * This command - find markets from website and save to database
     */
    public function actionGet_markets()
    {   
        // mark markets as non-existing
        Market::updateAll(['exist' => 0], 'exist = 1');
       
        $url = self::PROTO . self::HOST . self::URI;
 
        $document = new Document($url, true);

        // find nodes containing markets by selector
        $elements = $document->find('a.store-pod');
 
        foreach ($elements as $element)
        {
            $this->addMarket($element);
        }

        // remove from database non-existing markets on the site
        Market::deleteAll('exist = 0');
    }

    /**
     * This command - add market from website to database.
     * @param object $element element of HTML.
     */
    protected function addMarket($element)
    {
        //check the presence of market in the database
        $market = Market::findOne(['title' => $element->getAttribute('title')]);

        // add market to database
        if($market === null)
        {
            $market = new Market();
            
            $market->title = $element->getAttribute('title');

            $market->url = self::PROTO . self::HOST . $element->getAttribute('href');

            $market->scan = 0;
        }

        // mark market as existing
        $market->exist = 1;

        $market->save();
    }

    /**
     * This command - find coupons from website and save to database.
     */
    public function actionGet_coupons()
    {   
        $this->actionGet_markets();

        // get all non-scanning markets
        $markets = Market::findAll(['scan' => 0]);

        foreach ($markets as $market) 
        {
            // mark coupons from $market as non-existing
            Coupon::updateAll(['exist' => 0], 'exist = 1 AND id_market = ' . $market->id);
            
            // get DOM from website
            $document = new Document($market->url, true);

            // find javascript code containing coupons
            $textJsData = $this->findSelectorText($document, 'div.mod-gallery script');

            if(!is_null($textJsData))
            {
                // create object from json data
                $elements = $this->getJsonData($textJsData);

                foreach($elements as $element) 
                {
                    $this->addCoupon($market, $element);
                }
            }
              
            // mark market as scaned
            $market->scan = 1;

            $market->save();
        }

        // remove from database non-existing coupons on the site
        Coupon::deleteAll('exist = 0');

        // end: mark all markets as not scaned
        Market::updateAll(['scan' => 0], 'scan = 1');
    }

    /**
     * This command - find HTML tag by selector and get text.
     * @param object $element element of HTML.
     * @param string $selector HTML selector.
     */
     protected function findSelectorText($element, $selector)
    {
        return empty($element->find($selector)) ? NULL : $element->find($selector)[0]->text();
    }

    /**
     * This command - javascript code => json data  => object.
     * @param string $textJsData - javascript code.
     */
    protected function getJsonData($textJsData)
    {
        $start = mb_strpos($textJsData, '[');
        
        $length = mb_strrpos($textJsData, ']') - $start + 1;
        
        $jsonData = mb_substr($textJsData, $start, $length);
        
        return json_decode($jsonData);
    }

    /**
     * This command - add coupon to database from website.
     * @param object $element coupon from JSON data.
     * @param object $market market from database.
     */
    protected function addCoupon($market, $element)
    {
        //check the presence of coupon in the database
         $coupon = Coupon::findOne([
            'id_market' => $market->id,
            'summary' => $element->offerSummary,
            'brand' => $element->brandName,
            'description' => $element->offerDescription,
            'expiry' => $element->offerExpiryDateFormatted,
            //'picture' => $element->mediumImage,
            'picture' => $element->largeImage,
        ]);

        // add coupon to database
        if($coupon === null)
        {
            $coupon = new Coupon();

            $coupon->id_market = $market->id;
            $coupon->summary = $element->offerSummary;
            $coupon->brand = $element->brandName;
            $coupon->description = $element->offerDescription;
            $coupon->expiry = $element->offerExpiryDateFormatted;
            //$coupon->picture = $element->mediumImage;
            $coupon->picture = $element->largeImage;
        }
       
        // mark coupon as existing
        $coupon->exist = 1;
        
        $coupon->save();
    }

    /**
     * This command - test code for debug.
     * cmd> yii spider/test
     */
    public function actionTest()
    {
    }
}
