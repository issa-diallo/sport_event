<?php

namespace App\Services;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MarkdownTransformers 
{
  private $markdown;

  private $cache;

  public function __construct(MarkdownParserInterface $markdown,CacheInterface $cache)
  {
    $this->markdown = $markdown;
    $this->cache = $cache;
  }

  public function parse(string $str): string
  {
    $key = md5("markdown_",$str);

    $valueCache = $this->cache->get($key,function(ItemInterface $item) use($str) {

      sleep(1);

      return $this->markdown->transformMarkdown($str);

    });
    return $valueCache;
  }
}
