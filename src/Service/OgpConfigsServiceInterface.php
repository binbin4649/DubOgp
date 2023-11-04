<?php

namespace DubOgp\Service;

use DubOgp\Model\Entity\OgpConfig;

interface OgpConfigsServiceInterface
{
    public function getValue($fieldName): ?string;

    public function get(): OgpConfig;

    public function update(array $postData);

    public function setValue($name, $value);

    public function resetValue($name);

    public function clearCache();

}