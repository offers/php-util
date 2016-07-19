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

    public function __invoke($a, $b)
    {
        $returnVal = 0;
        $comparisonField = $this->fields[$this->level];
        $order = $this->orders[$this->level];

        $aComparisonField = $this->getComparisonField($a, $comparisonField);
        $bComparisonField = $this->getComparisonField($b, $comparisonField);

        if ($aComparisonField > $bComparisonField) {
            $returnVal = 1;
        } else if ($aComparisonField < $bComparisonField) {
            $returnVal = -1;
        } else {
            if ($this->level < count($this->fields) - 1) {
                $this->level++;
                return $this->__invoke($a, $b);
            }
        }
        $returnVal *= $order;
        $this->level = 0;
        return $returnVal;
    }

    private function getComparisonField($item, $field)
    {
        if (is_object($item)) {
            return $item->$field;
        }
        if (is_array($item) && isset($item[$field])) {
            return $item[$field];
        }
        throw new \RuntimeException("unable to find comparison field $field");
    }
}