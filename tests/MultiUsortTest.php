<?php
class MultiUsortTest extends PHPUnit\Framework\TestCase
{
    public function testObjectSorting()
    {
        $obj1 = new stdClass();
        $obj2 = new stdClass();
        $obj3 = new stdClass();

        $obj1->name = "Object 1";
        $obj1->field1 = 1;
        $obj1->field2 = 1;

        $obj2->name = "Object 2";
        $obj2->field1 = 1;
        $obj2->field2 = 0;

        $obj3->name = "Object 3";
        $obj3->field1 = 0;
        $obj3->field2 = 1;

        $array = [$obj1, $obj2, $obj3];

        shuffle($array);
        $sorter = new \Offers\Util\MultiUsort([
            "field1" => 1,
            "field2" => 1
        ]);
        usort($array, $sorter);
        $this->assertEquals("Object 3", $array[0]->name);
        $this->assertEquals("Object 2", $array[1]->name);
        $this->assertEquals("Object 1", $array[2]->name);

        shuffle($array);
        $sorter = new \Offers\Util\MultiUsort([
            "field1" => -1,
            "field2" => 1
        ]);
        usort($array, $sorter);
        $this->assertEquals("Object 2", $array[0]->name);
        $this->assertEquals("Object 1", $array[1]->name);
        $this->assertEquals("Object 3", $array[2]->name);
    }

    public function testArraySorting()
    {
        $arr1 = [];
        $arr2 = [];
        $arr3 = [];

        $arr1["name"] = "Array 1";
        $arr1["field1"] = 1;
        $arr1["field2"] = 1;

        $arr2["name"] = "Array 2";
        $arr2["field1"] = 1;
        $arr2["field2"] = 0;

        $arr3["name"] = "Array 3";
        $arr3["field1"] = 0;
        $arr3["field2"] = 1;

        $array = [$arr1, $arr2, $arr3];

        shuffle($array);
        $sorter = new \Offers\Util\MultiUsort([
            "field1" => 1,
            "field2" => 1
        ]);
        usort($array, $sorter);
        $this->assertEquals("Array 3", $array[0]["name"]);
        $this->assertEquals("Array 2", $array[1]["name"]);
        $this->assertEquals("Array 1", $array[2]["name"]);

        shuffle($array);
        $sorter = new \Offers\Util\MultiUsort([
            "field1" => -1,
            "field2" => 1
        ]);
        usort($array, $sorter);
        $this->assertEquals("Array 2", $array[0]["name"]);
        $this->assertEquals("Array 1", $array[1]["name"]);
        $this->assertEquals("Array 3", $array[2]["name"]);
    }
}