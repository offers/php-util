<?php
namespace Offers\Util;

class MultiUsort
{
    private $level = 0;
    private $fields;
    private $orders;

    /**
     * @param array $fields
     * $fields is ["field_name_on_object" => [1|-1]] where 1 is sort ascending and -1 is sort descending
     */
    public function __construct(array $fields)
    {
        foreach ($fields as $field => $order) {
            $this->fields[] = $field;
            $this->orders[] = $order;
        }
    }

    public function compare($a, $b)
    {
        $returnVal = 0;
        $comparisonField = $this->fields[$this->level];
        $order = $this->orders[$this->level];

        if ($a->$comparisonField > $b->$comparisonField) {
            $returnVal = 1;
        } else if ($a->$comparisonField < $b->$comparisonField) {
            $returnVal = -1;
        } else {
            if ($this->level < count($this->fields) - 1) {
                $this->level++;
                return $this->compare($a, $b);
            }
        }
        $returnVal *= $order;
        $this->level = 0;
        return $returnVal;
    }
}