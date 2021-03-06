<?php

namespace LaraCrud\Builder;

abstract class Page
{
    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    protected $data;

    /**
     * @var
     */
    protected $page;

    /**
     * @var
     */
    protected $type;

    /**
     * @var
     */
    protected $inputType;

    /**
     * @var
     */
    protected $filePath;

    /**
     * Page constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    abstract public function render();

    /**
     * @return mixed
     */
    abstract public function save();
}
