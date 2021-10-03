<?php

namespace App\Twig;

use App\Services\MarkdownTransformers;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
  /**
   * @var MarkdownTransformers
   */
  private $markdownTransformer;

  public function __construct(MarkdownTransformers $markdownTransformer)
  {
    $this->markdownTransformer = $markdownTransformer;
  }


    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('markdownify', [$this, 'parseMarkdown'],['is_safe' => ['html']]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    public function doSomething($value)
    {
        // ...
    }

    public function parseMarkdown(string $value): string
    {
      return $this->markdownTransformer->parse($value);
    }
}
