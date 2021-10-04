<?php

namespace App\Twig;

use App\Entity\Event;
use App\Services\MarkdownTransformers;
use InvalidArgumentException;
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
            new TwigFunction('pluralize', [$this, 'pluralize']),
            new TwigFunction('format_price', [$this, 'formatPrice']),
        ];
    }


    public function formatPrice($event = null)
    {
      if($event == 0 || is_null($event)){
        return "Free";
      }else{
        return $event;
      }
    }

    /**
     * add an s to the singular
     *
     * @param integer $count
     * @param string $singular
     * @param string|null $plural
     * @return void
     */
    public function pluralize(int $count, string $singular, $plural = null): string
    {
      if(!is_numeric($count)){
        throw new InvalidArgumentException("$count must be a value numeric");
      }

      if($plural == null){
        $plural = $singular . "s";
      }

      switch ($count) {
        case 1:
          $string = $singular;
          break;

        default:
          $string = $plural;
          break;
      }

      return sprintf("%d %s",$count,$string);
    }

    /**
     * transforms markdown into html and caches it
     *
     * @param string $value
     * @return string
     */
    public function parseMarkdown(string $value): string
    {
      return $this->markdownTransformer->parse($value);
    }
}
