<?php
class RatingRepo extends ORMRepo {
    /**
     * @return self
     */
    public static function create() { return self::_create(__CLASS__);}

}

class RatingModel extends ORMModel {
    const TABLE = "cu_neg_rating";
    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $unaEstrella;

    /**
     * @var int
     */
    public $dosEstrellas;

    /**
     * @var int
     */
    public $tresEstrellas;
    /**
 * @var int
 */
    public $cuatroEstrellas;
    /**
     * @var int
     */
    public $cincoEstrellas;


    public function __toString() {
        $str = "";
        $str.= $this->id;
        return $str;
    }

} // Rating
