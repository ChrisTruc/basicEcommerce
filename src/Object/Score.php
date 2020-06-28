<?php

namespace App\Object;

class Score
{
    private $qualityTotal;

    private $priceTotal;

    public function getQualityTotal(): ?float
    {
        return $this->qualityTotal;
    }

    public function setQualityTotal(string $qualityTotal): self
    {
        $this->qualityTotal = $qualityTotal;

        return $this;
    }

    public function getPriceTotal(): ?float
    {
        return $this->priceTotal;
    }

    public function setPriceTotal(string $priceTotal): self
    {
        $this->priceTotal = $priceTotal;

        return $this;
    }
}

?>