<?php
class HighRoller_SeriesData
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $color;

    /**
     * @var
     */
    public $stack;

    /**
     * @var array
     */
    public $data = array();

    /**
     * @param $name
     * @return HighRoller_SeriesData
     */
    public function addName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param $type
     * @return HighRoller_SeriesData
     */
    public function addType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param $data
     * @return HighRoller_SeriesData
     */
    public function addData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param $color
     * @return HighRoller_SeriesData
     */
    public function addColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @param $stack
     * @return HighRoller_SeriesData
     */
    public function addStack($stack)
    {
        $this->stack = $stack;
        return $this;
    }
}