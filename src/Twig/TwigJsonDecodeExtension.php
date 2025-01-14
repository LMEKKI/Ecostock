<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;


/**
 * Class for Json to array.
 */
class TwigJsonDecodeExtension extends AbstractExtension {

  public function getFilters(): array {
    return [
      new TwigFilter('decode_json', [$this, 'jsonDecode']),
    ];
  }
  
  public function jsonDecode($context): mixed {
    return json_decode($context);
  }
}
  