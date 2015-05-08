<?php

namespace Jaspersoft\Dto\Diagnostic;


use Jaspersoft\Dto\DTOObject;

class DiagnosticFilter extends DTOObject
{
    public $userId;
    public $sessionId;
    public $resource;

    public static function createFromJSON($json_obj)
    {
        $obj = parent::createFromJSON($json_obj);
        $obj->resource = DiagnosticFilterResource::createFromJSON($json_obj->resource);
        return $obj;
    }

    public function jsonSerialize()
    {
        $result = parent::jsonSerialize();
        if (is_a($this->resource, "DiagnosticFilterResource")) {
            $result['resource'] = $this->resource->jsonSerialize();
        }
        // Internal Server Error if "resource" is set to null
        // so we will filter null values for now
        return array_filter($result, function($v) { return isset($v); });
    }
}