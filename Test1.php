<?php

/**
 * Class Test1
 */
class Test1{

    /**
     * @var string
     */
    private $sign = '';

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var int
     */
    private $age  = 0;

    /**
     * @var string
     */
    private $work = '';

    /**
     * @var string
     */
    private $sex  = '女';

    /**
     * Test1 constructor.
     * @param string $name
     */
    public function __construct($name)
    {

        $this->name = $name;
    }


    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}

?>