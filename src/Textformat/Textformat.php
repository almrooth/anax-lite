<?php

namespace Talm\Textformat;

class Textformat
{
    private $filters = [
        "nl2br",
        "bbcode",
        "link",
        "markdown"
    ];

    public function format($text, $filters)
    {
        if (is_array($filters)) {
            $filter = $filters;
        } else {
            $filter = strtolower($filters);
            $filter = preg_replace('/\s/', '', explode(',', $filters));
        }

        foreach ($filter as $key) {
            if (in_array($key, $this->filters)) {
                $text = call_user_func_array([$this, $key], [$text]);
            }
        }
        return $text;
    }

    public function nl2br($text)
    {
        return nl2br($text);
    }

    public function bbcode($text)
    {
        $search = [
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        ];

        $replace = [
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        ];
        return preg_replace($search, $replace, $text);
    }

    public function link($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            create_function(
                '$matches',
                'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
            ),
            $text
        );
    }

    public function markdown($text)
    {
        return \Michelf\MarkdownExtra::defaultTransform($text);
    }
}
