<?php
namespace App\Service;

use App\Object\Score;

class AdviceService {

    public function calculScore($advices) {
        
        $score = new Score();

        $quality = 0;
        $price = 0;

        $cnt = 0;
        foreach($advices as $advice) {
            $quality += $advice->getQuality();
            $price += $advice->getPrice();
            $cnt++;
        }

        $score->setQualityTotal($quality/$cnt);
        $score->setPriceTotal($price/$cnt);

        return $score;
    }

}
?>