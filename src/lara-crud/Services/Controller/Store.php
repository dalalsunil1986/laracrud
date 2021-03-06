<?php

namespace LaraCrud\Services\Controller;

use Illuminate\Support\Str;
use LaraCrud\Contracts\Controller\RedirectAbleMethod;

class Store extends ControllerMethod implements RedirectAbleMethod
{
    /**
     * @throws \ReflectionException
     *
     * @return \LaraCrud\Services\Controller\ControllerMethod|void
     */
    protected function beforeGenerate()
    {
        $requestClass = $this->getRequestClass();
        $this->setParameter($requestClass, '$request');

        if ($this->parentModel) {
            $this->setParameter(ucfirst($this->getParentShortName()), '$'.$this->getParentShortName());
        }

        return $this;
    }

    /**
     * @throws \ReflectionException
     *
     * @return string
     */
    public function getBody(): string
    {
        $variable = '$'.$this->getModelShortName();
        $body = $variable.' = new '.ucfirst($this->getModelShortName()).';'.PHP_EOL;

        if ($this->parentModel) {
            $body .= "\t\t".$variable.'->'.Str::snake($this->getParentShortName()).'_id = $'.lcfirst($this->getParentShortName()).'->id'.PHP_EOL;
        }

        $body .= "\t\t".$variable.'->fill($request->all())->save();'.PHP_EOL;

        return $body;
    }
}
