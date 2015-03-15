<?php


namespace Family\Parser;


use Golonka\BBCode\BBCodeParser;

class Parser extends BBCodeParser
{
    public $availableParsers = array(
        'bold' => array(
            'pattern' => '/\[b\](.*?)\[\/b\]/s',
            'replace' => '<strong>$1</strong>',
        ),
        'italic' => array(
            'pattern' => '/\[i\](.*?)\[\/i\]/s',
            'replace' => '<em>$1</em>',
        ),
        'underLine' => array(
            'pattern' => '/\[u\](.*?)\[\/u\]/s',
            'replace' => '<u>$1</u>',
        ),
        'lineThrough' => array(
            'pattern' => '/\[s\](.*?)\[\/s\]/s',
            'replace' => '<strike>$1</strike>',
        ),
        'fontSize' => array(
            'pattern' => '/\[size\=([1-7])\](.*?)\[\/size\]/s',
            'replace' => '<font size="$1">$2</font>',
        ),
        'fontColor' => array(
            'pattern' => '/\[color\=(#[A-f0-9]{6}|#[A-f0-9]{3})\](.*?)\[\/color\]/s',
            'replace' => '<font color="$1">$2</font>',
        ),
        'center' => array(
            'pattern' => '/\[center\](.*?)\[\/center\]/s',
            'replace' => '<div style="text-align:center;">$1</div>',
        ),
        'quote' => array(
            'pattern' => '/\[quote\](.*?)\[\/quote\]/s',
            'replace' => '<blockquote>$1</blockquote>',
            'iterate' => 3,
        ),
        'namedQuote' => array(
            'pattern' => '/\[quote\=(.*?)\](.*)\[\/quote\]/s',
            'replace' => '<blockquote><small>$1</small>$2</blockquote>',
            'iterate' => 3,
        ),
        'link' => array(
            'pattern' => '/\[url\](.*?)\[\/url\]/s',
            'replace' => '<a href="$1">$1</a>',
        ),
        'namedLink' => array(
            'pattern' => '/\[url\=(.*?)\](.*?)\[\/url\]/s',
            'replace' => '<a href="$1">$2</a>',
        ),
        'image' => array(
            'pattern' => '/\[img\](.*?)\[\/img\]/s',
            'replace' => '<img src="$1" class="img-responsive">',
        ),
        'orderedListNumerical' => array(
            'pattern' => '/\[list=1\](.*?)\[\/list\]/s',
            'replace' => '<ol>$1</ol>',
        ),
        'orderedListAlpha' => array(
            'pattern' => '/\[list=a\](.*?)\[\/list\]/s',
            'replace' => '<ol type="a">$1</ol>',
        ),
        'orderedListDeprecated' => array(
            'pattern' => '/\[ol\](.*?)\[\/ol\]/s',
            'replace' => '<ol>$1</ol>',
        ),
        'unorderedList' => array(
            'pattern' => '/\[list\](.*?)\[\/list\]/s',
            'replace' => '<ul>$1</ul>',
        ),
        'unorderedListDeprecated' => array(
            'pattern' => '/\[ul\](.*?)\[\/ul\]/s',
            'replace' => '<ul>$1</ul>',
        ),
        'listItem' => array(
            'pattern' => '/\[\*\](.*)/',
            'replace' => '<li>$1</li>',
        ),
        'code' => array(
            'pattern' => '/\[code\](.*?)\[\/code\]/s',
            'replace' => '<code>$1</code>',
        ),
        'youtube' => array(
            'pattern' => '/\[youtube\](.*?)\[\/youtube\]/s',
            'replace' => '<iframe width="560" height="315" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
        ),
        'video' => array(
            'pattern' => '/\[video\](.*?)\[\/video\]/s',
            'replace' => '<iframe width="560" height="315" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
        ),
        'linebreak' => array(
            'pattern' => '/\r/',
            'replace' => '<br />',
        )
    );
} 